<?php

use App\Models\Team;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Tag;

// --- AUTHORIZATION & VIEWING ---

test('team member can view tickets board', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create(['user_id' => $user->id]);
    $team->users()->attach($user, ['is_admin' => true]);

    $this->actingAs($user)
        ->get(route('tickets.index', $team))
        ->assertOk();
});

test('non-member cannot view private team tickets', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create(['is_private' => true]);
    // User is NOT in team

    $this->actingAs($user)
        ->get(route('tickets.index', $team))
        ->assertForbidden();
});

test('non-member CAN view public team tickets', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create(['is_private' => false]);
    // User is NOT in team

    $this->actingAs($user)
        ->get(route('tickets.index', $team))
        ->assertOk();
});

// --- CREATION ---

test('team member can create ticket', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create(['user_id' => $user->id]);
    $team->users()->attach($user, ['is_admin' => true]);

    $this->actingAs($user)
        ->post(route('tickets.store', $team), [
            'title' => 'New Bug',
            'description' => 'Something is broken',
            'priority' => 'high',
            'status' => 'open',
        ])
        ->assertRedirect(route('tickets.index', $team));

    $this->assertDatabaseHas('tickets', [
        'title' => 'New Bug',
        'team_id' => $team->id,
        'user_id' => $user->id,
    ]);
});

test('team member can assign ticket during creation', function () {
    $user = User::factory()->create();
    $otherMember = User::factory()->create();
    $team = Team::factory()->create(['user_id' => $user->id]);
    $team->users()->attach($user, ['is_admin' => true]);
    $team->users()->attach($otherMember, ['is_admin' => false]);

    $this->actingAs($user)
        ->post(route('tickets.store', $team), [
            'title' => 'Assigned Ticket',
            'description' => 'For you',
            'priority' => 'medium',
            'status' => 'open',
            'assigned_id' => $otherMember->id,
        ]);

    $this->assertDatabaseHas('tickets', [
        'title' => 'Assigned Ticket',
        'assigned_id' => $otherMember->id,
    ]);
});

test('non-member CANNOT assign ticket during creation', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create(['is_private' => false]); // Public team
    // User is NOT in team

    $member = User::factory()->create();
    $team->users()->attach($member);

    $this->actingAs($user)
        ->post(route('tickets.store', $team), [
            'title' => 'Hacker Ticket',
            'description' => 'Trying to assign',
            'priority' => 'low',
            'status' => 'open',
            'assigned_id' => $member->id, // Trying to assign
        ]);

    // Should create ticket BUT ignore assignment
    $this->assertDatabaseHas('tickets', [
        'title' => 'Hacker Ticket',
        'assigned_id' => null, // Should be null!
    ]);
});

test('cannot create ticket with empty title', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user);

    $this->actingAs($user)
        ->post(route('tickets.store', $team), [
            'title' => '',
            'priority' => 'low',
            'status' => 'open',
        ])
        ->assertSessionHasErrors('title');
});

test('cannot create ticket with invalid priority', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user);

    $this->actingAs($user)
        ->post(route('tickets.store', $team), [
            'title' => 'Invalid Priority',
            'priority' => 'critical-meltdown', // Invalid
            'status' => 'open',
        ])
        ->assertSessionHasErrors('priority');
});

test('cannot create ticket with invalid status', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user);

    $this->actingAs($user)
        ->post(route('tickets.store', $team), [
            'title' => 'Invalid Status',
            'priority' => 'low',
            'status' => 'archived-forever', // Invalid
        ])
        ->assertSessionHasErrors('status');
});

// --- UPDATING ---

test('ticket owner can update ticket', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user);
    $ticket = Ticket::factory()->create(['user_id' => $user->id, 'team_id' => $team->id]);

    $this->actingAs($user)
        ->patch(route('tickets.update', [$team, $ticket]), [
            'title' => 'Updated Title',
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('tickets', ['id' => $ticket->id, 'title' => 'Updated Title']);
});

