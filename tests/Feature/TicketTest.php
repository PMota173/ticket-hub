<?php

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

test('authenticated user can create tickets', function () {

    // AAA Pattern
    // Arrange, Act, Assert

    // 1. Create a user
    $user = User::factory()->create();

    // 2. Act as the created user
    $this->actingAs($user);

    $this->withoutMiddleware(VerifyCsrfToken::class);

    // 3. Send a POST request to create a ticket
    $response = $this->post(route('tickets.store'), [
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
    $response = $this->get(route('dashboard'));

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
    $response = $this->get(route('tickets.index'));

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
    $response = $this->get(route('tickets.show', $ticket));

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
    $response = $this->get(route('tickets.show', $ticket));

    // 5. Assert that the response is 403 Forbidden
    $response->assertStatus(403);
});

test('guest cannot create tickets', function () {
    // 1. Send a POST request to create a ticket as a guest
    $response = $this->post(route('tickets.store'), [
        'title' => 'Sample Ticket',
        'description' => 'This is a sample ticket description.',
        'priority' => 'high',
    ]);

    // 2. Assert that the response is a redirect to the login page
    $response->assertRedirect(route('login'));
});

test('updating the status of a ticket', function () {
    // 1. Create a user
    $user = User::factory()->create();

    // 2. Create a ticket for the user
    $ticket = Ticket::factory()->create(['user_id' => $user->id]);

    // 3. Act as created user
    $this->actingAs($user);

    // Disable CSRF middleware for testing (PATCH requests)
    $this->withoutMiddleware(VerifyCsrfToken::class);

    // 4. Send a PATCH request to update the ticket status
    $response = $this->patch(route('tickets.update', $ticket), [
        'status' => 'closed',
    ]);

    // 5. Assert that the ticket status was updated in the database
    $this->assertDatabaseHas('tickets', [
        'id' => $ticket->id,
        'status' => 'closed',
    ]);
});

test('editing the status on a ticket', function () {
    // 1. Create a user
    $user = User::factory()->create();

    // 2. Create a ticket for the user
    $ticket = Ticket::factory()->create(['user_id' => $user->id]);

    // 3. Act as created user
    $this->actingAs($user);

    // Disable CSRF middleware for testing (PATCH requests)
    $this->withoutMiddleware(VerifyCsrfToken::class);

    // 4. Send a PATCH request to update the ticket
    $response = $this->patch(route('tickets.update', $ticket), [
        'title' => 'Updated Ticket Title',
        'description' => 'Updated description.',
        'priority' => 'medium',
        'status' => 'in_progress',
    ]);

    // 5. Assert that the ticket was updated in the database
    $this->assertDatabaseHas('tickets', [
        'id' => $ticket->id,
        'title' => 'Updated Ticket Title',
        'description' => 'Updated description.',
        'priority' => 'medium',
        'status' => 'in_progress',
    ]);
});

test('deleting a ticket', function () {
    // 1. Create a user
    $user = User::factory()->create();

    // 2. Create a ticket for the user
    $ticket = Ticket::factory()->create(['user_id' => $user->id]);

    // 3. Act as created user
    $this->actingAs($user);

    // Disable CSRF middleware for testing (DELETE requests)
    $this->withoutMiddleware(VerifyCsrfToken::class);

    // 4. Send a DELETE request to delete the ticket
    $response = $this->delete(route('tickets.destroy', $ticket));

    // 5. Assert that the ticket was deleted from the database
    $this->assertDatabaseMissing('tickets', [
        'id' => $ticket->id,
    ]);
});
