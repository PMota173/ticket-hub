<?php

use App\Models\Team;
use App\Models\Ticket;
use App\Models\User;
use App\Models\ActivityLog;
use App\Enums\TicketStatus;
use App\Enums\TicketPriority;

beforeEach(function () {
    $this->team = Team::factory()->create();
    $this->user = User::factory()->create();
    $this->team->users()->attach($this->user, ['is_admin' => true]);
});

it('logs ticket creation', function () {
    $this->actingAs($this->user);

    $ticket = Ticket::create([
        'team_id' => $this->team->id,
        'title' => 'New Issue',
        'description' => 'Test description',
        'status' => TicketStatus::OPEN,
        'priority' => TicketPriority::MEDIUM,
        'author_id' => $this->user->id,
        'author_type' => User::class,
    ]);

    expect(ActivityLog::count())->toBe(1)
        ->and(ActivityLog::first()->action)->toBe('created')
        ->and(ActivityLog::first()->ticket_id)->toBe($ticket->id)
        ->and(ActivityLog::first()->actor_id)->toBe($this->user->id);
});

it('logs status change', function () {
    $this->actingAs($this->user);

    $ticket = Ticket::factory()->create([
        'team_id' => $this->team->id,
        'author_id' => $this->user->id,
        'status' => TicketStatus::OPEN,
    ]);

    // Clear the creation log to focus on the update log
    ActivityLog::truncate();

    $ticket->update(['status' => TicketStatus::IN_PROGRESS]);

    $log = ActivityLog::first();

    expect(ActivityLog::count())->toBe(1)
        ->and($log->action)->toBe('updated')
        ->and($log->field)->toBe('status')
        ->and($log->old_value)->toBe('open')
        ->and($log->new_value)->toBe('in_progress')
        ->and($log->actor_id)->toBe($this->user->id);
});

it('logs priority change', function () {
    $this->actingAs($this->user);

    $ticket = Ticket::factory()->create([
        'team_id' => $this->team->id,
        'author_id' => $this->user->id,
        'priority' => TicketPriority::LOW,
    ]);

    ActivityLog::truncate();

    $ticket->update(['priority' => TicketPriority::HIGH]);

    $log = ActivityLog::first();

    expect(ActivityLog::count())->toBe(1)
        ->and($log->field)->toBe('priority')
        ->and($log->old_value)->toBe('low')
        ->and($log->new_value)->toBe('high');
});

it('logs assignment change', function () {
    $this->actingAs($this->user);
    $agent = User::factory()->create();

    $ticket = Ticket::factory()->create([
        'team_id' => $this->team->id,
        'author_id' => $this->user->id,
        'assigned_id' => null,
    ]);

    ActivityLog::truncate();

    $ticket->update(['assigned_id' => $agent->id]);

    $log = ActivityLog::first();

    expect(ActivityLog::count())->toBe(1)
        ->and($log->field)->toBe('assigned_id')
        ->and($log->old_value)->toBeEmpty()
        ->and($log->new_value)->toBe((string) $agent->id);
});

it('does not log unaffected fields', function () {
    $this->actingAs($this->user);

    $ticket = Ticket::factory()->create([
        'team_id' => $this->team->id,
        'author_id' => $this->user->id,
        'title' => 'Original Title',
    ]);

    ActivityLog::truncate();

    $ticket->update(['title' => 'New Title', 'description' => 'New description']);

    // title and description should NOT trigger an activity log
    expect(ActivityLog::count())->toBe(0);
});
