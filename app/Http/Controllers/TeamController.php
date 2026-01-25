<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function edit(Team $team)
    {
        $user = auth()->user();

        $this->authorize('update', $team);

        return view('teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
       $this->authorize('update', $team);

        $attributes = $request->validated();

        if ($request->hasFile('logo')) {

            if ($team->logo) {
                Storage::disk('public')->delete($team->logo);
            }

            // stores the image
            $path = $request->file('logo')->store('team-logos', 'public');

            // updates the attributes
            $attributes['logo'] = $path;
        }

        $attributes['is_private'] = $request->has('is_private');

        $team->update($attributes);

        return redirect(route('teams.show', $team))->with('status', 'Team updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
