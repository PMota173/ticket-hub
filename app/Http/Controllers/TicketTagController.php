<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Team;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketTagController extends Controller
{
    public function store(Request $request, Team $team, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $tag = $team->tags()->firstOrCreate(['name' => $attributes['name']]);

        $ticket->tags()->syncWithoutDetaching($tag);

        return back();
    }

    public function destroy(Team $team, Ticket $ticket, Tag $tag)
    {
        $this->authorize('update', $ticket);

        $ticket->tags()->detach($tag);

        return back();
    }
}
