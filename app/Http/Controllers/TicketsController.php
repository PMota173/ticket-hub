<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = request()->user()->tickets()->get();

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'priority' => ['required', 'in:low,medium,high'],
        ]);

        Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'user_id' => $request->user()->id,
        ]);

        return redirect('/tickets');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // get ticket by id
        $ticket = Ticket::findOrFail($id);

        // authorize that the user can view the ticket
        if(Auth::user()->id != $ticket->user_id) {
            abort(403);
        }

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // get ticket by id
        $ticket = Ticket::findOrFail($id);

        // authorize that the user can view the ticket
        if(Auth::user()->id != $ticket->user_id) {
            abort(403);
        }

        // Validate (patch request for updating status)
        $request->validate([
            'status' => ['required', 'in:open,in_progress,waiting,closed'],
        ]);

        // Update ticket status
        $ticket->status = $request->status;
        $ticket->save();

        return redirect('/tickets/' . $ticket->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
