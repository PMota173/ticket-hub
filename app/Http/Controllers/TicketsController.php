<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Team $team)
    {
        $this->authorizeTeamAccess($team);

        $tickets = $team->tickets()->get();

        return view('tickets.index', compact('team', 'tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Team $team)
    {
        $this->authorizeTeamAccess($team);

        return view('tickets.create', compact('team'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Team $team)
    {
        $this->authorizeTeamAccess($team);

        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'priority' => ['required', 'in:low,medium,high'],
        ]);

        $team->tickets()->create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('tickets.index', $team);
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team, Ticket $ticket)
    {
        $this->authorizeTeamAccess($team);
        $this->authorizeTicketAccess($team, $ticket);

        return view('tickets.show', compact('team', 'ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team, Ticket $ticket)
    {
        $this->authorizeTeamAccess($team);
        $this->authorizeTicketAccess($team, $ticket);

        return view('tickets.edit', compact('team', 'ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team, Ticket $ticket)
    {
        $this->authorizeTeamAccess($team);
        $this->authorizeTicketAccess($team, $ticket);

        $attributes = $request->validate([
            'title' => ['sometimes', 'required'],
            'description' => ['sometimes', 'required'],
            'priority' => ['sometimes', 'required', 'in:low,medium,high'],
            'status' => ['sometimes', 'required', 'in:open,in_progress,waiting,closed'],
        ]);

        $ticket->update($attributes);

        if ($request->has('status') && ! $request->has('title')) {
            return back();
        }

        return redirect()->route('tickets.show', [$team, $ticket]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team, Ticket $ticket)
    {
        $this->authorizeTeamAccess($team);
        $this->authorizeTicketAccess($team, $ticket);

        $ticket->delete();

        return redirect()->route('tickets.index', $team);
    }

    protected function authorizeTeamAccess(Team $team): void
    {
        if (! $team->users->contains(auth()->user())) {
            abort(403);
        }
    }

    protected function authorizeTicketAccess(Team $team, Ticket $ticket): void
    {
        if ($ticket->team_id !== $team->id) {
            abort(404);
        }
    }
}
