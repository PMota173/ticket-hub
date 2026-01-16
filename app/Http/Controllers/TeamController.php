<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = request()->user()->teams()->get();

        foreach ($teams as $team) {
            $team->is_admin = $team->users()->where('user_id', request()->user()->id)->first()->pivot->is_admin;
            $team->is_privete = $team->is_private;
            $team->members_count = $team->users()->count();
            $team->tickets_count = $team->tickets()->count();
        }

        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $attributes = request()->validate([
            'name' => ['required', 'unique:teams,name'],
            'description' => ['nullable'],
            'logo' => ['nullable', 'url'],
            'is_private' => ['boolean'],
        ]);

        $user = $request->user();
        $attributes['user_id'] = $user->id;

        $attributes['slug'] = \Str::slug($attributes['name']);

        $team = Team::create($attributes);

        $team->users()->attach($user->id, ['is_admin' => true]);

        return redirect(route('teams.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
