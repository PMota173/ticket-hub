<?php

use App\Models\Comment;
use App\Models\Team;
use App\Models\Ticket;
use App\Models\User;

test('users can comment on tickets', function () {
    $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user);
    $ticket = Ticket::factory()->create(['team_id' => $team->id]);

    $response = $this->actingAs($user)
        ->post(route('tickets.comments.store', [$team, $ticket]), [
            'body' => 'This is a test comment.',
        ]);

    $response->assertRedirect(route('tickets.show', [$team, $ticket]));

    $this->assertDatabaseHas('comments', [
        'body' => 'This is a test comment.',
        'ticket_id' => $ticket->id,
        'user_id' => $user->id,
    ]);
});

test('body is required', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user);
    $ticket = Ticket::factory()->create(['team_id' => $team->id]);

    $response = $this->actingAs($user)
        ->post(route('tickets.comments.store', [$team, $ticket]), [
            'body' => '',
        ]);

    $response->assertSessionHasErrors('body');
});

test('users can delete their own comments', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user);
    $ticket = Ticket::factory()->create(['team_id' => $team->id]);
    $comment = Comment::create([
        'body' => 'My comment',
        'ticket_id' => $ticket->id,
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user)
        ->delete(route('tickets.comments.destroy', [$team, $ticket, $comment]));

    $response->assertRedirect(route('tickets.show', [$team, $ticket]));
    $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
});

test('users cannot delete others comments', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user);
    $ticket = Ticket::factory()->create(['team_id' => $team->id]);
    $comment = Comment::create([
        'body' => 'Other comment',
        'ticket_id' => $ticket->id,
        'user_id' => $otherUser->id,
    ]);

    $response = $this->actingAs($user)
        ->delete(route('tickets.comments.destroy', [$team, $ticket, $comment]));

    $response->assertForbidden();
    $this->assertDatabaseHas('comments', ['id' => $comment->id]);
});
