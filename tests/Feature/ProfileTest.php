<?php

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('public profile page can be rendered', function () {
    $user = User::factory()->create();
    $viewer = User::factory()->create();

    $response = $this->actingAs($viewer)->get(route('users.show', $user));

    $response->assertOk();
    $response->assertSee($user->name);
});

test('public profile shows public teams', function () {
    $user = User::factory()->create();
    $viewer = User::factory()->create();
    
    $publicTeam = Team::factory()->create(['user_id' => $user->id, 'is_private' => false]);
    $privateTeam = Team::factory()->create(['user_id' => $user->id, 'is_private' => true]);

    $user->teams()->attach([$publicTeam->id, $privateTeam->id]);

    $response = $this->actingAs($viewer)->get(route('users.show', $user));

    $response->assertSee($publicTeam->name);
    $response->assertDontSee($privateTeam->name);
});

test('profile page shows bio information', function () {
    $user = User::factory()->create([
        'bio' => 'I am a software engineer.',
    ]);
    $viewer = User::factory()->create();

    $response = $this->actingAs($viewer)->get(route('users.show', $user));

    $response->assertSee('I am a software engineer.');
});

test('profile information can be updated', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => 'Test User Updated',
            'bio' => 'Updated bio information.',
        ]);

    $response->assertRedirect(route('users.show', $user));
    
    $user->refresh();

    expect($user->name)->toBe('Test User Updated');
    expect($user->bio)->toBe('Updated bio information.');
});

test('avatar can be uploaded', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    // Use create() instead of image() to avoid GD dependency
    $file = UploadedFile::fake()->create('avatar.jpg', 100);

    $response = $this->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => $user->name,
            'avatar' => $file,
        ]);

    $response->assertRedirect(route('users.show', $user));

    $user->refresh();

    expect($user->avatar_path)->not->toBeNull();
    Storage::disk('public')->assertExists($user->avatar_path);
});

test('old avatar is deleted when replacing', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $oldFile = UploadedFile::fake()->create('old_avatar.jpg', 100);
    
    // Upload first avatar
    $this->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => $user->name,
            'avatar' => $oldFile,
        ]);
        
    $user->refresh();
    $oldPath = $user->avatar_path;
    Storage::disk('public')->assertExists($oldPath);

    // Upload second avatar
    $newFile = UploadedFile::fake()->create('new_avatar.jpg', 100);
    $this->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => $user->name,
            'avatar' => $newFile,
        ]);

    $user->refresh();

    expect($user->avatar_path)->not->toBe($oldPath);
    Storage::disk('public')->assertExists($user->avatar_path);
    Storage::disk('public')->assertMissing($oldPath);
});