test('team admin can update any ticket', function () {
    $admin = User::factory()->create();
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($admin, ['is_admin' => true]);
    $team->users()->attach($user, ['is_admin' => false]);
    
    $ticket = Ticket::factory()->create(['user_id' => $user->id, 'team_id' => $team->id]);

    $this->actingAs($admin)
        ->patch(route('tickets.update', [$team, $ticket]), [
            'status' => 'closed',
        ]);

    $this->assertDatabaseHas('tickets', ['id' => $ticket->id, 'status' => 'closed']);
});

test('any team member CAN update any ticket', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user1, ['is_admin' => false]);
    $team->users()->attach($user2, ['is_admin' => false]);
    
    $ticket = Ticket::factory()->create(['user_id' => $user2->id, 'team_id' => $team->id]);

    $this->actingAs($user1)
        ->patch(route('tickets.update', [$team, $ticket]), [
            'title' => 'Collaborative Edit',
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('tickets', ['id' => $ticket->id, 'title' => 'Collaborative Edit']);
});

// --- ASSIGN TO ME ---

test('member can assign ticket to themselves', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user, ['is_admin' => false]); // Regular member
    
    // Ticket created by someone else
    $ticket = Ticket::factory()->create(['team_id' => $team->id]);

    $this->actingAs($user)
        ->patch(route('tickets.update', [$team, $ticket]), [
            'assigned_id' => $user->id,
        ])
        ->assertRedirect();
        
    $this->assertDatabaseHas('tickets', [
        'id' => $ticket->id,
        'assigned_id' => $user->id,
    ]);
});

test('member can unassign themselves', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user);
    
    $ticket = Ticket::factory()->create([
        'team_id' => $team->id,
        'assigned_id' => $user->id
    ]);

    $this->actingAs($user)
        ->patch(route('tickets.update', [$team, $ticket]), [
            'assigned_id' => '', // Sending empty string to unassign
        ])
        ->assertRedirect();
        
    $this->assertDatabaseHas('tickets', [
        'id' => $ticket->id,
        'assigned_id' => null,
    ]);
});

// --- TAGS ---

test('team member can add tag to ticket', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user, ['is_admin' => true]); // Admin to ensure permission
    $ticket = Ticket::factory()->create(['team_id' => $team->id, 'user_id' => $user->id]);

    $this->actingAs($user)
        ->post(route('tickets.tags.store', [$team, $ticket]), [
            'name' => 'Urgent Bug',
        ]);

    $this->assertDatabaseHas('tags', ['name' => 'Urgent Bug', 'team_id' => $team->id]);
    $this->assertTrue($ticket->tags()->where('name', 'Urgent Bug')->exists());
});

test('tag is reused if exists in team', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user, ['is_admin' => true]);
    
    $tag = Tag::factory()->create(['team_id' => $team->id, 'name' => 'Existing Tag']);
    $ticket = Ticket::factory()->create(['team_id' => $team->id, 'user_id' => $user->id]);

    $this->actingAs($user)
        ->post(route('tickets.tags.store', [$team, $ticket]), [
            'name' => 'Existing Tag',
        ]);

    $this->assertEquals(1, Tag::count()); // Should still be 1 tag
    $this->assertTrue($ticket->tags()->where('name', 'Existing Tag')->exists());
});

test('team member can remove tag', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user, ['is_admin' => true]);
    
    $tag = Tag::factory()->create(['team_id' => $team->id, 'name' => 'Remove Me']);
    $ticket = Ticket::factory()->create(['team_id' => $team->id, 'user_id' => $user->id]);
    $ticket->tags()->attach($tag);

    $this->actingAs($user)
        ->delete(route('tickets.tags.destroy', [$team, $ticket, $tag]));

    $this->assertFalse($ticket->tags()->where('name', 'Remove Me')->exists());
});
