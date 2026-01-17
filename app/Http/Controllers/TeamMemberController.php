<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Team $team)
    {
        // Check if user belongs to team
        if (! $team->users->contains(auth()->user())) {
            abort(403);
        }

        $members = $team->users()->get();
        $currentUser = $team->users()->where('user_id', auth()->id())->first();
        $isTeamAdmin = $currentUser ? $currentUser->pivot->is_admin : false;

        return view('teams.members.index', compact('team', 'members', 'isTeamAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug, string $id)
    {
        $member = User::findOrFail($id);

        $team = Team::where('slug', $slug)->firstOrFail();

        $is_admin = $member->teams()->where('team_id', $team->id)->first()->pivot->is_admin;

        $member_since = $member->teams()->where('team_id', $team->id)->first()->pivot->created_at;

        return view('teams.members.show', compact('team', 'member', 'is_admin', 'member_since'));
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
    public function destroy(Team $team, User $member)
    {
        // 1. Authorization: Only team admins can remove members
        $currentUser = $team->users()->where('user_id', auth()->id())->first();

        if (! $currentUser || ! $currentUser->pivot->is_admin) {
            abort(403, 'You do not have permission to remove members.');
        }

        // 2. Prevent removing yourself
        if ($member->id === auth()->id()) {
            return back()->with('error', 'You cannot remove yourself from the team.');
        }

        // 3. Detach
        $team->users()->detach($member->id);

        return back()->with('status', 'Member removed successfully.');
    }
}
