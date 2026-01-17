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
        if (!$team->users()->where('user_id', auth()->id())->exists()) {
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
    public function show(Team $team, User $member)
    {
        // 1. Authorize: Check if auth user belongs to team
        if (!$team->users()->where('user_id', auth()->id())->exists()) {
            abort(403);
        }

        // 2. Validate: Check if the target member belongs to the team
        // fetch the pivot data here so it's available in the view
        $memberWithPivot = $team->users()->where('user_id', $member->id)->first();

        if (!$memberWithPivot) {
            abort(404, 'Member not found in this team.');
        }

        // 3. Extract attributes from the pivot
        $is_admin = $memberWithPivot->pivot->is_admin;
        $member_since = $memberWithPivot->pivot->created_at;

        return view('teams.members.show', compact('team', 'member', 'is_admin', 'member_since'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team, User $member)
    {
        // 1. Authorize: Check if auth user belongs to team
        if (!$team->users()->where('user_id', auth()->id())->exists()) {
            abort(403);
        }

        // 2. Validate: Check if the target member belongs to the team
        // fetch the pivot data here so it's available in the view
        $memberWithPivot = $team->users()->where('user_id', $member->id)->first();

        if (!$memberWithPivot) {
            abort(404, 'Member not found in this team.');
        }

        if ($member->id === auth()->id()) {
            return back()->with('error', 'You cannot edit your own membership.');
        }

        // 3. Authorization: Only team admins can edit members
        if (!$team->users()->where('user_id', auth()->id())->first()->pivot->is_admin) {
            abort(403, 'You do not have permission to edit members.');
        }

        $is_admin = $memberWithPivot->pivot->is_admin;
        $member_since = $memberWithPivot->pivot->created_at;

        return view('teams.members.edit', compact('team', 'member', 'is_admin', 'member_since'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team, User $member)
    {
        // 1. Validate request
        $request->validate([
            'is_admin' => ['required', 'boolean'],
        ]);

        // 2. Authorization:
        // member and user must belong to team
        if (!$team->users()->where('user_id', $member->id)->exists() || !$team->users()->where('user_id',
                auth()->id())->exists()) {
            abort(404);
        }

        // user must be admin
        if (!$team->users()->where('user_id', auth()->id())->first()->pivot->is_admin) {
            abort(403, 'You do not have permission to update members.');
        }

        // cannot update self
        if ($member->id === auth()->id()) {
            return back()->with('error', 'You cannot update your own membership.');
        }

        // 3. Update member role
        $team->users()->updateExistingPivot($member->id, [
            'is_admin' => $request->input('is_admin'),
        ]);

        return redirect()->route('members.index', ['team' => $team->id])
            ->with('status', 'Member role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team, User $member)
    {
        // 1. Authorization: Only team admins can remove members
        $currentUser = $team->users()->where('user_id', auth()->id())->first();

        if (!$currentUser || !$currentUser->pivot->is_admin) {
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
