@extends('layouts.docs')

@section('content')
    <h1 class="opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] text-3xl font-display font-medium tracking-tight text-text-primary mb-6">Ticket Hub Documentation</h1>
    <p class="text-base text-text-secondary opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] mb-8 leading-relaxed">
        Learn how workspaces, tickets, the public portal, and robots fit together. Every page mirrors what is implemented in the app.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
        <a href="{{ route('guides.show', 'teams') }}" class="block bg-surface-1 border border-border rounded-[8px] p-6 hover:border-border-light hover:bg-surface-2 transition-all group">
            <div class="w-10 h-10 bg-surface-2 rounded-[6px] flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <h3 class="text-base font-medium text-text-primary mb-2">Teams & Members</h3>
            <p class="text-text-secondary text-[13px]">Workspaces, roles, invitations, and privacy settings.</p>
        </a>

        <a href="{{ route('guides.show', 'tickets') }}" class="block bg-surface-1 border border-border rounded-[8px] p-6 hover:border-border-light hover:bg-surface-2 transition-all group">
            <div class="w-10 h-10 bg-surface-2 rounded-[6px] flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
            </div>
            <h3 class="text-base font-medium text-text-primary mb-2">Tickets & Kanban</h3>
            <p class="text-text-secondary text-[13px]">Statuses, priorities, assignments, tags, and comments.</p>
        </a>

        <a href="{{ route('guides.show', 'portal') }}" class="block bg-surface-1 border border-border rounded-[8px] p-6 hover:border-border-light hover:bg-surface-2 transition-all group">
            <div class="w-10 h-10 bg-surface-2 rounded-[6px] flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
            </div>
            <h3 class="text-base font-medium text-text-primary mb-2">Public Portal</h3>
            <p class="text-text-secondary text-[13px]">Explore public teams and submit tickets as a logged-in user.</p>
        </a>

        <a href="{{ route('guides.show', 'robots') }}" class="block bg-surface-1 border border-border rounded-[8px] p-6 hover:border-border-light hover:bg-surface-2 transition-all group">
            <div class="w-10 h-10 bg-surface-2 rounded-[6px] flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
            </div>
            <h3 class="text-base font-medium text-text-primary mb-2">Robots & Tokens</h3>
            <p class="text-text-secondary text-[13px]">Create API clients and manage access tokens.</p>
        </a>

        <a href="{{ route('guides.show', 'api-reference') }}" class="block bg-surface-1 border border-border rounded-[8px] p-6 hover:border-border-light hover:bg-surface-2 transition-all group md:col-span-2">
            <div class="w-10 h-10 bg-surface-2 rounded-[6px] flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
            </div>
            <h3 class="text-base font-medium text-text-primary mb-2">Full API Reference</h3>
            <p class="text-text-secondary text-[13px]">Endpoints, parameters, and responses aligned to the current API.</p>
        </a>
    </div>

    <h2 class="text-2xl font-display font-medium text-text-primary mb-4 mt-12">Core Concepts</h2>
    <p class="text-text-secondary mb-6 leading-relaxed">
        Ticket Hub is built around <strong>Workspaces</strong> (Teams). Each team has its own ecosystem:
    </p>
    <ul class="space-y-3 mb-8">
        <li class="flex items-start gap-3">
            <div class="w-1.5 h-1.5 rounded-full bg-accent mt-2"></div>
            <span><strong class="text-text-primary">Kanban Board:</strong> Internal workflow across open, in progress, waiting, and closed.</span>
        </li>
        <li class="flex items-start gap-3">
            <div class="w-1.5 h-1.5 rounded-full bg-accent mt-2"></div>
            <span><strong class="text-text-primary">Public Portal:</strong> Optional public view for community ticket submissions.</span>
        </li>
        <li class="flex items-start gap-3">
            <div class="w-1.5 h-1.5 rounded-full bg-accent mt-2"></div>
            <span><strong class="text-text-primary">Robots:</strong> API agents that create and update tickets programmatically.</span>
        </li>
    </ul>
@endsection

@section('pagination')
    <div></div> <!-- Empty left slot -->
    <a href="{{ route('guides.show', 'teams') }}" class="flex items-center gap-2 text-[13px] font-medium text-accent hover:text-accent transition-colors">
        Next: Teams & Members
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
@endsection
