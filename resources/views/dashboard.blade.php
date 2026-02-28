<x-layouts.app title="Feed - {{ config('app.name', 'Ticket Hub') }}" sidebar="global">
    <div class="max-w-7xl mx-auto">
        <!-- Welcome Section -->
        <div class="mb-12 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <div class="flex items-center gap-3 mb-2">
                <span class="text-[10px] font-mono text-text-muted uppercase tracking-widest">// System active</span>
                <span class="w-1.5 h-1.5 rounded-none bg-success animate-pulse"></span>
            </div>
            <h1 class="text-3xl font-display font-medium text-text-primary mb-2 tracking-tight">Welcome, {{ auth()->user()->name }}_</h1>
            <p class="text-text-secondary text-sm font-sans">Central command for your support operations.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            <!-- Main Content (Left) -->
            <div class="lg:col-span-8 space-y-10">

                <!-- Your Teams Grid -->
                <section>
                    <div class="flex items-center justify-between mb-6 border-b border-border pb-2">
                        <h2 class="text-[11px] font-mono font-medium text-text-muted uppercase tracking-widest flex items-center gap-2">
                            <span class="w-3 h-3 bg-accent"></span> workspaces_
                        </h2>
                        <a href="{{ route('teams.index') }}" class="text-[10px] font-mono text-accent hover:text-accent-hover transition-colors flex items-center gap-1 uppercase tracking-widest">
                            view_all [->]
                        </a>
                    </div>

                    @if($teams->isEmpty())
                        <div class="bg-surface-1 border border-border border-dashed p-10 text-center">
                            <p class="text-text-secondary text-sm mb-6 font-sans">No active workspaces detected in your profile.</p>
                            <x-blue-button href="{{ route('teams.create') }}">Create Your First Team</x-blue-button>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($teams->take(4) as $team)
                                <a href="{{ route('teams.show', $team) }}" class="flex items-center gap-4 p-4 bg-surface-1 border border-border hover:border-text-primary transition-all duration-150 group">
                                    <div class="w-10 h-10 bg-surface-2 flex items-center justify-center text-text-primary font-mono text-sm border border-border group-hover:border-accent transition-colors">
                                        @if($team->logo)
                                            <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="w-full h-full object-cover">
                                        @else
                                            {{ substr($team->name ?? 'T', 0, 1) }}
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h3 class="font-medium text-sm text-text-primary truncate group-hover:text-accent transition-colors mb-1 uppercase tracking-tight">{{ $team->name }}</h3>
                                        <div class="flex items-center gap-3 text-[10px] text-text-muted font-mono uppercase tracking-widest">
                                            <span class="flex items-center gap-1">
                                                tickets: {{ $team->tickets_count }}
                                            </span>
                                            <span class="flex items-center gap-1 pl-2 border-l border-border">
                                                agents: {{ $team->users_count }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            @if($teams->count() > 4)
                                <a href="{{ route('teams.index') }}" class="flex items-center justify-center gap-2 p-4 bg-transparent border border-border border-dashed hover:border-text-primary hover:bg-surface-1 transition-all text-text-secondary hover:text-text-primary font-mono text-[10px] uppercase tracking-widest">
                                    +{{ $teams->count() - 4 }} more_workspaces_
                                </a>
                            @endif
                        </div>
                    @endif
                </section>

                <!-- Recent Activity Section -->
                <section>
                    <div class="flex items-center justify-between mb-6 border-b border-border pb-2">
                        <h2 class="text-[11px] font-mono font-medium text-text-muted uppercase tracking-widest flex items-center gap-2">
                            <span class="w-3 h-3 bg-text-primary"></span> activity_log_
                        </h2>
                    </div>
                    
                    <div class="space-y-4">
                        @forelse($recentTickets as $ticket)
                            <div class="bg-surface-1 border border-border p-5 hover:border-text-primary transition-colors group relative">
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0">
                                        @if($ticket->author?->avatar_path)
                                            <img src="{{ asset('storage/' . $ticket->author->avatar_path) }}"
                                                 alt="{{ $ticket->author->name }}"
                                                 class="w-8 h-8 object-cover border border-border">
                                        @else
                                            <div class="w-8 h-8 bg-surface-2 flex items-center justify-center text-text-secondary font-mono text-xs border border-border">
                                                {{ substr($ticket->author?->name ?? '?', 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow min-w-0">
                                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 mb-3">
                                            <p class="text-xs text-text-secondary font-mono uppercase tracking-widest">
                                                <span class="text-text-primary font-semibold">{{ $ticket->author?->name ?? 'Unknown' }}</span>
                                                -> <a href="{{ route('teams.show', $ticket->team) }}" class="text-accent hover:underline">{{ $ticket->team->name }}</a>
                                            </p>
                                            <span class="text-[10px] font-mono text-text-muted uppercase tracking-widest">{{ $ticket->created_at->diffForHumans() }}</span>
                                        </div>

                                        <a href="{{ route('tickets.show', [$ticket->team, $ticket]) }}" class="block mb-4">
                                            <h3 class="text-sm font-semibold text-text-primary group-hover:text-accent transition-colors mb-1 truncate tracking-tight">{{ $ticket->title }}</h3>
                                            <p class="text-xs text-text-secondary line-clamp-2 leading-relaxed font-sans">{{ $ticket->description }}</p>
                                        </a>

                                        <div class="flex items-center gap-3 pt-3 border-t border-border/50">
                                            <x-ticket-status-badge :status="$ticket->status" />
                                            <x-ticket-priority-badge :priority="$ticket->priority" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="py-16 text-center bg-surface-1 border border-border border-dashed">
                                <p class="text-text-secondary text-[11px] font-mono uppercase tracking-widest">No recent signal detected.</p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>

            <!-- Sidebar (Right) -->
            <div class="lg:col-span-4 space-y-10">

                <!-- Explore Card -->
                <section>
                    <h2 class="text-[11px] font-mono font-medium text-text-muted uppercase tracking-widest mb-4">discover_</h2>
                    <a href="{{ route('portal.index') }}" class="block p-6 bg-surface-1 border border-border group hover:border-text-primary transition-colors relative">
                        <div class="absolute top-0 right-0 w-2 h-2 border-t border-r border-accent group-hover:w-4 group-hover:h-4 transition-all"></div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="text-text-secondary group-hover:text-accent transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>
                            </div>
                            <h3 class="font-semibold text-text-primary text-[13px] tracking-widest uppercase">Explore Portals</h3>
                        </div>
                        <p class="text-text-secondary text-xs mb-6 leading-relaxed font-sans">Find public teams, browse community issues, or see what else is being built.</p>
                        <div class="flex items-center text-[10px] font-mono text-accent uppercase tracking-[0.1em] group-hover:translate-x-1 transition-transform">
                            > browse_directory
                        </div>
                    </a>
                </section>

                <!-- My Assigned Tickets Section -->
                <section>
                    <h2 class="text-[11px] font-mono font-medium text-text-muted uppercase tracking-widest mb-4">assigned_to_me_</h2>

                    @if($myAssignedTickets->isEmpty())
                        <div class="bg-surface-1 border border-border p-6 text-center">
                            <div class="inline-flex items-center justify-center w-8 h-8 bg-success/10 text-success mb-3 border border-success/30">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"><path d="M20 6 9 17l-5-5"/></svg>
                            </div>
                            <p class="text-text-primary font-mono text-[11px] uppercase tracking-widest mb-1">Clear Inbox</p>
                            <p class="text-text-muted text-[10px] font-mono uppercase tracking-widest">0 tasks pending</p>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($myAssignedTickets as $ticket)
                                <a href="{{ route('tickets.show', [$ticket->team, $ticket]) }}" class="block p-4 bg-surface-1 border border-border hover:border-text-primary transition-colors group">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-[9px] font-mono text-text-muted uppercase tracking-widest">{{ $ticket->team->name }}</span>
                                        <span class="text-[9px] font-mono text-text-muted">{{ $ticket->created_at->diffForHumans(null, true) }}</span>
                                    </div>
                                    <h4 class="text-xs font-semibold text-text-primary group-hover:text-accent transition-colors truncate mb-4 tracking-tight uppercase">{{ $ticket->title }}</h4>
                                    <div class="flex items-center justify-between">
                                        <x-ticket-priority-badge :priority="$ticket->priority" class="scale-90 origin-left" />
                                        <x-ticket-status-badge :status="$ticket->status" class="scale-90 origin-right" />
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
    
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-layouts.app>
