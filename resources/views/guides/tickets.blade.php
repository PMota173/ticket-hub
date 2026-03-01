@extends('layouts.docs')

@section('content')
    <h1 class="opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] text-3xl font-display font-medium text-text-primary mb-6">Tickets & Kanban</h1>
    
    <p class="text-base text-text-secondary opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] mb-8 leading-relaxed">
        Tickets are the core unit of work in a workspace. The Kanban board is visible only to members and supports quick status changes.
    </p>

    <!-- TICKET LIFECYCLE -->
    <section class="opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards] mb-16">
        <h2 class="text-xl font-display font-medium text-text-primary mb-4 flex items-center gap-2">
            <span class="text-accent font-mono text-sm">01.</span>
            Ticket Lifecycle
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <div class="p-4 bg-surface-1 border border-border">
                <h3 class="text-[11px] font-mono text-text-primary uppercase tracking-widest mb-2">Open</h3>
                <p class="text-text-secondary text-[13px]">Initial state for all new tickets. Awaiting triage or assignment.</p>
            </div>
            <div class="p-4 bg-surface-1 border border-border">
                <h3 class="text-[11px] font-mono text-accent uppercase tracking-widest mb-2">In Progress</h3>
                <p class="text-text-secondary text-[13px]">Actively being worked on by the workspace members.</p>
            </div>
            <div class="p-4 bg-surface-1 border border-border">
                <h3 class="text-[11px] font-mono text-warning uppercase tracking-widest mb-2">Waiting</h3>
                <p class="text-text-secondary text-[13px]">Pending feedback from the user or external verification.</p>
            </div>
            <div class="p-4 bg-surface-1 border border-border">
                <h3 class="text-[11px] font-mono text-success uppercase tracking-widest mb-2">Closed</h3>
                <p class="text-text-secondary text-[13px]">Resolved issues. Moved to the bottom of the Kanban view.</p>
            </div>
        </div>
    </section>

    <!-- PRIORITIES & ASSIGNMENT -->
    <section class="opacity-0 animate-[fadeIn_0.3s_ease-out_100ms_forwards] mb-16">
        <h2 class="text-xl font-display font-medium text-text-primary mb-4 flex items-center gap-2">
            <span class="text-accent font-mono text-sm">02.</span>
            Priorities & Assignment
        </h2>
        <div class="prose prose-sm prose-invert max-w-none text-text-secondary">
            <p>Every ticket has a priority level: <code>Low</code>, <code>Medium</code>, <code>High</code>, or <code>Urgent</code>.</p>
            <div class="bg-surface-2 border border-border p-6 my-6">
                <h4 class="text-text-primary font-medium mb-3">Assignment Rules</h4>
                <ul class="space-y-3 m-0 p-0 list-none">
                    <li class="flex items-center gap-3">
                        <div class="w-1 h-1 bg-accent"></div>
                        <span>Tickets can be assigned to a single workspace member at a time.</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-1 h-1 bg-accent"></div>
                        <span>Only workspace members can assign tickets to a user.</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-1 h-1 bg-accent"></div>
                        <span>Assigning a ticket automatically generates an activity log entry.</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- TAGS & COMMENTS -->
    <section class="opacity-0 animate-[fadeIn_0.3s_ease-out_150ms_forwards] mb-8">
        <h2 class="text-xl font-display font-medium text-text-primary mb-4 flex items-center gap-2">
            <span class="text-accent font-mono text-sm">03.</span>
            Tags & Comments
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-base font-medium text-text-primary mb-2">Custom Tags</h3>
                <p class="text-text-secondary text-[13px] leading-relaxed">
                    Tags are scoped to the workspace. Members can add or remove tags from a ticket to group related issues (e.g., <code>billing</code>, <code>v2-release</code>).
                </p>
            </div>
            <div>
                <h3 class="text-base font-medium text-text-primary mb-2">Internal Discussion</h3>
                <p class="text-text-secondary text-[13px] leading-relaxed">
                    Comments provide a full audit trail of the conversation between members and users. Private internal notes can be added via robots or API integrations.
                </p>
            </div>
        </div>
    </section>
@endsection

@section('pagination')
    <a href="{{ route('guides.show', 'teams') }}" class="flex items-center gap-2 text-[13px] font-medium text-text-muted hover:text-accent transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
        Previous: Workspaces & Members
    </a>
    <a href="{{ route('guides.show', 'portal') }}" class="flex items-center gap-2 text-[13px] font-medium text-accent hover:text-accent transition-colors">
        Next: Public Portal
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
@endsection
