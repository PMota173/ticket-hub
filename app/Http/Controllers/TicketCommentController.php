<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Team;
use App\Models\Ticket;

class TicketCommentController extends Controller
{
    public function store(StoreCommentRequest $request, Team $team, Ticket $ticket)
    {
        $attributes = $request->validated();

        $attributes['author_id'] = auth()->id();
        $attributes['author_type'] = \App\Models\User::class;

        $attributes['ticket_id'] = $ticket->id;
        unset($attributes['attachments']);

        $comment = Comment::create($attributes);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments', 'public');
                $comment->attachments()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ]);
            }
        }

        return redirect()->back();
    }

    public function destroy(Team $team, Ticket $ticket, Comment $comment)
    {
        $comment = Comment::findOrFail($comment->id);

        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->back();
    }
}
