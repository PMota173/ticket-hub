@extends('layouts.docs')

@section('content')
    <h1 class="opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] text-3xl font-display font-medium text-text-primary mb-6">Public Portal</h1>
    
    <p class="text-base text-text-secondary opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] mb-8 leading-relaxed">
        The public portal lets visitors discover public workspaces and submit tickets. Access is limited to workspaces marked as public and active.
    </p>

    <!-- EXPLORE DIRECTORY -->
    <section class="opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards] mb-16">
        <h2 class="text-xl font-display font-medium text-text-primary mb-4 flex items-center gap-2">
            <span class="text-accent font-mono text-sm">01.</span>
            Explore Directory
        </h2>
        <div class="prose prose-sm prose-invert max-w-none text-text-secondary">
            <p>The homepage of the portal acts as a directory for all public-facing workspaces.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-6">
                <div class="p-4 bg-surface-1 border border-border">
                    <h3 class="text-[11px] font-mono text-text-primary uppercase tracking-widest mb-2">Visibility</h3>
                    <p class="text-text-secondary text-[13px]">Workspaces must be public to appear in the Explore list.</p>
                </div>
                <div class="p-4 bg-surface-1 border border-border">
                    <h3 class="text-[11px] font-mono text-text-primary uppercase tracking-widest mb-2">Search</h3>
                    <p class="text-text-secondary text-[13px]">Search matches workspace name and description.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- WORKSPACE PORTAL -->
    <section class="opacity-0 animate-[fadeIn_0.3s_ease-out_100ms_forwards] mb-16">
        <h2 class="text-xl font-display font-medium text-text-primary mb-4 flex items-center gap-2">
            <span class="text-accent font-mono text-sm">02.</span>
            Workspace Portal
        </h2>
        <div class="prose prose-sm prose-invert max-w-none text-text-secondary">
            <p>Each workspace has a dedicated portal page showing its biography, statistics, and public ticket feed.</p>
            <ul class="space-y-4 my-6">
                <li class="flex items-start gap-3">
                    <div class="w-1.5 h-1.5 rounded-none bg-accent mt-2 flex-shrink-0"></div>
                    <span><strong class="text-text-primary">Ticket Submission:</strong> Only authenticated users can submit tickets through the portal.</span>
                </li>
                <li class="flex items-start gap-3">
                    <div class="w-1.5 h-1.5 rounded-none bg-accent mt-2 flex-shrink-0"></div>
                    <span><strong class="text-text-primary">Knowledge Base:</strong> Published articles are displayed on the portal to reduce ticket volume.</span>
                </li>
            </ul>
        </div>
    </section>

    <!-- TICKET TRACKING -->
    <section class="opacity-0 animate-[fadeIn_0.3s_ease-out_150ms_forwards] mb-8">
        <h2 class="text-xl font-display font-medium text-text-primary mb-4 flex items-center gap-2">
            <span class="text-accent font-mono text-sm">03.</span>
            Ticket Tracking
        </h2>
        <p class="text-text-secondary text-[13px] leading-relaxed mb-6">
            Users can track the progress of their own tickets and engage in discussions with workspace members. Status updates on the Kanban board are reflected in real-time on the portal.
        </p>
    </section>
@endsection

@section('pagination')
    <a href="{{ route('guides.show', 'tickets') }}" class="flex items-center gap-2 text-[13px] font-medium text-text-muted hover:text-accent transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
        Previous: Tickets & Kanban
    </a>
    <a href="{{ route('guides.show', 'robots') }}" class="flex items-center gap-2 text-[13px] font-medium text-accent hover:text-accent transition-colors">
        Next: Robots & Tokens
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
@endsection
