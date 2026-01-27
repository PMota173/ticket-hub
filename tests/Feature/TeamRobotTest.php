<?php

use App\Models\Team;
use App\Models\TeamRobot;
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
        ->assertSee('Create New Robot');
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

    // Simulate robot authentication
    Sanctum::actingAs($robot, ['*']);

    $response = $this->postJson('/api/v1/tickets', [
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
        ->assertNotFound(); // Should return 404 because of route binding or manual check

    $this->assertDatabaseHas('team_robots', ['id' => $otherRobot->id]);
});
