<?php

namespace App\Http\Controllers;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Http\Requests\StoreTicketRequest;
use App\Models\Team;
use App\Models\Ticket;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function index(Request $request)
    {
        $query = Team::where('is_private', false)
            ->where('is_active', true)
            ->withCount(['members', 'tickets']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        return view('portal.index', [
            'teams' => $query->latest()->paginate(12)->withQueryString(),
            'search' => $search,
        ]);
    }

    public function show(Request $request, Team $team)
    {
        if ($team->is_private) {
            abort(403, 'This team is private.');
        }

        $query = $team->tickets()
            ->with(['author', 'tags']);

        // Search
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sort = $request->query('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'status':
                $query->orderBy('status');
                break;
            case 'priority':
                $query->orderByRaw("CASE priority 
                    WHEN 'urgent' THEN 1 
                    WHEN 'high' THEN 2 
                    WHEN 'medium' THEN 3 
                    WHEN 'low' THEN 4 
                    ELSE 5 END");
                break;
            default: // newest
                $query->latest();
                break;
        }

        $tickets = $query->paginate(10)->withQueryString();

        return view('portal.show', [
            'team' => $team,
            'tickets' => $tickets,
            'currentSort' => $sort,
            'search' => $search,
        ]);
    }

    public function showTicket(Team $team, Ticket $ticket)
    {
        if ($team->is_private) {
            abort(403, 'This team is private.');
        }

        if ($ticket->team_id !== $team->id) {
            abort(404);
        }

        $ticket->load(['author', 'comments.author', 'activityLogs.actor', 'tags']);

        return view('portal.ticket', [
            'team' => $team,
            'ticket' => $ticket,
        ]);
    }

    public function store(StoreTicketRequest $request, Team $team)
    {
        // Policy check: implicitly handled if we use 'can' middleware or authorize manually.
        // But since we want "anyone logged in can create if team is public", we should check that.
        // The TicketPolicy::create method handles this:
        // return !$team->is_private || $user->belongsToTeam($team);

        if ($request->user()->cannot('create', [Ticket::class, $team])) {
            abort(403, 'You are not authorized to create tickets for this team.');
        }

        $ticket = $team->tickets()->make($request->validated());
        $ticket->author()->associate($request->user());
        $ticket->status = TicketStatus::TRIAGE;
        $ticket->priority = TicketPriority::MEDIUM; // Default priority
        $ticket->save();

        return redirect()->route('portal.show', $team)
            ->with('status', 'Ticket created successfully! Reference #'.$ticket->id);
    }
}
