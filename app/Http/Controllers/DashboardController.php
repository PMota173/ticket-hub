<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $teams = request()->user()->teams()->withCount(['users', 'tickets'])->get();

        return view('dashboard', compact('teams'));
    }
}
