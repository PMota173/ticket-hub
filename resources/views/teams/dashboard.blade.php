<x-layouts.app title="{{ $team->name }} Dashboard - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="mb-12">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-16 h-16 rounded-2xl bg-blue-600/10 border border-blue-500/20 flex items-center justify-center text-blue-500 font-black text-2xl shadow-inner overflow-hidden">
                @if($team->logo)
                    <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="w-full h-full object-cover">
                @else
                    {{ substr($team->name, 0, 1) }}
                @endif
            </div>
            <div>
                <h2 class="text-4xl font-extrabold tracking-tight text-white mb-1">{{ $team->name }}</h2>
                <p class="text-slate-400 text-lg font-medium">Workspace Overview</p>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <!-- Open Tickets -->
        <div class="bg-slate-900/50 border border-slate-800 rounded-3xl p-6 hover:border-blue-500/30 transition-all group shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-blue-500/10 rounded-xl group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-blue-500"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                </div>
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Growth</span>
            </div>
            <p class="text-3xl font-black text-white mb-1 tracking-tight">{{ $stats['open'] }}</p>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Open Tickets</p>
        </div>

        <!-- In Progress -->
        <div class="bg-slate-900/50 border border-slate-800 rounded-3xl p-6 hover:border-purple-500/30 transition-all group shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-purple-500/10 rounded-xl group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-purple-500"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Active</span>
            </div>
            <p class="text-3xl font-black text-white mb-1 tracking-tight">{{ $stats['in_progress'] }}</p>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">In Progress</p>
        </div>

        <!-- Waiting -->
        <div class="bg-slate-900/50 border border-slate-800 rounded-3xl p-6 hover:border-orange-500/30 transition-all group shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-orange-500/10 rounded-xl group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-orange-500"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                </div>
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Delayed</span>
            </div>
            <p class="text-3xl font-black text-white mb-1 tracking-tight">{{ $stats['waiting'] }}</p>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Waiting</p>
        </div>

        <!-- Solved -->
        <div class="bg-slate-900/50 border border-slate-800 rounded-3xl p-6 hover:border-green-500/30 transition-all group shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-green-500/10 rounded-xl group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-green-500"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                </div>
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Complete</span>
            </div>
            <p class="text-3xl font-black text-white mb-1 tracking-tight">{{ $stats['closed'] }}</p>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Solved Tickets</p>
        </div>
    </div>

    @if($myTickets->isNotEmpty())
        <div class="mb-12">
            <h3 class="text-xl font-bold text-white mb-6 tracking-tight flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-blue-500"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Your Priority Tasks
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                @foreach($myTickets as $ticket)
                    <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="flex items-center gap-4 p-4 rounded-2xl bg-slate-900/40 border border-slate-800/50 hover:border-blue-500/30 hover:bg-slate-900 transition-all duration-300 group shadow-md">
                        <div class="flex-shrink-0">
                            @php
                                $statusColor = match($ticket->status) {
                                    \App\Enums\TicketStatus::OPEN => 'bg-blue-500',
                                    \App\Enums\TicketStatus::IN_PROGRESS => 'bg-purple-500',
                                    \App\Enums\TicketStatus::WAITING => 'bg-orange-500',
                                    \App\Enums\TicketStatus::CLOSED => 'bg-green-500',
                                };
                            @endphp
                           <div class="w-2 h-2 rounded-full {{ $statusColor }} shadow-[0_0_8px_rgba(var(--{{ str_replace('bg-', '', $statusColor) }}-500),0.5)]"></div>
                        </div>
                        
                        <div class="flex-grow min-w-0">
                            <h4 class="text-sm font-bold text-white truncate group-hover:text-blue-400 transition-colors mb-1">{{ $ticket->title }}</h4>
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">{{ $ticket->created_at->diffForHumans(null, true) }}</span>
                                <span class="text-[10px] font-black uppercase tracking-widest {{ $ticket->priority === \App\Enums\TicketPriority::HIGH ? 'text-red-500' : ($ticket->priority === \App\Enums\TicketPriority::MEDIUM ? 'text-orange-500' : 'text-green-500') }}">
                                    {{ $ticket->priority->value }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Recent Tickets List -->
    <div class="bg-slate-900/50 border border-slate-800 rounded-3xl shadow-xl overflow-hidden">
        <div class="p-6 border-b border-slate-800 bg-slate-900/80 flex items-center justify-between">
            <h3 class="text-xl font-bold text-white tracking-tight">Recent Team Activity</h3>
            <a href="{{ route('tickets.index', $team) }}" class="text-xs font-bold text-blue-400 hover:text-blue-300 uppercase tracking-widest">Open Board</a>
        </div>

        @if($recentTickets->isEmpty())
            <div class="p-20 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-slate-800/50 mb-6 border border-slate-700 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-inbox text-slate-600">
                        <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                        <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2 tracking-tight">No tickets found</h3>
                <p class="text-slate-500 max-w-sm mx-auto mb-8 font-medium">This workspace is currently empty. Start by opening your first support ticket.</p>
                <x-blue-button href="{{ route('tickets.create', $team) }}" class="rounded-full px-8 py-3">Open Ticket</x-blue-button>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-950/50 text-slate-500 uppercase tracking-[0.15em] text-[10px] font-black">
                        <tr>
                            <th class="px-8 py-5 font-black">Ticket Summary</th>
                            <th class="px-8 py-5 font-black">Status</th>
                            <th class="px-8 py-5 font-black">Priority</th>
                            <th class="px-8 py-5 font-black">Assigned</th>
                            <th class="px-8 py-5 font-black text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/50">
                        @foreach($recentTickets as $ticket)
                            <tr class="hover:bg-slate-800/30 transition-colors group">
                                <td class="px-8 py-6">
                                    <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="font-bold text-white hover:text-blue-400 transition-colors block mb-1">{{ $ticket->title }}</a>
                                    <div class="text-xs text-slate-500 truncate max-w-xs font-medium">{{ Str::limit($ticket->description, 60) }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <x-ticket-status-badge :status="$ticket->status" />
                                </td>
                                <td class="px-8 py-6">
                                    <x-ticket-priority-badge :priority="$ticket->priority" />
                                </td>
                                <td class="px-8 py-6">
                                    @if($ticket->assignee)
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-slate-800 border border-slate-700 flex items-center justify-center overflow-hidden">
                                                @if($ticket->assignee->avatar_path)
                                                    <img src="{{ asset('storage/' . $ticket->assignee->avatar_path) }}" alt="{{ $ticket->assignee->name }}" class="w-full h-full object-cover">
                                                @else
                                                    <span class="text-[10px] font-black text-slate-500 uppercase">{{ substr($ticket->assignee->name, 0, 1) }}</span>
                                                @endif
                                            </div>
                                            <span class="text-xs font-bold text-slate-300">{{ $ticket->assignee->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Unassigned</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="p-2 text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition-all" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0z"/><circle cx="12" cy="12" r="3"/></svg>
                                        </a>
                                        <a href="{{ route('tickets.edit', [$team, $ticket]) }}" class="p-2 text-slate-400 hover:text-blue-400 hover:bg-slate-800 rounded-lg transition-all" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <x-confirm-modal
        id="delete-ticket-modal"
        title="Delete Ticket"
        message="Are you sure you want to delete this ticket? This action cannot be undone."
        confirmText="Delete Ticket"
    />
</x-layouts.app>
