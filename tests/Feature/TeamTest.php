<?php

use App\Models\Team;
use App\Models\User;

test('a user can see the teams list', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('teams.index'));

    $response->assertStatus(200);
    $response->assertSee('My Teams');
});

test('a user can see the create team form', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('teams.create'));

    $response->assertStatus(200);
    $response->assertSee('Create New Team');
});

test('a user can create a team', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('teams.store'), [
        'name' => 'Acme Corp',
        'description' => 'The best company ever.',
    ]);

    $response->assertRedirect(route('teams.index'));

    $this->assertDatabaseHas('teams', [
        'name' => 'Acme Corp',
        'slug' => 'acme-corp',
        'description' => 'The best company ever.',
        'user_id' => $user->id,
    ]);

    // Check if the user was attached to the team as admin
    $team = Team::where('name', 'Acme Corp')->first();

    $this->assertDatabaseHas('team_user', [
        'team_id' => $team->id,
        'user_id' => $user->id,
        'is_admin' => true,
    ]);
});

test('a user can create a private team', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('teams.store'), [
        'name' => 'Secret Lab',
        'is_private' => '1',
    ]);

    $response->assertRedirect(route('teams.index'));

    $this->assertDatabaseHas('teams', [
        'name' => 'Secret Lab',
        'is_private' => true,
    ]);
});
