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
    $response->assertSee('Create New Workspace');
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

test('duplicate team names get unique slugs', function () {
    $user = User::factory()->create();

    // Create first team
    $this->actingAs($user)->post(route('teams.store'), [
        'name' => 'Acme Corp',
    ]);

    $this->assertDatabaseHas('teams', ['slug' => 'acme-corp']);

    // Create second team with same name
    $this->actingAs($user)->post(route('teams.store'), [
        'name' => 'Acme Corp',
    ]);

    // Verify a second team exists with a different slug
    $teams = \App\Models\Team::where('name', 'Acme Corp')->get();
    expect($teams)->toHaveCount(2)
        ->and($teams[0]->slug)->toBe('acme-corp')
        ->and($teams[1]->slug)->toStartWith('acme-corp-');
});

test('non-member cannot view private team dashboard', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create(['is_private' => true]);

    $this->actingAs($user)
        ->get(route('teams.show', $team))
        ->assertForbidden();
});

// the business logic to this test needs to be validated
//test('non-member can view public team dashboard', function () {
//    $user = User::factory()->create();
//    $team = Team::factory()->create(['is_private' => false]);
//
//    $this->actingAs($user)
//        ->get(route('teams.show', $team))
//        ->assertOk();
//});
