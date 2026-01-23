<?php

use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\User;
use App\Notifications\TeamInvitationNotification;
use Illuminate\Support\Facades\Notification;

test('team admin can invite a user', function () {
    Notification::fake();
    
    $user = User::factory()->create();
    $team = Team::factory()->create(['user_id' => $user->id]);
    $team->users()->attach($user, ['is_admin' => true]);

    $this->actingAs($user)
        ->post(route('invitations.store', $team), [
            'email' => 'colleague@example.com',
        ])
        ->assertRedirect(route('invitations.index', $team));

    $this->assertDatabaseHas('team_invitations', [
        'team_id' => $team->id,
        'email' => 'colleague@example.com',
        'invited_by' => $user->id,
    ]);

    Notification::assertSentTo(
        new Illuminate\Notifications\AnonymousNotifiable,
        TeamInvitationNotification::class,
        function ($notification, $channels, $notifiable) {
             return $notifiable->routes['mail'] === 'colleague@example.com';
        }
    );
});

test('team admin can view pending invitations', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create(['user_id' => $user->id]);
    $team->users()->attach($user, ['is_admin' => true]);

    $invitation = TeamInvitation::factory()->create([
        'team_id' => $team->id,
        'email' => 'pending@example.com',
    ]);

    $this->actingAs($user)
        ->get(route('invitations.index', $team))
        ->assertOk()
        ->assertSee('pending@example.com');
});

test('non-admin cannot invite users', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create(); 
    // User is not even a member
    
    $this->actingAs($user)
        ->post(route('invitations.store', $team), [
            'email' => 'colleague@example.com',
        ])
        ->assertForbidden();
        
    $this->assertDatabaseMissing('team_invitations', ['email' => 'colleague@example.com']);
});

test('regular member cannot invite users', function () {
    $admin = User::factory()->create();
    $team = Team::factory()->create(['user_id' => $admin->id]);
    $team->users()->attach($admin, ['is_admin' => true]);

    $member = User::factory()->create();
    $team->users()->attach($member, ['is_admin' => false]);

    $this->actingAs($member)
        ->post(route('invitations.store', $team), [
            'email' => 'new@example.com',
        ])
        ->assertForbidden();

    $this->assertDatabaseMissing('team_invitations', ['email' => 'new@example.com']);
});

test('cannot invite an existing team member', function () {
    $admin = User::factory()->create();
    $team = Team::factory()->create(['user_id' => $admin->id]);
    $team->users()->attach($admin, ['is_admin' => true]);

    $member = User::factory()->create();
    $team->users()->attach($member, ['is_admin' => false]);

    $this->actingAs($admin)
        ->post(route('invitations.store', $team), [
            'email' => $member->email,
        ])
        ->assertSessionHasErrors('email');
});

test('cannot invite the same email twice', function () {
    $admin = User::factory()->create();
    $team = Team::factory()->create(['user_id' => $admin->id]);
    $team->users()->attach($admin, ['is_admin' => true]);

    TeamInvitation::factory()->create([
        'team_id' => $team->id,
        'email' => 'pending@example.com',
    ]);

    $this->actingAs($admin)
        ->post(route('invitations.store', $team), [
            'email' => 'pending@example.com',
        ])
        ->assertSessionHasErrors('email');
});

test('team admin can cancel an invitation', function () {
    $admin = User::factory()->create();
    $team = Team::factory()->create(['user_id' => $admin->id]);
    $team->users()->attach($admin, ['is_admin' => true]);

    $invitation = TeamInvitation::factory()->create([
        'team_id' => $team->id,
        'email' => 'invitee@example.com',
    ]);

    $this->actingAs($admin)
        ->delete(route('invitations.destroy', [$team, $invitation]))
        ->assertRedirect();

    $this->assertDatabaseMissing('team_invitations', ['id' => $invitation->id]);
});

