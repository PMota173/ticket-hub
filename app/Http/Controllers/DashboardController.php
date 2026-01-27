<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = request()->user();
        $teams = $user->teams()->withCount(['users', 'tickets'])->get();

        $teamIds = $teams->pluck('id');

        $recentTickets = Ticket::whereIn('team_id', $teamIds)
            ->with(['author', 'team', 'assignee'])
            ->latest()
            ->limit(10)
            ->get();

        $myAssignedTickets = Ticket::where('assigned_id', $user->id)
            ->with(['author', 'team'])
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact('teams', 'recentTickets', 'myAssignedTickets'));
    }
}
