<x-layouts.app title="{{ $team->name }} Dashboard - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="mb-8 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
        <div class="flex items-center gap-4 mb-2">
            <div class="w-12 h-12 rounded-[6px] bg-surface-2 border border-border flex items-center justify-center text-text-primary font-mono text-xl overflow-hidden">
                @if($team->logo)
                    <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="w-full h-full object-cover">
                @else
                    {{ substr($team->name, 0, 1) }}
                @endif
            </div>
            <div>
                <h1 class="text-3xl font-display font-medium tracking-tight text-text-primary">{{ $team->name }}</h1>
                <p class="text-text-secondary text-[13px]">Workspace Overview</p>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
        <!-- Open Tickets -->
        <div class="bg-surface-1 border border-border rounded-[8px] p-5 hover:border-border-light transition-all duration-150 group">
            <div class="flex items-center justify-between mb-4">
                <div class="text-text-muted group-hover:text-text-primary transition-colors duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                </div>
                <span class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">Pending</span>
            </div>
            <p class="text-3xl font-mono font-medium text-text-primary mb-1 tracking-tight tabular-nums">{{ $stats['open'] }}</p>
            <p class="text-[11px] font-mono text-text-secondary uppercase tracking-[0.08em]">Open Tickets</p>
        </div>

        <!-- In Progress -->
        <div class="bg-surface-1 border border-border rounded-[8px] p-5 hover:border-border-light transition-all duration-150 group">
            <div class="flex items-center justify-between mb-4">
                <div class="text-text-muted group-hover:text-text-primary transition-colors duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <span class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">Active</span>
            </div>
            <p class="text-3xl font-mono font-medium text-text-primary mb-1 tracking-tight tabular-nums">{{ $stats['in_progress'] }}</p>
            <p class="text-[11px] font-mono text-text-secondary uppercase tracking-[0.08em]">In Progress</p>
        </div>

        <!-- Waiting -->
        <div class="bg-surface-1 border border-border rounded-[8px] p-5 hover:border-border-light transition-all duration-150 group">
            <div class="flex items-center justify-between mb-4">
                <div class="text-text-muted group-hover:text-text-primary transition-colors duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                </div>
                <span class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">Delayed</span>
            </div>
            <p class="text-3xl font-mono font-medium text-text-primary mb-1 tracking-tight tabular-nums">{{ $stats['waiting'] }}</p>
            <p class="text-[11px] font-mono text-text-secondary uppercase tracking-[0.08em]">Waiting</p>
        </div>

        <!-- Solved -->
        <div class="bg-surface-1 border border-border rounded-[8px] p-5 hover:border-border-light transition-all duration-150 group">
            <div class="flex items-center justify-between mb-4">
                <div class="text-text-muted group-hover:text-text-primary transition-colors duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                </div>
                <span class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">Complete</span>
            </div>
            <p class="text-3xl font-mono font-medium text-text-primary mb-1 tracking-tight tabular-nums">{{ $stats['closed'] }}</p>
            <p class="text-[11px] font-mono text-text-secondary uppercase tracking-[0.08em]">Solved Tickets</p>
        </div>
    </div>

    @if($myTickets->isNotEmpty())
        <div class="mb-12 opacity-0 animate-[fadeIn_0.3s_ease-out_100ms_forwards]">
            <h3 class="text-[11px] font-mono text-text-muted uppercase tracking-[0.08em] mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-accent"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Your Priority Tasks
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                @foreach($myTickets as $ticket)
                    <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="flex items-center gap-4 p-4 rounded-[6px] bg-surface-1 border border-border hover:border-border-light hover:bg-surface-2 transition-all duration-150 group">
                        <div class="flex-shrink-0">
                            @if($ticket->status === \App\Enums\TicketStatus::OPEN)
                                <div class="w-1.5 h-1.5 rounded-full bg-text-secondary"></div>
                            @elseif($ticket->status === \App\Enums\TicketStatus::IN_PROGRESS)
                                <div class="w-1.5 h-1.5 rounded-full bg-accent"></div>
                            @elseif($ticket->status === \App\Enums\TicketStatus::WAITING)
                                <div class="w-1.5 h-1.5 rounded-full bg-warning"></div>
                            @else
                                <div class="w-1.5 h-1.5 rounded-full bg-success"></div>
                            @endif
                        </div>
                        
                        <div class="flex-grow min-w-0">
                            <h4 class="text-[13px] font-medium text-text-primary truncate group-hover:text-accent transition-colors mb-1">{{ $ticket->title }}</h4>
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">{{ $ticket->created_at->diffForHumans(null, true) }}</span>
                                <x-ticket-priority-badge :priority="$ticket->priority" class="scale-90 origin-right" />
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Recent Tickets List -->
    <div class="bg-surface-1 border border-border rounded-[8px] overflow-hidden opacity-0 animate-[fadeIn_0.3s_ease-out_150ms_forwards]">
        <div class="px-6 py-4 border-b border-border bg-surface-2 flex items-center justify-between">
            <h3 class="text-[13px] font-mono text-text-primary uppercase tracking-[0.08em]">Recent Activity</h3>
            <a href="{{ route('tickets.index', $team) }}" class="text-[11px] font-mono text-accent uppercase tracking-[0.08em] hover:text-accent-hover transition-colors duration-150">Open Board</a>
        </div>

        @if($recentTickets->isEmpty())
            <div class="p-16 text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-[6px] bg-surface-2 mb-4 border border-border">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-muted">
                        <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                        <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                    </svg>
                </div>
                <h3 class="text-[15px] font-medium text-text-primary mb-1">No tickets found</h3>
                <p class="text-text-secondary text-[13px] max-w-sm mx-auto mb-6">This workspace is currently empty. Start by opening your first support ticket.</p>
                <x-blue-button href="{{ route('tickets.create', $team) }}">Open Ticket</x-blue-button>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-surface-1 text-text-muted uppercase tracking-[0.08em] text-[10px] font-mono">
                        <tr>
                            <th class="px-6 py-4 border-b border-border">Ticket Summary</th>
                            <th class="px-6 py-4 border-b border-border">Status</th>
                            <th class="px-6 py-4 border-b border-border">Priority</th>
                            <th class="px-6 py-4 border-b border-border">Assigned</th>
                            <th class="px-6 py-4 border-b border-border text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @foreach($recentTickets as $ticket)
                            <tr class="hover:bg-surface-2/50 transition-colors duration-150 group">
                                <td class="px-6 py-4">
                                    <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="font-medium text-text-primary hover:text-accent transition-colors block mb-1 text-[13px]">{{ $ticket->title }}</a>
                                    <div class="text-[11px] text-text-muted truncate max-w-xs">{{ Str::limit($ticket->description, 60) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <x-ticket-status-badge :status="$ticket->status" />
                                </td>
                                <td class="px-6 py-4">
                                    <x-ticket-priority-badge :priority="$ticket->priority" />
                                </td>
                                <td class="px-6 py-4">
                                    @if($ticket->assignee)
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-[4px] bg-surface-2 border border-border flex items-center justify-center overflow-hidden">
                                                @if($ticket->assignee->avatar_path)
                                                    <img src="{{ asset('storage/' . $ticket->assignee->avatar_path) }}" alt="{{ $ticket->assignee->name }}" class="w-full h-full object-cover">
                                                @else
                                                    <span class="text-[9px] font-mono text-text-secondary uppercase">{{ substr($ticket->assignee->name, 0, 1) }}</span>
                                                @endif
                                            </div>
                                            <span class="text-[12px] font-medium text-text-primary">{{ $ticket->assignee->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">Unassigned</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end items-center gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity duration-150">
                                        <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="p-1.5 text-text-muted hover:text-text-primary hover:bg-surface-3 rounded-[4px] transition-all" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                        </a>
                                        <a href="{{ route('tickets.edit', [$team, $ticket]) }}" class="p-1.5 text-text-muted hover:text-accent-hover hover:bg-surface-3 rounded-[4px] transition-all" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
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

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-layouts.app>
