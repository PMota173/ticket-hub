@extends('layouts.docs')

@section('content')
    <h1 class="opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] text-3xl font-display font-medium text-text-primary mb-6">Public Portal</h1>

    <p class="text-text-secondary text-base mb-8 leading-relaxed">
        The public portal lets visitors discover public teams and submit tickets. Access is limited to teams marked as public and active.
    </p>

    <!-- EXPLORE -->
    <h2 class="text-2xl font-display font-medium text-text-primary mb-4 mt-12 flex items-center gap-3">
        <span class="w-8 h-1 bg-accent rounded-full"></span>
        Explore Directory
    </h2>
    <ul class="space-y-4 mb-8">
        <li class="flex gap-4 items-start">
            <div class="bg-surface-3 p-2 rounded-[6px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-primary"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
            </div>
            <div>
                <strong class="text-text-primary block mb-1">Public Only</strong>
                <p class="text-text-secondary text-[13px]">Teams must be public to appear in the Explore list.</p>
            </div>
        </li>
        <li class="flex gap-4 items-start">
            <div class="bg-surface-3 p-2 rounded-[6px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-primary"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            </div>
            <div>
                <strong class="text-text-primary block mb-1">Search</strong>
                <p class="text-text-secondary text-[13px]">Search matches team name and description.</p>
            </div>
        </li>
    </ul>

    <!-- TEAM PORTAL -->
    <h2 class="text-2xl font-display font-medium text-text-primary mb-4 mt-12 flex items-center gap-3">
        <span class="w-8 h-1 bg-accent rounded-full"></span>
        Team Portal
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-surface-2 p-6 rounded-[8px] border border-border">
            <h3 class="font-medium text-text-primary mb-2">Ticket Feed</h3>
            <p class="text-text-secondary text-[13px] leading-relaxed">
                Visitors can browse tickets, search by title/description, and sort by newest, oldest, status, or priority.
            </p>
        </div>
        <div class="bg-surface-2 p-6 rounded-[8px] border border-border">
            <h3 class="font-medium text-text-primary mb-2">Public Ticket View</h3>
            <p class="text-text-secondary text-[13px] leading-relaxed">
                Each ticket shows status, priority, author, tags, and the comment thread.
            </p>
        </div>
    </div>

    <!-- SUBMISSIONS -->
    <h2 class="text-2xl font-display font-medium text-text-primary mb-4 mt-12 flex items-center gap-3">
        <span class="w-8 h-1 bg-accent rounded-full"></span>
        Submitting Tickets
    </h2>
    <ul class="space-y-4 mb-8">
        <li class="flex gap-4 items-start">
            <div class="bg-surface-3 p-2 rounded-[6px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-primary"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>
            </div>
            <div>
                <strong class="text-text-primary block mb-1">Login Required</strong>
                <p class="text-text-secondary text-[13px]">Only authenticated users can submit tickets through the portal.</p>
            </div>
        </li>
        <li class="flex gap-4 items-start">
            <div class="bg-surface-3 p-2 rounded-[6px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-primary"><path d="M20 6 9 17 4 12"/></svg>
            </div>
            <div>
                <strong class="text-text-primary block mb-1">Defaults Applied</strong>
                <p class="text-text-secondary text-[13px]">Portal submissions save with status <code>open</code> and priority <code>medium</code>.</p>
            </div>
        </li>
    </ul>

    <!-- COMMENTS -->
    <h2 class="text-2xl font-display font-medium text-text-primary mb-4 mt-12 flex items-center gap-3">
        <span class="w-8 h-1 bg-accent rounded-full"></span>
        Comments
    </h2>
    <p class="text-text-secondary mb-8">
        Logged-in users can reply to tickets in the public portal. Comments are limited to 2000 characters.
    </p>
@endsection

@section('pagination')
    <a href="{{ route('guides.show', 'tickets') }}" class="flex items-center gap-2 text-[13px] font-medium text-text-muted hover:text-accent transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        Previous: Tickets & Kanban
    </a>
    <a href="{{ route('guides.show', 'robots') }}" class="flex items-center gap-2 text-[13px] font-medium text-accent hover:text-accent transition-colors">
        Next: Robots & Tokens
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
@endsection
