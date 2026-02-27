<x-layouts.app title="Feed - {{ config('app.name', 'Ticket Hub') }}" sidebar="global">
    <div class="max-w-7xl mx-auto">
        <!-- Welcome Section -->
        <div class="mb-12 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <h1 class="text-3xl font-display font-medium text-text-primary mb-2">Welcome back, {{ auth()->user()->name }}</h1>
            <p class="text-text-secondary text-sm">Your central hub for everything happening across your teams.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            <!-- Main Content (Left) -->
            <div class="lg:col-span-8 space-y-8">

                <!-- Your Teams Grid -->
                <section>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-[11px] font-mono font-medium text-text-muted uppercase tracking-[0.08em]">Your Active Teams</h2>
                        <a href="{{ route('teams.index') }}" class="text-[11px] font-mono text-accent hover:text-accent-hover transition-colors flex items-center gap-1">
                            View All <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        </a>
                    </div>

                    @if($teams->isEmpty())
                        <div class="bg-surface-1 border border-border border-dashed rounded-[6px] p-8 text-center">
                            <p class="text-text-secondary text-sm mb-4">You haven't joined any teams yet.</p>
                            <x-blue-button href="{{ route('teams.create') }}">Create Your First Team</x-blue-button>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($teams->take(4) as $team)
                                <a href="{{ route('teams.show', $team) }}" class="flex items-center gap-4 p-4 rounded-[6px] bg-surface-1 border border-border hover:border-border-light hover:bg-surface-2 transition-all duration-150 group">
                                    <div class="w-10 h-10 rounded-[4px] bg-surface-2 flex items-center justify-center text-text-primary font-mono text-sm border border-border group-hover:border-border-light transition-colors">
                                        @if($team->logo)
                                            <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="w-full h-full object-cover rounded-[4px]">
                                        @else
                                            {{ substr($team->name ?? 'T', 0, 1) }}
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h3 class="font-medium text-sm text-text-primary truncate group-hover:text-accent transition-colors mb-1">{{ $team->name }}</h3>
                                        <div class="flex items-center gap-3 text-[11px] text-text-muted font-mono">
                                            <span class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                                                {{ $team->tickets_count }}
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                                {{ $team->users_count }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            @if($teams->count() > 4)
                                <a href="{{ route('teams.index') }}" class="flex items-center justify-center gap-2 p-4 rounded-[6px] bg-transparent border border-border border-dashed hover:border-border-light hover:bg-surface-1 transition-all text-text-secondary hover:text-text-primary">
                                    <span class="font-mono text-[11px] uppercase tracking-[0.08em]">+{{ $teams->count() - 4 }} more workspaces</span>
                                </a>
                            @endif
                        </div>
                    @endif
                </section>

                <!-- Recent Activity Section -->
                <section>
                    <h2 class="text-[11px] font-mono font-medium text-text-muted uppercase tracking-[0.08em] mb-4">Recent Activity</h2>
                    <div class="space-y-3">
                        @forelse($recentTickets as $ticket)
                            <div class="bg-surface-1 border border-border rounded-[6px] p-5 hover:border-border-light transition-colors group">
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0">
                                        @if($ticket->author?->avatar_path)
                                            <img src="{{ asset('storage/' . $ticket->author->avatar_path) }}"
                                                 alt="{{ $ticket->author->name }}"
                                                 class="w-8 h-8 rounded-[4px] object-cover border border-border">
                                        @else
                                            <div class="w-8 h-8 rounded-[4px] bg-surface-2 flex items-center justify-center text-text-secondary font-mono text-xs border border-border">
                                                {{ substr($ticket->author?->name ?? '?', 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow min-w-0">
                                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 mb-2">
                                            <p class="text-[13px] text-text-secondary">
                                                <span class="text-text-primary font-medium">{{ $ticket->author?->name ?? 'Unknown' }}</span>
                                                created a ticket in
                                                <a href="{{ route('teams.show', $ticket->team) }}" class="text-accent hover:underline">{{ $ticket->team->name }}</a>
                                            </p>
                                            <span class="text-[11px] font-mono text-text-muted">{{ $ticket->created_at->diffForHumans() }}</span>
                                        </div>

                                        <a href="{{ route('tickets.show', [$ticket->team, $ticket]) }}" class="block mb-3">
                                            <h3 class="text-[15px] font-medium text-text-primary group-hover:text-accent transition-colors mb-1 truncate">{{ $ticket->title }}</h3>
                                            <p class="text-[13px] text-text-secondary line-clamp-2 leading-relaxed">{{ $ticket->description }}</p>
                                        </a>

                                        <div class="flex items-center gap-2 pt-3 border-t border-border">
                                            <x-ticket-status-badge :status="$ticket->status" />
                                            <x-ticket-priority-badge :priority="$ticket->priority" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="py-12 text-center bg-surface-1 rounded-[6px] border border-border border-dashed">
                                <p class="text-text-secondary text-sm font-mono">No recent activity to show.</p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>

            <!-- Sidebar (Right) -->
            <div class="lg:col-span-4 space-y-8">

                <!-- Explore Card -->
                <section>
                    <h2 class="text-[11px] font-mono font-medium text-text-muted uppercase tracking-[0.08em] mb-4">Discover</h2>
                    <a href="{{ route('portal.index') }}" class="block p-5 rounded-[6px] bg-surface-1 border border-border group hover:border-border-light transition-colors">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="text-text-secondary group-hover:text-accent transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>
                            </div>
                            <h3 class="font-medium text-text-primary text-[15px] tracking-tight">Explore Portals</h3>
                        </div>
                        <p class="text-text-secondary text-[13px] mb-4 leading-relaxed">Find public teams, browse community issues, or see what else is being built.</p>
                        <div class="flex items-center text-[11px] font-mono text-accent uppercase tracking-[0.08em] group-hover:translate-x-1 transition-transform">
                            Browse Directory <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </a>
                </section>

                <!-- My Assigned Tickets Section -->
                <section>
                    <h2 class="text-[11px] font-mono font-medium text-text-muted uppercase tracking-[0.08em] mb-4">Assigned to You</h2>

                    @if($myAssignedTickets->isEmpty())
                        <div class="bg-surface-1 border border-border rounded-[6px] p-6 text-center">
                            <div class="inline-flex items-center justify-center w-8 h-8 rounded-[4px] bg-success/10 text-success mb-3 border border-success/20">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                            </div>
                            <p class="text-text-primary font-medium text-[13px] mb-1">Clear Inbox</p>
                            <p class="text-text-secondary text-[11px] font-mono">You have no pending tickets.</p>
                        </div>
                    @else
                        <div class="space-y-2">
                            @foreach($myAssignedTickets as $ticket)
                                <a href="{{ route('tickets.show', [$ticket->team, $ticket]) }}" class="block p-4 rounded-[6px] bg-surface-1 border border-border hover:border-border-light transition-colors group">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">{{ $ticket->team->name }}</span>
                                        <span class="text-[10px] font-mono text-text-muted">{{ $ticket->created_at->diffForHumans(null, true) }}</span>
                                    </div>
                                    <h4 class="text-[13px] font-medium text-text-primary group-hover:text-accent transition-colors truncate mb-3">{{ $ticket->title }}</h4>
                                    <div class="flex items-center justify-between">
                                        <x-ticket-priority-badge :priority="$ticket->priority" />
                                        <x-ticket-status-badge :status="$ticket->status" />
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
