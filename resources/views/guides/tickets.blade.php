@extends('layouts.docs')

@section('content')
    <h1 class="opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] text-3xl font-display font-medium text-text-primary mb-6">Tickets & Kanban</h1>

    <p class="text-text-secondary text-base mb-8 leading-relaxed">
        Tickets are the core unit of work in a team. The Kanban board is visible only to team members and supports quick status changes.
    </p>

    <!-- STATUS & WORKFLOW -->
    <h2 class="text-2xl font-display font-medium text-text-primary mb-4 mt-12 flex items-center gap-3">
        <span class="w-8 h-1 bg-accent rounded-full"></span>
        Status Workflow
    </h2>
    <p class="text-text-secondary mb-6">
        Tickets move across four statuses. The board columns map directly to these values.
    </p>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-surface-1 border border-border rounded-[8px] p-6">
            <div class="flex items-center gap-3 mb-2">
                <span class="w-2.5 h-2.5 rounded-full bg-accent"></span>
                <h3 class="font-display font-medium text-text-primary">Open</h3>
            </div>
            <p class="text-text-secondary text-[13px]">New issues and untriaged work.</p>
        </div>
        <div class="bg-surface-1 border border-border rounded-[8px] p-6">
            <div class="flex items-center gap-3 mb-2">
                <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
                <h3 class="font-display font-medium text-text-primary">In Progress</h3>
            </div>
            <p class="text-text-secondary text-[13px]">Actively being worked on by the team.</p>
        </div>
        <div class="bg-surface-1 border border-border rounded-[8px] p-6">
            <div class="flex items-center gap-3 mb-2">
                <span class="w-2.5 h-2.5 rounded-full bg-orange-500"></span>
                <h3 class="font-display font-medium text-text-primary">Waiting</h3>
            </div>
            <p class="text-text-secondary text-[13px]">Blocked, waiting on feedback, or external dependencies.</p>
        </div>
        <div class="bg-surface-1 border border-border rounded-[8px] p-6">
            <div class="flex items-center gap-3 mb-2">
                <span class="w-2.5 h-2.5 rounded-full bg-green-500"></span>
                <h3 class="font-display font-medium text-text-primary">Closed</h3>
            </div>
            <p class="text-text-secondary text-[13px]">Resolved or no longer actionable.</p>
        </div>
    </div>

    <!-- PRIORITY -->
    <h2 class="text-2xl font-display font-medium text-text-primary mb-4 mt-12 flex items-center gap-3">
        <span class="w-8 h-1 bg-accent rounded-full"></span>
        Priority Levels
    </h2>
    <p class="text-text-secondary mb-6">
        Priority is required in the web UI and stored as one of three values.
    </p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-surface-2 p-5 rounded-[8px] border border-border">
            <p class="text-xs font-medium uppercase tracking-[0.08em] text-success mb-1">Low</p>
            <p class="text-text-secondary text-[13px]">Minor tasks and low urgency.</p>
        </div>
        <div class="bg-surface-2 p-5 rounded-[8px] border border-border">
            <p class="text-xs font-medium uppercase tracking-[0.08em] text-warning mb-1">Medium</p>
            <p class="text-text-secondary text-[13px]">Default priority for most work.</p>
        </div>
        <div class="bg-surface-2 p-5 rounded-[8px] border border-border">
            <p class="text-xs font-medium uppercase tracking-[0.08em] text-danger mb-1">High</p>
            <p class="text-text-secondary text-[13px]">Requires attention soon.</p>
        </div>
    </div>

    <!-- ASSIGNMENTS -->
    <h2 class="text-2xl font-display font-medium text-text-primary mb-4 mt-12 flex items-center gap-3">
        <span class="w-8 h-1 bg-accent rounded-full"></span>
        Assignment Rules
    </h2>
    <ul class="space-y-4 mb-8">
        <li class="flex gap-4 items-start">
            <div class="bg-surface-3 p-2 rounded-[6px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-primary"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div>
                <strong class="text-text-primary block mb-1">Members Only</strong>
                <p class="text-text-secondary text-[13px]">Only team members can assign tickets to a user.</p>
            </div>
        </li>
        <li class="flex gap-4 items-start">
            <div class="bg-surface-3 p-2 rounded-[6px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-primary"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
            </div>
            <div>
                <strong class="text-text-primary block mb-1">Self-Assign</strong>
                <p class="text-text-secondary text-[13px]">Members can take ownership from the ticket sidebar.</p>
            </div>
        </li>
    </ul>

    <!-- COMMENTS & TAGS -->
    <h2 class="text-2xl font-display font-medium text-text-primary mb-4 mt-12 flex items-center gap-3">
        <span class="w-8 h-1 bg-accent rounded-full"></span>
        Comments & Tags
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-surface-2 p-6 rounded-[8px] border border-border">
            <h3 class="font-medium text-text-primary mb-2">Comments</h3>
            <p class="text-text-secondary text-[13px] leading-relaxed">
                Comments accept up to 2000 characters. Only the author can delete their own comment.
            </p>
        </div>
        <div class="bg-surface-2 p-6 rounded-[8px] border border-border">
            <h3 class="font-medium text-text-primary mb-2">Tags</h3>
            <p class="text-text-secondary text-[13px] leading-relaxed">
                Tags are scoped to the team. Members can add or remove tags from a ticket.
            </p>
        </div>
    </div>
@endsection

@section('pagination')
    <a href="{{ route('guides.show', 'teams') }}" class="flex items-center gap-2 text-[13px] font-medium text-text-muted hover:text-accent transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        Previous: Teams & Members
    </a>
    <a href="{{ route('guides.show', 'portal') }}" class="flex items-center gap-2 text-[13px] font-medium text-accent hover:text-accent transition-colors">
        Next: Public Portal
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
@endsection
