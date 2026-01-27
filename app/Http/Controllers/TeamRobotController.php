<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamRobotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Team $team)
    {
        $this->authorize('update', $team);

        $robots = $team->robots()->orderBy('created_at', 'desc')->get();

        return view('teams.robots.index', [
            'team' => $team,
            'robots' => $robots,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Team $team)
    {
        $this->authorize('update', $team);

        if ($team->robots()->count() >= 3)
        {
            return back()->with('error', 'You can only have 3 robots per team.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $robot = $team->robots()->create(['name' => $request->name]);

        $token = $robot->createToken('default-token')->plainTextToken;

        return back()->with('robot_token', $token);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(Team $team, string $id)
    {
        $robot = $team->robots()->findOrFail($id);

        $this->authorize('update', $team);

        if ($robot->team_id !== $team->id) {
            abort(404);
        }

        $robot->delete();

        return redirect()->route('robots.index', $team);
    }
}
