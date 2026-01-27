<?php

use App\Models\Team;
use App\Models\TeamRobot;
use App\Models\Ticket;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('robot can comment on team ticket', function () {
    $team = Team::factory()->create();
    $robot = TeamRobot::factory()->create(['team_id' => $team->id]);
    $ticket = Ticket::factory()->create(['team_id' => $team->id]);
    
    Sanctum::actingAs($robot, ['*']);

    $response = $this->postJson(route('api.tickets.comments.store', $ticket), [
        'body' => 'This is a robot comment.',
    ]);

    $response->assertOk(); // or assertCreated() if you changed it to 201

    $this->assertDatabaseHas('comments', [
        'body' => 'This is a robot comment.',
        'ticket_id' => $ticket->id,
        'author_id' => $robot->id,
        'author_type' => TeamRobot::class,
    ]);
});

test('robot cannot comment on ticket from another team', function () {
    $team = Team::factory()->create();
    $robot = TeamRobot::factory()->create(['team_id' => $team->id]);
    
    $otherTeam = Team::factory()->create();
    $otherTicket = Ticket::factory()->create(['team_id' => $otherTeam->id]);
    
    Sanctum::actingAs($robot, ['*']);

    $response = $this->postJson(route('api.tickets.comments.store', $otherTicket), [
        'body' => 'Intruder comment',
    ]);

    $response->assertNotFound();
});

test('comment body is required', function () {
    $team = Team::factory()->create();
    $robot = TeamRobot::factory()->create(['team_id' => $team->id]);
    $ticket = Ticket::factory()->create(['team_id' => $team->id]);
    
    Sanctum::actingAs($robot, ['*']);

    $response = $this->postJson(route('api.tickets.comments.store', $ticket), [
        'body' => '',
    ]);

    $response->assertJsonValidationErrors('body');
});