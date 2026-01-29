<?php

use App\Models\Team;
use App\Models\Ticket;
use App\Models\User;

it('redirects back to portal when commenting from portal', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create(['is_private' => false]);
    $ticket = Ticket::factory()->create(['team_id' => $team->id]);

    $portalUrl = route('portal.tickets.show', [$team->slug, $ticket]);
    
    $this->actingAs($user)
        ->from($portalUrl) // Simulate coming from the portal
        ->post(route('tickets.comments.store', [$team, $ticket]), [
            'body' => 'This is a comment',
        ])
        ->assertRedirect($portalUrl);
});

it('redirects back to dashboard when commenting from dashboard', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $team->users()->attach($user);
    $ticket = Ticket::factory()->create(['team_id' => $team->id]);

    $dashboardUrl = route('tickets.show', [$team, $ticket]);
    
    $this->actingAs($user)
        ->from($dashboardUrl)
        ->post(route('tickets.comments.store', [$team, $ticket]), [
            'body' => 'This is a comment',
        ])
        ->assertRedirect($dashboardUrl);
});
