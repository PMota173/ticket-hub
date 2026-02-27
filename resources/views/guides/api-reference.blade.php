@extends('layouts.docs')

@section('content')
    <h1 class="opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] text-3xl font-display font-medium text-text-primary mb-6">API Reference</h1>
    <p class="text-text-secondary text-base mb-8 leading-relaxed">
        Reference for the Ticket Hub API v1. All requests must be JSON and include a Robot token.
    </p>

    <!-- Base URL -->
    <div class="mb-8">
        <h2 class="text-base font-display font-medium text-text-primary mb-4">Base URL</h2>
        <div class="bg-bg border border-border rounded-[6px] p-4 font-mono text-[13px] text-accent">
            {{ url('/api/v1') }}
        </div>
    </div>

    <h2 class="text-2xl font-display font-medium text-text-primary mb-4 mt-12">Endpoints</h2>
    <p class="text-text-secondary mb-8">Each request has its own page with request examples and sample responses.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('guides.api', 'tickets-list') }}" class="block bg-surface-1 border border-border rounded-[8px] p-6 hover:border-border-light hover:bg-surface-2 transition-all">
            <div class="flex items-center gap-3 mb-2">
                <span class="bg-accent/10 text-accent border border-accent/20 px-2.5 py-1 rounded text-xs font-bold font-mono">GET</span>
                <h3 class="text-base font-display font-medium text-text-primary">/tickets</h3>
            </div>
            <p class="text-text-secondary text-[13px]">List all tickets for the robot's team.</p>
        </a>
        <a href="{{ route('guides.api', 'tickets-show') }}" class="block bg-surface-1 border border-border rounded-[8px] p-6 hover:border-border-light hover:bg-surface-2 transition-all">
            <div class="flex items-center gap-3 mb-2">
                <span class="bg-accent/10 text-accent border border-accent/20 px-2.5 py-1 rounded text-xs font-bold font-mono">GET</span>
                <h3 class="text-base font-display font-medium text-text-primary">/tickets/{id}</h3>
            </div>
            <p class="text-text-secondary text-[13px]">Fetch a single ticket by ID.</p>
        </a>
        <a href="{{ route('guides.api', 'tickets-create') }}" class="block bg-surface-1 border border-border rounded-[8px] p-6 hover:border-success/30 hover:bg-surface-2 transition-all">
            <div class="flex items-center gap-3 mb-2">
                <span class="bg-success/10 text-success border border-success/20 px-2.5 py-1 rounded text-xs font-bold font-mono">POST</span>
                <h3 class="text-base font-display font-medium text-text-primary">/tickets</h3>
            </div>
            <p class="text-text-secondary text-[13px]">Create a new ticket.</p>
        </a>
        <a href="{{ route('guides.api', 'tickets-update') }}" class="block bg-surface-1 border border-border rounded-[8px] p-6 hover:border-border-light hover:bg-surface-2 transition-all">
            <div class="flex items-center gap-3 mb-2">
                <span class="bg-[#B07BFF]/10 text-[#B07BFF] border border-[#B07BFF]/20 px-2.5 py-1 rounded text-xs font-bold font-mono">PATCH</span>
                <h3 class="text-base font-display font-medium text-text-primary">/tickets/{id}</h3>
            </div>
            <p class="text-text-secondary text-[13px]">Update ticket fields.</p>
        </a>
        <a href="{{ route('guides.api', 'tickets-comments-create') }}" class="block bg-surface-1 border border-border rounded-[8px] p-6 hover:border-success/30 hover:bg-surface-2 transition-all">
            <div class="flex items-center gap-3 mb-2">
                <span class="bg-success/10 text-success border border-success/20 px-2.5 py-1 rounded text-xs font-bold font-mono">POST</span>
                <h3 class="text-base font-display font-medium text-text-primary">/tickets/{id}/comments</h3>
            </div>
            <p class="text-text-secondary text-[13px]">Create a comment for a ticket.</p>
        </a>
        <a href="{{ route('guides.api', 'team-members') }}" class="block bg-surface-1 border border-border rounded-[8px] p-6 hover:border-border-light hover:bg-surface-2 transition-all">
            <div class="flex items-center gap-3 mb-2">
                <span class="bg-accent/10 text-accent border border-accent/20 px-2.5 py-1 rounded text-xs font-bold font-mono">GET</span>
                <h3 class="text-base font-display font-medium text-text-primary">/team/members</h3>
            </div>
            <p class="text-text-secondary text-[13px]">List members for assignment lookups.</p>
        </a>
    </div>

@endsection

@section('pagination')
    <a href="{{ route('guides.show', 'robots') }}" class="flex items-center gap-2 text-[13px] font-medium text-text-muted hover:text-accent transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        Previous: Robots & Tokens
    </a>
    <div></div>
@endsection
