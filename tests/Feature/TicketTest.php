<?php

use App\Models\Ticket;
use App\Models\User;

test('authenticated user can create tickets', function () {

    // AAA Pattern
    // Arrange, Act, Assert

    // 1. Create a user
    $user = User::factory()->create();

    // 2. Act as the created user
    $this->actingAs($user);

    $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);

    // 3. Send a POST request to create a ticket
    $response = $this->post('/tickets', [
        'title' => 'Sample Ticket',
        'description' => 'This is a sample ticket description.',
        'priority' => 'high',
    ]);

    // 4. Assert that the ticket was created in the database
    $this->assertDatabaseHas('tickets', [
        'title' => 'Sample Ticket',
        'description' => 'This is a sample ticket description.',
        'priority' => 'high',
        'user_id' => $user->id,
    ]);
});

test('getting recent tickets for dashboard view', function () {
    // 1. Create a user
    $user = User::factory()->create();

    // 2. Create tickets for the user
    Ticket::factory()->count(12)->create(['user_id' => $user->id]);

    // 3. Act as created user
    $this->actingAs($user);

    // 4. GET dashboard
    $response = $this->get('/dashboard');

    // 5. Assert that the response contains the tickets
    $response->assertStatus(200);

    $response->assertViewHas('recentTickets', function ($tickets) use ($user) {
        return $tickets->every(fn ($ticket) => $ticket->user_id === $user->id);
    });
});

test('getting all tickets for kanban board', function () {
    // 1. Create a user
    $user = User::factory()->create();

    // 2. Create tickets for the user
    Ticket::factory()->count(5)->create(['user_id' => $user->id]);

    // 3. Act as created user
    $this->actingAs($user);

    // 4. GET tickets (kanban board)
    $response = $this->get('/tickets');

    // 5. Assert that the response contains the tickets
    $response->assertStatus(200);

    $response->assertViewIs('tickets.index');

    $response->assertViewHas('tickets', function ($tickets) use ($user) {
        return $tickets->count() === 5 && $tickets->every(fn ($ticket) => $ticket->user_id === $user->id);
    });
});

test('getting a single ticket detail view', function () {
    // 1. Create a user
    $user = User::factory()->create();

    // 2. Create a ticket for the user
    $ticket = Ticket::factory()->create(['user_id' => $user->id]);

    // 3. Act as created user
    $this->actingAs($user);

    // 4. GET ticket detail
    $response = $this->get("/tickets/{$ticket->id}");

    // 5. Assert that the response contains the ticket details
    $response->assertStatus(200);

    $response->assertViewIs('tickets.show');

    $response->assertViewHas('ticket', function ($viewTicket) use ($ticket) {
        return $viewTicket->id === $ticket->id;
    });
});

test('user1 cant access user2 ticket detail view', function () {
    // 1. Create two users
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    // 2. Create a ticket for user2
    $ticket = Ticket::factory()->create(['user_id' => $user2->id]);

    // 3. Act as user1
    $this->actingAs($user1);

    // 4. GET user2 ticket detail
    $response = $this->get("/tickets/{$ticket->id}");

    // 5. Assert that the response is 403 Forbidden
    $response->assertStatus(403);
});
