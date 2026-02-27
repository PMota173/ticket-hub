<x-layouts.app title="Member Profile - {{ $member->name }} - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="max-w-5xl mx-auto">
        <!-- Back Navigation -->
        <div class="mb-8 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <a href="{{ route('members.index', $team) }}" class="inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.08em] text-text-secondary hover:text-text-primary transition-colors duration-150 group">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:-translate-x-1"><path d="m15 18-6-6 6-6"/></svg>
                Team Directory
            </a>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 items-start">
            <!-- Member Card -->
            <div class="w-full lg:w-1/3 space-y-6 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
                <div class="bg-surface-1 border border-border rounded-[8px] p-6">
                    <div class="flex flex-col items-center text-center">
                        <div class="mb-6">
                            @if($member->avatar_path)
                                <img src="{{ asset('storage/' . $member->avatar_path) }}" 
                                     alt="{{ $member->name }}" 
                                     class="w-24 h-24 rounded-[6px] object-cover border border-border">
                            @else
                                <div class="w-24 h-24 rounded-[6px] bg-surface-2 border border-border flex items-center justify-center text-text-secondary font-display font-medium text-3xl">
                                    {{ substr($member->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        
                        <h1 class="text-2xl font-display font-medium text-text-primary tracking-tight mb-1">{{ $member->name }}</h1>
                        <p class="text-text-secondary font-mono text-[13px] mb-6">{{ $member->email }}</p>
                        
                        <div class="flex items-center gap-2 justify-center mb-8">
                            @if($is_admin)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-[4px] text-[10px] font-mono uppercase tracking-[0.08em] bg-accent/15 text-accent border border-accent/20">
                                    Admin Access
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-[4px] text-[10px] font-mono uppercase tracking-[0.08em] bg-surface-2 text-text-secondary border border-border">
                                    Team Member
                                </span>
                            @endif
                        </div>

                        @php
                            $currentUserIsAdmin = $team->users()->where('user_id', auth()->id())->first()->pivot->is_admin;
                        @endphp

                        @if($currentUserIsAdmin && auth()->id() !== $member->id)
                            <div class="w-full pt-6 border-t border-border flex flex-col gap-2">
                                <a href="{{ route('members.edit', ['team' => $team, 'member' => $member]) }}" class="w-full inline-flex justify-center items-center gap-2 px-4 py-2.5 bg-surface-2 hover:bg-surface-3 text-text-primary text-[11px] font-mono uppercase tracking-[0.08em] rounded-[6px] transition-all duration-150 border border-border">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                                    Modify Role
                                </a>
                                <button
                                    onclick="openModal('remove-member-modal', '{{ route('members.destroy', ['team' => $team, 'member' => $member]) }}')"
                                    class="w-full inline-flex justify-center items-center gap-2 px-4 py-2.5 bg-danger/5 hover:bg-danger/10 text-danger text-[11px] font-mono uppercase tracking-[0.08em] rounded-[6px] transition-all duration-150 border border-danger/10 hover:border-danger/20"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                                    Remove User
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-surface-1 border border-border rounded-[8px] p-5">
                    <div class="flex items-center justify-between text-[11px] font-mono text-text-muted uppercase tracking-[0.08em] mb-2">
                        <span>Joined Team</span>
                        <span class="text-text-primary">{{ $member_since->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">
                        <span>Tenure</span>
                        <span class="text-text-primary">{{ $member_since->diffForHumans(null, true) }}</span>
                    </div>
                </div>
            </div>

            <!-- Stats & Activity -->
            <div class="w-full lg:w-2/3 space-y-8 opacity-0 animate-[fadeIn_0.3s_ease-out_100ms_forwards]">
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="bg-surface-1 border border-border rounded-[8px] p-5 hover:border-border-light transition-all duration-150 group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-text-muted group-hover:text-text-primary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                            </div>
                        </div>
                        <p class="text-3xl font-mono font-medium text-text-primary mb-1 tracking-tight tabular-nums">{{ $member->tickets()->where('team_id', $team->id)->count() }}</p>
                        <p class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">Tickets Created</p>
                    </div>

                    <div class="bg-surface-1 border border-border rounded-[8px] p-5 hover:border-border-light transition-all duration-150 group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-text-muted group-hover:text-text-primary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="m9 12 2 2 4-4"/></svg>
                            </div>
                        </div>
                        <p class="text-3xl font-mono font-medium text-text-primary mb-1 tracking-tight tabular-nums">{{ \App\Models\Ticket::where('team_id', $team->id)->where('assigned_id', $member->id)->count() }}</p>
                        <p class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">Assigned Tasks</p>
                    </div>

                    <div class="bg-surface-1 border border-border rounded-[8px] p-5 hover:border-border-light transition-all duration-150 group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-text-muted group-hover:text-text-primary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                            </div>
                        </div>
                        <p class="text-3xl font-mono font-medium text-text-primary mb-1 tracking-tight tabular-nums">{{ $member->tickets()->where('team_id', $team->id)->open()->count() }}</p>
                        <p class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">Currently Open</p>
                    </div>
                </div>

                <!-- Assigned Tickets Table -->
                <div class="bg-surface-1 border border-border rounded-[8px] overflow-hidden">
                    <div class="px-6 py-4 border-b border-border bg-surface-2">
                        <h3 class="text-[11px] font-mono text-text-primary uppercase tracking-[0.08em]">Current Workload</h3>
                    </div>
                    
                    @php
                        $assignedTickets = \App\Models\Ticket::where('team_id', $team->id)
                            ->where('assigned_id', $member->id)
                            ->latest()
                            ->limit(5)
                            ->get();
                    @endphp

                    <div class="divide-y divide-border">
                        @forelse($assignedTickets as $ticket)
                            <div class="px-6 py-5 hover:bg-surface-2/50 transition-colors duration-150 group">
                                <div class="flex items-center justify-between mb-2">
                                    <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="font-medium text-text-primary hover:text-accent transition-colors text-[13px] truncate">
                                        {{ $ticket->title }}
                                    </a>
                                    <x-ticket-status-badge :status="$ticket->status" />
                                </div>
                                <p class="text-[12px] text-text-secondary line-clamp-1 mb-3">
                                    {{ $ticket->description }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">{{ $ticket->created_at->diffForHumans() }}</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">Priority</span>
                                        <x-ticket-priority-badge :priority="$ticket->priority" />
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-16 text-center">
                                <div class="mb-4 inline-flex items-center justify-center w-12 h-12 rounded-[6px] bg-surface-2 text-text-muted border border-border">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-muted"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                                </div>
                                <p class="text-text-secondary font-medium text-[13px]">No active tasks assigned.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-confirm-modal
        id="remove-member-modal"
        title="Remove Team Member"
        message="Are you sure you want to remove {{ $member->name }} from the team? This action cannot be undone."
        confirmText="Remove Member"
    />
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-layouts.app>
