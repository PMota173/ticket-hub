<x-layouts.app title="Feed - {{ config('app.name', 'Ticket Hub') }}" sidebar="global">
    <div class="max-w-7xl mx-auto">
        <!-- Welcome Section -->
        <div class="mb-12">
            <h1 class="text-4xl font-extrabold tracking-tight text-white mb-2">Welcome back, {{ auth()->user()->name }}</h1>
            <p class="text-slate-400 text-lg">Your central hub for everything happening across your teams.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <!-- Main Content (Left) -->
            <div class="lg:col-span-8 space-y-12">
                
                <!-- Your Teams Grid -->
                <section>
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-white tracking-tight">Your Active Teams</h2>
                        <a href="{{ route('teams.index') }}" class="text-sm font-semibold text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-1">
                            View All <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
                        </a>
                    </div>
                    
                    @if($teams->isEmpty())
                        <div class="bg-slate-900/40 border border-slate-800 border-dashed rounded-2xl p-10 text-center">
                            <p class="text-slate-500 mb-6">You haven't joined any teams yet.</p>
                            <x-blue-button href="{{ route('teams.create') }}" class="rounded-full px-6">Create Your First Team</x-blue-button>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            @foreach($teams->take(4) as $team)
                                <a href="{{ route('teams.show', $team) }}" class="flex items-center gap-4 p-5 rounded-2xl bg-slate-900/50 border border-slate-800 hover:border-blue-500/40 hover:bg-slate-900 transition-all duration-300 group shadow-lg">
                                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-600/20 to-indigo-600/20 flex items-center justify-center text-blue-400 font-bold text-xl border border-blue-500/10 group-hover:scale-105 transition-transform shadow-inner">
                                        {{ substr($team->name, 0, 1) }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h3 class="font-bold text-white truncate group-hover:text-blue-400 transition-colors mb-1">{{ $team->name }}</h3>
                                        <div class="flex items-center gap-3 text-xs text-slate-500 font-medium">
                                            <span class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ticket"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                                                {{ $team->tickets_count }}
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                                {{ $team->users_count }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            @if($teams->count() > 4)
                                <a href="{{ route('teams.index') }}" class="flex items-center justify-center gap-2 p-5 rounded-2xl bg-slate-900/20 border border-slate-800 border-dashed hover:border-slate-600 hover:bg-slate-900/40 transition-all text-slate-500 hover:text-slate-300">
                                    <span class="font-bold text-sm">+{{ $teams->count() - 4 }} more workspaces</span>
                                </a>
                            @endif
                        </div>
                    @endif
                </section>

                <!-- Recent Activity Section -->
                <section>
                    <h2 class="text-xl font-bold text-white tracking-tight mb-6">Recent Activity</h2>
                    <div class="space-y-4">
                        @forelse($recentTickets as $ticket)
                            <div class="bg-slate-900/50 border border-slate-800 rounded-2xl p-6 hover:bg-slate-900/80 transition-all shadow-md group">
                                <div class="flex gap-5">
                                    <div class="flex-shrink-0">
                                        @if($ticket->author?->avatar_path)
                                            <img src="{{ asset('storage/' . $ticket->author->avatar_path) }}" 
                                                 alt="{{ $ticket->author->name }}" 
                                                 class="w-12 h-12 rounded-full object-cover border-2 border-slate-800 group-hover:border-blue-500/30 transition-colors">
                                        @else
                                            <div class="w-12 h-12 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 font-bold border-2 border-slate-800 group-hover:border-blue-500/30 transition-colors">
                                                {{ substr($ticket->author?->name ?? '?', 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow min-w-0">
                                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
                                            <p class="text-sm text-slate-400 font-medium">
                                                <span class="text-white font-bold">{{ $ticket->author?->name ?? 'Unknown' }}</span>
                                                created a ticket in 
                                                <a href="{{ route('teams.show', $ticket->team) }}" class="text-blue-400 hover:underline">{{ $ticket->team->name }}</a>
                                            </p>
                                            <span class="text-xs text-slate-500 font-medium">{{ $ticket->created_at->diffForHumans() }}</span>
                                        </div>
                                        
                                        <a href="{{ route('tickets.show', [$ticket->team, $ticket]) }}" class="block mb-4">
                                            <h3 class="text-lg font-bold text-white group-hover:text-blue-400 transition-colors mb-2 leading-tight truncate">{{ $ticket->title }}</h3>
                                            <p class="text-sm text-slate-400 line-clamp-2 leading-relaxed">{{ $ticket->description }}</p>
                                        </a>

                                        <div class="flex items-center gap-3 pt-4 border-t border-slate-800/50">
                                            <x-ticket-status-badge :status="$ticket->status" />
                                            <x-ticket-priority-badge :priority="$ticket->priority" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="py-20 text-center bg-slate-900/30 rounded-2xl border border-slate-800 border-dashed">
                                <div class="w-16 h-16 bg-slate-800/50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-activity text-slate-600"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                                </div>
                                <p class="text-slate-500 font-medium italic">No recent activity to show.</p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>

            <!-- Sidebar (Right) -->
            <div class="lg:col-span-4 space-y-10">
                
                <!-- Explore Card -->
                <section>
                    <h2 class="text-xs font-extrabold text-slate-500 uppercase tracking-[0.2em] mb-5">Discover</h2>
                    <a href="{{ route('portal.index') }}" class="block p-6 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-700 border border-blue-400/20 shadow-xl group hover:shadow-blue-500/20 transition-all relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
                        <div class="relative z-10">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="p-2.5 bg-white/10 rounded-xl backdrop-blur-md border border-white/10 shadow-inner">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-white"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>
                                </div>
                                <h3 class="font-bold text-white text-xl tracking-tight">Explore Portals</h3>
                            </div>
                            <p class="text-blue-100 text-sm mb-6 leading-relaxed opacity-90">Find public teams, browse community issues, or see what else is being built.</p>
                            <div class="flex items-center text-xs font-bold text-white uppercase tracking-widest group-hover:translate-x-1 transition-transform">
                                Browse Directory <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </div>
                        </div>
                    </a>
                </section>

                <!-- My Assigned Tickets Section -->
                <section>
                    <h2 class="text-xs font-extrabold text-slate-500 uppercase tracking-[0.2em] mb-5">Assigned to You</h2>
                    
                    @if($myAssignedTickets->isEmpty())
                        <div class="bg-slate-900/50 border border-slate-800 rounded-2xl p-8 text-center shadow-inner">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-500/10 text-green-400 mb-4 border border-green-500/10">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle-2"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                            </div>
                            <p class="text-white font-bold mb-1">Clear Inbox</p>
                            <p class="text-slate-500 text-xs font-medium">You have no pending tickets.</p>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($myAssignedTickets as $ticket)
                                <a href="{{ route('tickets.show', [$ticket->team, $ticket]) }}" class="block p-4 rounded-2xl bg-slate-900/50 border border-slate-800 hover:border-blue-500/30 hover:bg-slate-900 transition-all group shadow-sm">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $ticket->team->name }}</span>
                                        <span class="text-[10px] font-medium text-slate-600 bg-slate-950 px-2 py-0.5 rounded-full">{{ $ticket->created_at->diffForHumans(null, true) }}</span>
                                    </div>
                                    <h4 class="text-sm font-bold text-white group-hover:text-blue-400 transition-colors truncate mb-4">{{ $ticket->title }}</h4>
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
</x-layouts.app>
