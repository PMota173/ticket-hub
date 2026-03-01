<?php

use App\Models\Team;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('can upload attachments when creating a ticket', function () {
    $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);
    Storage::fake('public');

    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user);

    $file = UploadedFile::fake()->image('screenshot.png');

    $response = $this->actingAs($user)->post(route('tickets.store', $team), [
        'title' => 'Test Ticket',
        'description' => 'Test Description',
        'attachments' => [$file],
    ]);

    $response->dump();

    $response->assertRedirect(route('tickets.index', $team));

    $ticket = Ticket::first();
    expect($ticket->attachments)->toHaveCount(1);

    $attachment = $ticket->attachments->first();
    expect($attachment->file_name)->toBe('screenshot.png');

    Storage::disk('public')->assertExists($attachment->file_path);
});

test('can upload attachments when commenting on a ticket', function () {
    $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);
    Storage::fake('public');

    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user);
    $ticket = Ticket::factory()->create(['team_id' => $team->id]);

    $file = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

    $response = $this->actingAs($user)->post(route('tickets.comments.store', [$team, $ticket]), [
        'body' => 'Here is a document.',
        'attachments' => [$file],
    ]);

    $response->assertRedirect();

    $comment = $ticket->comments->first();
    expect($comment->attachments)->toHaveCount(1);

    $attachment = $comment->attachments->first();
    expect($attachment->file_name)->toBe('document.pdf');

    Storage::disk('public')->assertExists($attachment->file_path);
});
