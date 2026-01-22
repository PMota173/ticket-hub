<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamInvitationRequest;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamInvitationController extends Controller
{
    public function index(Request $request, Team $team)
    {
        $this->authorize('view', $team);

        $invitations = $team->invites()
            ->with('invitedBy')        // Eager load
            ->whereNull('accepted_at')
            ->latest()
            ->get();

        return view('teams.invitations.index', compact('team', 'invitations'));
    }

    public function create(Request $request, Team $team)
    {
        $this->authorize('view', $team);

        return view('teams.invitations.create', compact('team'));
    }

    public function show(Request $request, Team $team, TeamInvitation $invitation)
    {
        //
    }

    public function store(StoreTeamInvitationRequest $request, Team $team)
    {
        $this->authorize('addMember', $team);

        $attributes = $request->validated();

        $attributes['team_id'] = $team->id;
        $attributes['invited_by'] = auth()->id();

        // I am not sure if this is the best choice to a token with 64 chars
        $attributes['token'] = Str::random(64);

        $invitation = TeamInvitation::create($attributes);

        // notification (email with link) to be done

        // route teams.invitations.index is to be created too
        return redirect()->route('invitations.index', compact('team'));
    }

    public function destroy(Request $request, Team $team, TeamInvitation $invitation)
    {
        $this->authorize('deleteInvitation', [$team, $invitation]);

        $invitation->delete();

        // redirect back
        return redirect()->back();
    }

    public function accept(string $token)
    {
        // get invitation
        $invitation = TeamInvitation::where('token', $token)->firstOrFail();

        $team = $invitation->team;

        // verify if invite is still valid
        if ($invitation->expires_at && $invitation->expires_at->isPast()) {
            abort(403, 'This invitation has expired.');
        }

        // if the invite has already been accepted, redirect to the dashboard
        if ($invitation->accepted_at) {
            return redirect()->route('dashboard')->with('status', 'You have already accepted this invitation.');
        }

        // if the user is logged in
        if (auth()->check()) {
            $user = auth()->user();

            // check if it is the correct email
            if ($user->email !== $invitation->email) {
                abort(403, 'This invitation is for '.$invitation->email.' but you are logged as '.$user->email);
            }

            // if not, accept the invite
            $invitation->team->users()->attach($user);
            $invitation->update(['accepted_at' => now()]);

            return redirect()->route('dashboard')->with('status', 'You have accepted this invitation.');
        }

        // if the user with the email on invite exists
        // redirect to log in
        // else redirect to registration
        $userExists = User::where('email', $invitation->email)->exists();

        session()->put('url.intended', url()->current());

        if ($userExists) {
            return redirect()->route('login')->with('status', 'Please login to accept your invitation');
        } else {
            return redirect()->route('register', ['email' => $invitation->email]);
        }

    }

    public function myInvitations(Request $request)
    {
        $invitations = TeamInvitation::where('email', auth()->user()->email)
            ->whereNull('accepted_at')
            ->with(['team', 'invitedBy'])
            ->latest()
            ->get();

        return view('my-invitations.index', compact('invitations'));
    }

    public function decline(TeamInvitation $invitation)
    {
        // Ensure the invitation belongs to the current user
        if ($invitation->email !== auth()->user()->email) {
            abort(403);
        }

        $invitation->delete();

        return redirect()->route('my-invitations.index')->with('status', 'Invitation declined.');
    }

}
