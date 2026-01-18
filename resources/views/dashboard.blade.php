<x-layouts.app title="Feed - {{ config('app.name', 'Ticket Hub') }}" sidebar="global">
    <div class="max-w-7xl mx-auto">
        <!-- Welcome Section -->
        <div class="mb-10">
            <h1 class="text-3xl font-bold tracking-tight text-white">Hello, {{ auth()->user()->name }}!</h1>
            <p class="text-slate-400 mt-2">Here's what's happening across your teams.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content (Left) -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Your Teams (Horizontal Scroll) -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-white">Your Teams</h2>
                        <a href="{{ route('teams.index') }}" class="text-sm text-blue-400 hover:text-blue-300">View All</a>
                    </div>
                    
                    @if($teams->isEmpty())
                        <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-6 text-center">
                            <p class="text-slate-400 mb-4">You haven't joined any teams yet.</p>
                            <x-blue-button href="{{ route('teams.create') }}">Create Team</x-blue-button>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($teams->take(4) as $team)
                                <a href="{{ route('teams.show', $team) }}" class="flex items-center gap-4 p-4 rounded-xl bg-slate-900/50 border border-slate-700 hover:border-blue-500/50 transition-all group">
                                    <div class="w-12 h-12 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-500 font-bold text-lg border border-blue-500/20 group-hover:scale-110 transition-transform">
                                        {{ substr($team->name, 0, 1) }}
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="font-semibold text-white truncate group-hover:text-blue-400 transition-colors">{{ $team->name }}</h3>
                                        <p class="text-xs text-slate-500">{{ $team->tickets_count }} Tickets &bull; {{ $team->users_count }} Members</p>
                                    </div>
                                </a>
                            @endforeach
                            @if($teams->count() > 4)
                                <a href="{{ route('teams.index') }}" class="flex items-center justify-center gap-2 p-4 rounded-xl bg-slate-900/30 border border-slate-800 border-dashed hover:border-slate-600 hover:bg-slate-900/50 transition-all text-slate-500 hover:text-slate-300">
                                    <span>+{{ $teams->count() - 4 }} more</span>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Recent Activity Feed -->
                <div>
                    <h2 class="text-lg font-semibold text-white mb-4">Recent Activity</h2>
                    <div class="bg-slate-900/50 border border-slate-700 rounded-xl overflow-hidden">
                        @forelse($recentTickets as $ticket)
                            <div class="p-4 border-b border-slate-800 last:border-0 hover:bg-slate-800/30 transition-colors">
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0 mt-1">
                                        <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 font-bold border border-slate-700">
                                            {{ substr($ticket->user->name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="flex-grow min-w-0">
                                        <div class="flex items-center justify-between gap-2 mb-1">
                                            <p class="text-sm text-slate-300">
                                                <span class="font-medium text-white">{{ $ticket->user->name }}</span>
                                                opened a new ticket in 
                                                <a href="{{ route('teams.show', $ticket->team) }}" class="font-medium text-blue-400 hover:underline">{{ $ticket->team->name }}</a>
                                            </p>
                                            <span class="text-xs text-slate-500 flex-shrink-0">{{ $ticket->created_at->diffForHumans() }}</span>
                                        </div>
                                        
                                        <a href="{{ route('tickets.show', [$ticket->team, $ticket]) }}" class="block group/ticket">
                                            <h3 class="text-base font-semibold text-white mb-1 group-hover/ticket:text-blue-400 transition-colors truncate">{{ $ticket->title }}</h3>
                                            <p class="text-sm text-slate-400 line-clamp-2 mb-2">{{ $ticket->description }}</p>
                                        </a>

                                        <div class="flex items-center gap-3">
                                            <x-ticket-status-badge :status="$ticket->status" />
                                            <x-ticket-priority-badge :priority="$ticket->priority" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center">
                                <p class="text-slate-400">No recent activity found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Sidebar (Right) -->
            <div class="space-y-8">
                <!-- My Assigned Tickets -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-sm font-bold text-slate-500 uppercase tracking-wider">Assigned to You</h2>
                    </div>
                    
                    @if($myAssignedTickets->isEmpty())
                        <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-6 text-center">
                            <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-green-500/10 text-green-400 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            </div>
                            <p class="text-sm text-slate-300 font-medium">All caught up!</p>
                            <p class="text-xs text-slate-500 mt-1">You have no pending tickets.</p>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($myAssignedTickets as $ticket)
                                <a href="{{ route('tickets.show', [$ticket->team, $ticket]) }}" class="block p-3 rounded-xl bg-slate-900/50 border border-slate-700 hover:border-blue-500/50 hover:bg-slate-900 transition-all group">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-[10px] font-bold text-slate-500 uppercase">{{ $ticket->team->name }}</span>
                                        <span class="text-[10px] text-slate-500">{{ $ticket->created_at->diffForHumans(null, true) }}</span>
                                    </div>
                                    <h4 class="text-sm font-semibold text-white mb-1 group-hover:text-blue-400 transition-colors truncate">{{ $ticket->title }}</h4>
                                    <div class="flex items-center justify-between">
                                        <x-ticket-priority-badge :priority="$ticket->priority" />
                                        <x-ticket-status-badge :status="$ticket->status" />
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>