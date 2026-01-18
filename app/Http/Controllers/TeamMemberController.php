<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamMemberRequest;
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
        // this is now handled by the TeamPolicy
        $this->authorize('viewAnyMembers', $team);

        $members = $team->users()->get();
        $isTeamAdmin = $team->hasAdmin(auth()->user());

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
        $this->authorize('view', $team);

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
        $this->authorize('updateMember', [$team, $member]);

        $memberWithPivot = $team->users()->where('user_id', $member->id)->first();

        if (!$memberWithPivot) {
            abort(404, 'Member not found in this team.');
        }

        $is_admin = $team->hasAdmin(auth()->user());
        $member_since = $memberWithPivot->pivot->created_at;

        return view('teams.members.edit', compact('team', 'member', 'is_admin', 'member_since'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamMemberRequest $request, Team $team, User $member)
    {
        // 1. Validate request is now on store request
        $request->validated();

        // 2. Authorization:
        $this->authorize('updateMember', [$team, $member]);

        // 3. Update member role
        $team->users()->updateExistingPivot($member->id, [
            'is_admin' => $request->input('is_admin'),
        ]);

        return redirect()->route('members.show', ['team' => $team->slug, 'member' => $member->id])
            ->with('status', 'Member role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team, User $member)
    {

        // 1. Use policy to authorize
        $this->authorize('removeMember', [$team, $member]);

        // 2. Detach
        $team->users()->detach($member->id);

        $members = $team->users()->get();

//        return view('teams.members.index', compact('team', 'members'));
        return redirect()->route('members.index', ['team' => $team->slug])
            ->with('status', 'Member removed successfully.');
    }
}
