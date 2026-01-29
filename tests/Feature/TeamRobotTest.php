<?php

use App\Models\Team;
use App\Models\TeamRobot;
use App\Models\Ticket;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('team admin can view robots page', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user, ['is_admin' => true]);

    $this->actingAs($user)
        ->get(route('robots.index', $team))
        ->assertOk()
        ->assertSee('Team Robots')
        ->assertSee('Automation Robots');
});

test('regular member cannot view robots page', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user, ['is_admin' => false]);

    $this->actingAs($user)
        ->get(route('robots.index', $team))
        ->assertForbidden();
});

test('team admin can create robot', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user, ['is_admin' => true]);

    $this->actingAs($user)
        ->post(route('robots.store', $team), [
            'name' => 'CI Bot',
        ])
        ->assertRedirect()
        ->assertSessionHas('robot_token');

    $this->assertDatabaseHas('team_robots', [
        'name' => 'CI Bot',
        'team_id' => $team->id,
    ]);
});

test('cannot create more than 3 robots', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user, ['is_admin' => true]);

    // Create 3 existing robots
    TeamRobot::factory()->count(3)->create(['team_id' => $team->id]);

    $this->actingAs($user)
        ->post(route('robots.store', $team), [
            'name' => 'Fourth Bot',
        ])
        ->assertSessionHas('error', 'You can only have 3 robots per team.');

    $this->assertDatabaseMissing('team_robots', [
        'name' => 'Fourth Bot',
        'team_id' => $team->id,
    ]);
});

test('robot can create ticket via api', function () {
    $team = Team::factory()->create();
    $robot = TeamRobot::factory()->create(['team_id' => $team->id]);

    Sanctum::actingAs($robot, ['*']);

    $response = $this->postJson(route('api.tickets.store'), [
        'title' => 'API Ticket',
        'description' => 'Created by robot',
        'priority' => 'high',
    ]);

    $response->assertCreated();

    $this->assertDatabaseHas('tickets', [
        'title' => 'API Ticket',
        'author_id' => $robot->id,
        'author_type' => TeamRobot::class,
        'team_id' => $team->id,
    ]);
});

test('robot can list team tickets via api', function () {
    $team = Team::factory()->create();
    $robot = TeamRobot::factory()->create(['team_id' => $team->id]);
    $tickets = Ticket::factory()->count(3)->create(['team_id' => $team->id]);

    Sanctum::actingAs($robot, ['*']);

    $response = $this->getJson(route('api.tickets.index'));

    $response->assertOk()
        ->assertJsonCount(3);
});

test('robot can view specific ticket via api', function () {
    $team = Team::factory()->create();
    $robot = TeamRobot::factory()->create(['team_id' => $team->id]);
    $ticket = Ticket::factory()->create(['team_id' => $team->id]);

    Sanctum::actingAs($robot, ['*']);

    $response = $this->getJson(route('api.tickets.show', $ticket));

    $response->assertOk()
        ->assertJson(['id' => $ticket->id, 'title' => $ticket->title]);
});

test('robot cannot view ticket from another team', function () {
    $team = Team::factory()->create();
    $robot = TeamRobot::factory()->create(['team_id' => $team->id]);

    $otherTeam = Team::factory()->create();
    $otherTicket = Ticket::factory()->create(['team_id' => $otherTeam->id]);

    Sanctum::actingAs($robot, ['*']);

    $response = $this->getJson(route('api.tickets.show', $otherTicket));

    $response->assertNotFound();
});

test('robot can update ticket via api', function () {
    $team = Team::factory()->create();
    $robot = TeamRobot::factory()->create(['team_id' => $team->id]);
    $ticket = Ticket::factory()->create(['team_id' => $team->id]);

    Sanctum::actingAs($robot, ['*']);

    $response = $this->patchJson(route('api.tickets.update', $ticket), [
        'status' => 'closed',
        'priority' => 'high',
    ]);

    $response->assertOk();

    $this->assertDatabaseHas('tickets', [
        'id' => $ticket->id,
        'status' => 'closed',
        'priority' => 'high',
    ]);
});

test('robot cannot update ticket from another team', function () {
    $team = Team::factory()->create();
    $robot = TeamRobot::factory()->create(['team_id' => $team->id]);

    $otherTeam = Team::factory()->create();
    $otherTicket = Ticket::factory()->create(['team_id' => $otherTeam->id]);

    Sanctum::actingAs($robot, ['*']);

    $response = $this->patchJson(route('api.tickets.update', $otherTicket), [
        'status' => 'closed',
    ]);

    $response->assertNotFound();
});

test('robot can assign ticket to team member', function () {
    $team = Team::factory()->create();
    $robot = TeamRobot::factory()->create(['team_id' => $team->id]);
    $member = User::factory()->create();
    $team->users()->attach($member);

    $ticket = Ticket::factory()->create(['team_id' => $team->id]);

    Sanctum::actingAs($robot, ['*']);

    $response = $this->patchJson(route('api.tickets.update', $ticket), [
        'assigned_id' => $member->id,
    ]);

    $response->assertOk();

    $this->assertDatabaseHas('tickets', [
        'id' => $ticket->id,
        'assigned_id' => $member->id,
    ]);
});

test('robot cannot assign ticket to non-member', function () {
    $team = Team::factory()->create();
    $robot = TeamRobot::factory()->create(['team_id' => $team->id]);
    $nonMember = User::factory()->create(); // Not in team

    $ticket = Ticket::factory()->create(['team_id' => $team->id]);

    Sanctum::actingAs($robot, ['*']);

    $response = $this->patchJson(route('api.tickets.update', $ticket), [
        'assigned_id' => $nonMember->id,
    ]);

    $response->assertNotFound(); // Your controller aborts 404

    $this->assertDatabaseHas('tickets', [
        'id' => $ticket->id,
        'assigned_id' => null,
    ]);
});

test('robot can list team members via api', function () {
    $team = Team::factory()->create();
    $robot = TeamRobot::factory()->create(['team_id' => $team->id]);
    $member1 = User::factory()->create();
    $member2 = User::factory()->create();
    $team->users()->attach([$member1->id, $member2->id]);

    Sanctum::actingAs($robot, ['*']);

    $response = $this->getJson(route('api.team.members'));

    $response->assertOk()
        ->assertJsonCount(2);
});

test('team admin can delete robot', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user, ['is_admin' => true]);
    $robot = TeamRobot::factory()->create(['team_id' => $team->id]);

    $this->actingAs($user)
        ->delete(route('robots.destroy', [$team, $robot]))
        ->assertRedirect();

    $this->assertDatabaseMissing('team_robots', ['id' => $robot->id]);
});

test('cannot delete robot from another team', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user, ['is_admin' => true]);

    $otherTeam = Team::factory()->create();
    $otherRobot = TeamRobot::factory()->create(['team_id' => $otherTeam->id]);

    $this->actingAs($user)
        ->delete(route('robots.destroy', [$team, $otherRobot]))
        ->assertNotFound();

    $this->assertDatabaseHas('team_robots', ['id' => $otherRobot->id]);
});