test('user can accept an invitation', function () {
    $user = User::factory()->create(['email' => 'invitee@example.com']);
    $team = Team::factory()->create();
    $invitation = TeamInvitation::factory()->create([
        'team_id' => $team->id,
        'email' => 'invitee@example.com',
        'token' => 'valid-token',
    ]);

    $this->actingAs($user)
        ->get(route('invitations.accept', 'valid-token'))
        ->assertRedirect(route('dashboard'));

    expect($team->users->contains($user))->toBeTrue();
    expect($invitation->fresh()->accepted_at)->not->toBeNull();
});

test('user cannot accept invitation for different email', function () {
    $user = User::factory()->create(['email' => 'wrong@example.com']);
    $invitation = TeamInvitation::factory()->create([
        'email' => 'correct@example.com',
        'token' => 'valid-token',
    ]);

    $this->actingAs($user)
        ->get(route('invitations.accept', 'valid-token'))
        ->assertForbidden();
        
    expect($invitation->fresh()->accepted_at)->toBeNull();
});

test('cannot accept invitation with invalid token', function () {
    $this->get(route('invitations.accept', 'invalid-token'))
        ->assertNotFound();
});

test('cannot accept expired invitation', function () {
    $invitation = TeamInvitation::factory()->create([
        'expires_at' => now()->subDay(),
        'token' => 'expired-token',
    ]);

    $this->get(route('invitations.accept', 'expired-token'))
        ->assertForbidden();
});

test('redirects to dashboard if invitation already accepted', function () {
    $user = User::factory()->create(['email' => 'accepted@example.com']);
    $team = Team::factory()->create();
    $invitation = TeamInvitation::factory()->create([
        'team_id' => $team->id,
        'email' => 'accepted@example.com',
        'token' => 'accepted-token',
        'accepted_at' => now(),
    ]);

    // Even if logged in
    $this->actingAs($user)
        ->get(route('invitations.accept', 'accepted-token'))
        ->assertRedirect(route('dashboard'));
});

test('guest is redirected to register when accepting invitation', function () {
    $invitation = TeamInvitation::factory()->create([
        'email' => 'new@example.com',
        'token' => 'valid-token',
    ]);

    $this->get(route('invitations.accept', 'valid-token'))
        ->assertRedirect(route('register', ['email' => 'new@example.com']));
        
    expect(session('url.intended'))->toBe(route('invitations.accept', 'valid-token'));
});

test('guest with existing account is redirected to login when accepting', function () {
    $user = User::factory()->create(['email' => 'existing@example.com']);
    $invitation = TeamInvitation::factory()->create([
        'email' => 'existing@example.com',
        'token' => 'valid-token',
    ]);

    $this->get(route('invitations.accept', 'valid-token'))
        ->assertRedirect(route('login'));

    expect(session('url.intended'))->toBe(route('invitations.accept', 'valid-token'));
});

test('user can view their invitations', function () {
    $user = User::factory()->create();
    $invitation = TeamInvitation::factory()->create([
        'email' => $user->email,
    ]);

    $this->actingAs($user)
        ->get(route('my-invitations.index'))
        ->assertOk()
        ->assertSee($invitation->team->name);
});

test('user can decline their invitation', function () {
    $user = User::factory()->create();
    $invitation = TeamInvitation::factory()->create([
        'email' => $user->email,
    ]);

    $this->actingAs($user)
        ->delete(route('my-invitations.destroy', $invitation))
        ->assertRedirect(route('my-invitations.index'));

    $this->assertDatabaseMissing('team_invitations', ['id' => $invitation->id]);
});

test('user cannot decline invitation for others', function () {
    $user = User::factory()->create(['email' => 'me@example.com']);
    $otherInvitation = TeamInvitation::factory()->create([
        'email' => 'other@example.com',
    ]);

    $this->actingAs($user)
        ->delete(route('my-invitations.destroy', $otherInvitation))
        ->assertForbidden();

    $this->assertDatabaseHas('team_invitations', ['id' => $otherInvitation->id]);
});
