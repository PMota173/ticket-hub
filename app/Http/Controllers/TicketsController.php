<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Team;
use App\Models\Ticket;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Team $team)
    {
        $this->authorize('viewAny', [Ticket::class, $team]);

        $tickets = $team->tickets()->with(['assignee', 'author', 'tags'])->get();

        return view('tickets.index', compact('team', 'tickets'));
    }

    /**
     * Display the triage inbox.
     */
    public function inbox(Team $team)
    {
        $this->authorize('viewAny', [Ticket::class, $team]);

        $tickets = $team->tickets()
            ->where('status', \App\Enums\TicketStatus::TRIAGE)
            ->with(['author', 'tags'])
            ->latest()
            ->get();

        return view('tickets.inbox', compact('team', 'tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Team $team)
    {
        $this->authorize('create', [Ticket::class, $team]);

        $members = $team->users()->get();

        return view('tickets.create', compact('team', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request, Team $team)
    {
        $this->authorize('create', [Ticket::class, $team]);

        $attributes = $request->validated();
        $attributes['author_id'] = auth()->id();
        $attributes['author_type'] = \App\Models\User::class;

        // Security: Non-members cannot assign tickets
        if (! $team->users->contains(auth()->user())) {
            unset($attributes['assigned_id']);
        }

        $team->tickets()->create($attributes);

        return redirect()->route('tickets.index', $team);
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team, Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        $ticket->load(['comments.author', 'activityLogs.actor', 'author', 'tags', 'assignee']);

        return view('tickets.show', compact('team', 'ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $members = $team->users()->get();

        return view('tickets.edit', compact('team', 'ticket', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Team $team, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $attributes = $request->validated();

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
        $this->authorize('delete', $ticket);

        $ticket->delete();

        return redirect()->route('tickets.index', $team);
    }
}
