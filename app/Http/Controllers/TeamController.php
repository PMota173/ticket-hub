<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = request()->user()->teams()->withCount(['users', 'tickets'])->get();

        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        $attributes = $request->validated();

        $user = $request->user();
        $attributes['user_id'] = $user->id;

        $team = Team::create($attributes);
        $team->users()->attach($user->id, ['is_admin' => true]);

        return redirect(route('teams.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        // Check if user belongs to team
        // this is now handled by the TeamPolicy
        $this->authorize('view', $team);

        $stats = [
            'open' => $team->tickets()->open()->count(),
            'in_progress' => $team->tickets()->inProgress()->count(),
            'waiting' => $team->tickets()->waiting()->count(),
            'closed' => $team->tickets()->closed()->count(),
        ];

        $recentTickets = $team->tickets()
            ->with('assignee')
            ->latest()
            ->limit(10)
            ->get();

        $myTickets = $team->tickets()
            ->where('assigned_id', auth()->id())
            ->with('user')
            ->latest()
            ->limit(6)
            ->get();

        return view('teams.dashboard', compact('team', 'stats', 'recentTickets', 'myTickets'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
