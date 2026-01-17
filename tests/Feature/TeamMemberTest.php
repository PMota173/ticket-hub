<?php

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;

// --- INDEX ---

test('users can view team members list', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create(['user_id' => $user->id]);
    $team->users()->attach($user, ['is_admin' => true]);

    $otherMember = User::factory()->create();
    $team->users()->attach($otherMember, ['is_admin' => false]);

    $this->actingAs($user)
        ->get(route('members.index', $team))
        ->assertOk()
        ->assertSee($user->name)
        ->assertSee($otherMember->name);
});

test('users outside the team cannot view members list', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create(); 
    // User is NOT attached to the team

    $this->actingAs($user)
        ->get(route('members.index', $team))
        ->assertForbidden();
});

// --- SHOW ---

test('users can view a specific member profile', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create(['user_id' => $user->id]);
    $team->users()->attach($user, ['is_admin' => false]);

    $targetMember = User::factory()->create();
    $team->users()->attach($targetMember, ['is_admin' => false]);

    $this->actingAs($user)
        ->get(route('members.show', ['team' => $team, 'member' => $targetMember]))
        ->assertOk()
        ->assertSee($targetMember->name)
        ->assertSee($targetMember->email);
});

test('users cannot view profile of a user who is NOT in the team', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create(['user_id' => $user->id]);
    $team->users()->attach($user, ['is_admin' => true]);

    $outsider = User::factory()->create();
    // Outsider is NOT in the team

    $this->actingAs($user)
        ->get(route('members.show', ['team' => $team, 'member' => $outsider]))
        ->assertNotFound(); 
});

test('users outside the team cannot view any member profile', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    
    $member = User::factory()->create();
    $team->users()->attach($member);

    // User is NOT in the team
    $this->actingAs($user)
        ->get(route('members.show', ['team' => $team, 'member' => $member]))
        ->assertForbidden();
});

// --- DESTROY ---

test('admins can remove members', function () {
    $admin = User::factory()->create();
    $team = Team::factory()->create(['user_id' => $admin->id]);
    $team->users()->attach($admin, ['is_admin' => true]);

    $memberToRemove = User::factory()->create();
    $team->users()->attach($memberToRemove, ['is_admin' => false]);

    $this->actingAs($admin)
        ->withoutMiddleware(ValidateCsrfToken::class)
        ->delete(route('members.destroy', ['team' => $team, 'member' => $memberToRemove]))
        ->assertRedirect();

    expect($team->users()->where('user_id', $memberToRemove->id)->exists())->toBeFalse();
});

test('non-admins cannot remove members', function () {
    $member = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($member, ['is_admin' => false]);

    $otherMember = User::factory()->create();
    $team->users()->attach($otherMember, ['is_admin' => false]);

    $this->actingAs($member)
        ->withoutMiddleware(ValidateCsrfToken::class)
        ->delete(route('members.destroy', ['team' => $team, 'member' => $otherMember]))
        ->assertForbidden();

    expect($team->users()->where('user_id', $otherMember->id)->exists())->toBeTrue();
});

test('users cannot remove themselves', function () {
    $admin = User::factory()->create();
    $team = Team::factory()->create(['user_id' => $admin->id]);
    $team->users()->attach($admin, ['is_admin' => true]);

    $this->actingAs($admin)
        ->withoutMiddleware(ValidateCsrfToken::class)
        ->delete(route('members.destroy', ['team' => $team, 'member' => $admin]))
        ->assertSessionHas('error');

    expect($team->users()->where('user_id', $admin->id)->exists())->toBeTrue();
});
