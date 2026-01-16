<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $teams = request()->user()->teams()->get();

        foreach ($teams as $team) {
            $team->is_admin = $team->users()->where('user_id', request()->user()->id)->first()->pivot->is_admin;
            $team->members_count = $team->users()->count();
            $team->tickets_count = $team->tickets()->count();
        }

        return view('dashboard');
    }
}
