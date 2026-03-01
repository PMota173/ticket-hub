<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles for the team.
     */
    public function index(Team $team): View
    {
        $this->authorize('viewAny', [Article::class, $team]);

        $articles = $team->articles()->with('author')->latest()->paginate(15);

        return view('teams.articles.index', compact('team', 'articles'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create(Team $team): View
    {
        $this->authorize('create', [Article::class, $team]);

        return view('teams.articles.create', compact('team'));
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request, Team $team): RedirectResponse
    {
        $this->authorize('create', [Article::class, $team]);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'is_published' => ['boolean'],
        ]);

        $team->articles()->create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'is_published' => $request->boolean('is_published', false),
            'author_id' => auth()->id(),
        ]);

        return redirect()->route('articles.index', $team)->with('status', 'Article created successfully.');
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Team $team, Article $article): View
    {
        $this->authorize('update', $article);

        return view('teams.articles.edit', compact('team', 'article'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, Team $team, Article $article): RedirectResponse
    {
        $this->authorize('update', $article);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'is_published' => ['boolean'],
        ]);

        $article->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'is_published' => $request->boolean('is_published', false),
        ]);

        return redirect()->route('articles.index', $team)->with('status', 'Article updated.');
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(Team $team, Article $article): RedirectResponse
    {
        $this->authorize('delete', $article);

        $article->delete();

        return redirect()->route('articles.index', $team)->with('status', 'Article deleted.');
    }
}
