<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Team;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketCommentController extends Controller
{
    public function store(StoreCommentRequest $request, Team $team, Ticket $ticket)
    {
        $attributes = $request->validated();

        $user_id = auth()->id();
        $attributes['user_id'] = $user_id;

        $attributes['ticket_id'] = $ticket->id;

        Comment::create($attributes);

        return redirect(route('tickets.show', [$team, $ticket]));
    }

    public function destroy(Team $team, Ticket $ticket, Comment $comment)
    {
        $comment = Comment::findOrFail($comment->id);

        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect(route('tickets.show', [$team, $ticket]));
    }
}
