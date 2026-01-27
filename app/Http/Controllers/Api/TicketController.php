<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeamRobot;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $robot = request()->user();

        $tickets = Ticket::where('team_id', $robot->team_id)->get();

        return response()->json($tickets, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $robot = $request->user();

        $attributes = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['nullable', 'string'],
            'assigned_id' => ['nullable', 'exists:users,id'],
        ]);

        if (isset($attributes['assigned_id']))
        {
            $isMember = $robot->team->users()->where('user_id', $attributes['assigned_id'])->exists();

            if (! $isMember) {
                abort(404, 'The assigned user is not a member of the team.');
            }
        }

        $ticket = Ticket::create([
            'title' => $attributes['title'],
            'description' => $attributes['description'],
            'priority' => $attributes['priority'] ?? 'low',
            'team_id' => $robot->team_id,
            'author_id' => $robot->id,
            'author_type' => get_class($robot),
            'assigned_id' => $attributes['assigned_id'] ?? null,
        ]);

        return response()->json($ticket, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        if ($ticket->team_id !== request()->user()->team_id) {
            abort(404, 'You are not authorized to view this ticket.');
        }

        return response()->json($ticket, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $robot = $request->user();

        if ($ticket->team_id !== $robot->team_id) {
            abort(404, 'You are not authorized to update this ticket.');
        }

        $attributes = $request->validate([
            'title' => ['string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
            'assigned_id' => ['nullable', 'exists:users,id'],
        ]);

        if (isset($attributes['assigned_id']))
        {
            $isMember = $robot->team->users()->where('user_id', $attributes['assigned_id'])->exists();

            if (! $isMember) {
                abort(404, 'The assigned user is not a member of the team.');
            }
        }

        $ticket->update($attributes);

        return response()->json($ticket, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
