@extends('layouts.docs')

@section('content')
    <h1 class="opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] text-3xl font-display font-medium text-text-primary mb-6">API Reference</h1>
    
    <p class="text-base text-text-secondary opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] mb-8 leading-relaxed">
        The Ticket Hub API allows you to programmatically manage tickets, comments, and members within your workspace.
    </p>

    <!-- AUTHENTICATION -->
    <section class="opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards] mb-16">
        <h2 class="text-xl font-display font-medium text-text-primary mb-4 flex items-center gap-2">
            <span class="text-accent font-mono text-sm">01.</span>
            Base URL & Auth
        </h2>
        <div class="prose prose-sm prose-invert max-w-none text-text-secondary">
            <p>All API requests should be made to the following base URL:</p>
            <pre class="bg-surface-2 p-4 border border-border text-accent"><code>{{ url('/') }}/api</code></pre>
            <p>Include your robot token in the <code>Authorization</code> header:</p>
            <pre class="bg-surface-2 p-4 border border-border text-text-primary"><code>Authorization: Bearer YOUR_ROBOT_TOKEN</code></pre>
        </div>
    </section>

    <!-- ENDPOINTS -->
    <section class="opacity-0 animate-[fadeIn_0.3s_ease-out_100ms_forwards] mb-8">
        <h2 class="text-xl font-display font-medium text-text-primary mb-6 flex items-center gap-2">
            <span class="text-accent font-mono text-sm">02.</span>
            Endpoints
        </h2>
        
        <div class="space-y-6">
            <!-- Tickets List -->
            <a href="{{ route('guides.api', 'tickets-list') }}" class="block bg-surface-1 border border-border rounded-none p-6 hover:border-border-light hover:bg-surface-2 transition-all">
                <div class="flex items-center gap-3 mb-2">
                    <span class="px-2 py-0.5 bg-success/10 text-success text-[10px] font-mono border border-success/20 uppercase tracking-widest">GET</span>
                    <h3 class="text-base font-display font-medium text-text-primary">/tickets</h3>
                </div>
                <p class="text-text-secondary text-[13px]">List all tickets for the robot's workspace.</p>
            </a>

            <!-- Tickets Create -->
            <a href="{{ route('guides.api', 'tickets-create') }}" class="block bg-surface-1 border border-border rounded-none p-6 hover:border-border-light hover:bg-surface-2 transition-all">
                <div class="flex items-center gap-3 mb-2">
                    <span class="px-2 py-0.5 bg-accent/10 text-accent text-[10px] font-mono border border-accent/20 uppercase tracking-widest">POST</span>
                    <h3 class="text-base font-display font-medium text-text-primary">/tickets</h3>
                </div>
                <p class="text-text-secondary text-[13px]">Create a new ticket in the workspace.</p>
            </a>

            <!-- Team Members -->
            <a href="{{ route('guides.api', 'team-members') }}" class="block bg-surface-1 border border-border rounded-none p-6 hover:border-border-light hover:bg-surface-2 transition-all">
                <div class="flex items-center gap-3 mb-2">
                    <span class="px-2 py-0.5 bg-success/10 text-success text-[10px] font-mono border border-success/20 uppercase tracking-widest">GET</span>
                    <h3 class="text-base font-display font-medium text-text-primary">/workspace/members</h3>
                </div>
                <p class="text-text-secondary text-[13px]">List all members of the current workspace.</p>
            </a>
        </div>
    </section>
@endsection

@section('pagination')
    <a href="{{ route('guides.show', 'robots') }}" class="flex items-center gap-2 text-[13px] font-medium text-text-muted hover:text-accent transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
        Previous: Robots & Tokens
    </a>
    <div></div> <!-- Empty right slot -->
@endsection
