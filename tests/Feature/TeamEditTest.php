<?php

use App\Models\Team;
use App\Models\User;

test('admin can view edit team page', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create(['user_id' => $user->id]);
    $team->users()->attach($user, ['is_admin' => true]);

    $this->actingAs($user)
        ->get(route('teams.edit', $team))
        ->assertOk()
        ->assertSee($team->name);
});

test('non-admin cannot view edit team page', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user, ['is_admin' => false]);

    $this->actingAs($user)
        ->get(route('teams.edit', $team))
        ->assertForbidden();
});

test('admin can update team details', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create(['user_id' => $user->id]);
    $team->users()->attach($user, ['is_admin' => true]);

    $this->actingAs($user)
        ->patch(route('teams.update', $team), [
            'name' => 'Updated Team Name',
            'description' => 'Updated Description',
            'is_private' => 1,
        ])
        ->assertRedirect(route('teams.show', $team));

    $team->refresh();
    expect($team->name)->toBe('Updated Team Name')
        ->and($team->description)->toBe('Updated Description')
        ->and($team->is_private)->toEqual(1);
});

test('admin can uncheck private status', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create([
        'user_id' => $user->id,
        'is_private' => true
    ]);
    $team->users()->attach($user, ['is_admin' => true]);

    $this->actingAs($user)
        ->patch(route('teams.update', $team), [
            'name' => 'Updated Team Name',
            // is_private is omitted (unchecked)
        ])
        ->assertRedirect(route('teams.show', $team));

    $team->refresh();
    expect($team->is_private)->toEqual(0);
});

test('non-admin cannot update team details', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user, ['is_admin' => false]);

    $this->actingAs($user)
        ->patch(route('teams.update', $team), [
            'name' => 'Updated Team Name',
        ])
        ->assertForbidden();
});
