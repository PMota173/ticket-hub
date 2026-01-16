<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __invoke()
    {
        $user = request()->user();

        $stats = [
            'in_progress' => $user->tickets()->where('status', 'in_progress')->count(),
            'open' => $user->tickets()->where('status', 'open')->count(),
            'waiting' => $user->tickets()->where('status', 'waiting')->count(),
            'closed' => $user->tickets()->where('status', 'closed')->count(),
        ];

        $recentTickets = $user->tickets()->latest()->limit(10)->get();

        return view('dashboard', [
            'stats' => $stats,
            'recentTickets' => $recentTickets,
        ]);
    }
}
