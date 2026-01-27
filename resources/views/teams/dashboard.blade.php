<x-layouts.app title="{{ $team->name }} Dashboard - {{ config('app.name', 'Ticket Hub') }}">
    <div class="mb-8">
        <h2 class="text-3xl font-bold tracking-tight text-white">{{ $team->name }}</h2>
        <p class="text-slate-400 mt-2">Team Overview and recent activity.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Open Tickets -->
        <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-6 flex items-center justify-between hover:border-slate-600 transition-colors">
            <div>
                <p class="text-sm font-medium text-slate-400 mb-1">Open Tickets</p>
                <p class="text-3xl font-bold text-white">{{ $stats['open'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-blue-500/10 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="lucide lucide-ticket w-6 h-6 text-blue-500">
                    <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path>
                    <path d="M13 5v2"></path>
                    <path d="M13 17v2"></path>
                    <path d="M13 11v2"></path>
                </svg>
            </div>
        </div>

        <!-- In Progress -->
        <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-6 flex items-center justify-between hover:border-slate-600 transition-colors">
            <div>
                <p class="text-sm font-medium text-slate-400 mb-1">In Progress</p>
                <p class="text-3xl font-bold text-white">{{ $stats['in_progress'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-purple-500/10 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-6 h-6 text-purple-400">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
            </div>
        </div>

        <!-- Waiting -->
        <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-6 flex items-center justify-between hover:border-slate-600 transition-colors">
            <div>
                <p class="text-sm font-medium text-slate-400 mb-1">Waiting</p>
                <p class="text-3xl font-bold text-white">{{ $stats['waiting'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-orange-500/10 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert w-6 h-6 text-orange-400">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" x2="12" y1="8" y2="12"></line>
                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                </svg>
            </div>
        </div>

        <!-- Solved -->
        <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-6 flex items-center justify-between hover:border-slate-600 transition-colors">
            <div>
                <p class="text-sm font-medium text-slate-400 mb-1">Solved</p>
                <p class="text-3xl font-bold text-white">{{ $stats['closed'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-green-500/10 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check w-6 h-6 text-green-400">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="m9 12 2 2 4-4"></path>
                </svg>
            </div>
        </div>
    </div>

    @if($myTickets->isNotEmpty())
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-white mb-4">My Assigned Tickets</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3">
                @foreach($myTickets as $ticket)
                    <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="flex items-center gap-3 p-3 rounded-lg bg-slate-900/40 border border-slate-700/50 hover:border-blue-500/30 hover:bg-slate-900 transition-all group">
                        <!-- Status Indicator -->
                        <div class="flex-shrink-0">
                            @php
                                $statusColor = match($ticket->status) {
                                    \App\Enums\TicketStatus::OPEN => 'bg-blue-500',
                                    \App\Enums\TicketStatus::IN_PROGRESS => 'bg-purple-500',
                                    \App\Enums\TicketStatus::WAITING => 'bg-orange-500',
                                    \App\Enums\TicketStatus::CLOSED => 'bg-green-500',
                                };
                            @endphp
                           <div class="w-2.5 h-2.5 rounded-full {{ $statusColor }} shadow-[0_0_8px_rgba(var(--{{ str_replace('bg-', '', $statusColor) }}-500),0.5)]"></div>
                        </div>
                        
                        <!-- Content -->
                        <div class="flex-grow min-w-0">
                            <div class="flex items-center justify-between gap-2 mb-0.5">
                                <h4 class="text-sm font-medium text-white truncate group-hover:text-blue-400 transition-colors">{{ $ticket->title }}</h4>
                                <span class="text-[10px] text-slate-500 flex-shrink-0">{{ $ticket->created_at->diffForHumans(null, true) }}</span>
                            </div>
                            <div class="flex items-center text-xs text-slate-500 gap-2">
                                <div class="flex items-center gap-1.5 truncate">
                                    <div class="w-4 h-4 rounded-full bg-slate-800 flex items-center justify-center text-[8px] font-bold text-slate-400 border border-slate-700 overflow-hidden">
                                        @if($ticket->author?->avatar_path)
                                            <img src="{{ asset('storage/' . $ticket->author->avatar_path) }}" alt="{{ $ticket->author->name }}" class="w-full h-full object-cover">
                                        @else
                                            {{ substr($ticket->author?->name ?? '?', 0, 1) }}
                                        @endif
                                    </div>
                                    <span class="truncate">{{ $ticket->author?->name ?? 'Unknown' }}</span>
                                </div>
                                <span class="text-slate-700">•</span>
                                <span class="{{ $ticket->priority === \App\Enums\TicketPriority::HIGH ? 'text-red-400' : ($ticket->priority === \App\Enums\TicketPriority::MEDIUM ? 'text-yellow-400' : 'text-green-400') }}">
                                    {{ ucfirst($ticket->priority->value) }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Recent Tickets List -->
    <div class="bg-slate-900/50 border border-slate-700 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-700">
            <h3 class="text-lg font-semibold text-white">Recent Team Tickets</h3>
        </div>

        @if($recentTickets->isEmpty())
            <div class="p-12 text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-slate-800 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-inbox w-6 h-6 text-slate-400">
                        <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                        <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-white mb-2">No tickets found for this team</h3>
                <p class="text-slate-400 max-w-sm mx-auto mb-6">Clients haven't created any tickets for this team yet.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-950/50 text-slate-400 uppercase tracking-wider text-xs">
                        <tr>
                            <th class="px-6 py-4 font-medium">Title</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium">Priority</th>
                            <th class="px-6 py-4 font-medium">Assigned To</th>
                            <th class="px-6 py-4 font-medium">Created</th>
                            <th class="px-6 py-4 font-medium text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @foreach($recentTickets as $ticket)
                            <tr class="hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4">
                                    <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="font-medium text-white hover:text-blue-400 transition-colors">{{ $ticket->title }}</a>
                                    <div class="text-xs text-slate-500 truncate max-w-xs">{{ Str::limit($ticket->description, 50) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <x-ticket-status-badge :status="$ticket->status" />
                                </td>
                                <td class="px-6 py-4">
                                    <x-ticket-priority-badge :priority="$ticket->priority" />
                                </td>
                                <td class="px-6 py-4 text-slate-400">
                                    @if($ticket->assignee)
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-300 border border-slate-600 overflow-hidden">
                                                @if($ticket->assignee->avatar_path)
                                                    <img src="{{ asset('storage/' . $ticket->assignee->avatar_path) }}" alt="{{ $ticket->assignee->name }}" class="w-full h-full object-cover">
                                                @else
                                                    {{ substr($ticket->assignee->name, 0, 1) }}
                                                @endif
                                            </div>
                                            <span class="text-xs text-slate-300">{{ $ticket->assignee->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-500 italic">Unassigned</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-400">
                                    {{ $ticket->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end items-center gap-3">
                                        <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="text-slate-400 hover:text-white transition-colors" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0z"/><circle cx="12" cy="12" r="3"/></svg>
                                        </a>
                                        <a href="{{ route('tickets.edit', [$team, $ticket]) }}" class="text-slate-400 hover:text-blue-400 transition-colors" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                        </a>
                                        <button
                                            onclick="openModal('delete-ticket-modal', '{{ route('tickets.destroy', [$team, $ticket]) }}')"
                                            class="text-slate-400 hover:text-red-500 transition-colors"
                                            title="Delete"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                        </button>
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
