<x-layouts.app title="Team Members - {{ $team->name }} - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="max-w-5xl mx-auto">
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-6 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <div>
                <div class="flex items-center gap-2 text-[11px] font-mono text-text-muted uppercase tracking-[0.08em] mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span>Organization</span>
                </div>
                <h1 class="text-3xl font-display font-medium tracking-tight text-text-primary mb-2">Team Directory</h1>
                <p class="text-text-secondary text-[13px]">Manage access and roles for your workspace.</p>
            </div>
            <x-blue-button href="{{ route('invitations.create', $team) }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                Invite Member
            </x-blue-button>
        </div>

        <!-- Members List -->
        <div class="bg-surface-1 border border-border rounded-[8px] overflow-hidden opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            <div class="px-6 py-4 border-b border-border bg-surface-2 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <h3 class="text-[11px] font-mono text-text-primary uppercase tracking-[0.08em]">All Members</h3>
                <div class="relative w-full md:w-64 group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-text-muted group-focus-within:text-accent transition-colors duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                    <input type="text" placeholder="Search directory..." class="block w-full pl-9 pr-3 py-2 border border-border rounded-[6px] bg-bg text-text-primary placeholder-text-muted focus:outline-none focus:ring-0 focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] text-[13px] transition-all duration-150">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-surface-1 text-text-muted uppercase tracking-[0.08em] text-[10px] font-mono">
                        <tr>
                            <th class="px-6 py-4 border-b border-border">User Profile</th>
                            <th class="px-6 py-4 border-b border-border">Role</th>
                            <th class="px-6 py-4 border-b border-border">Joined</th>
                            <th class="px-6 py-4 border-b border-border text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @php
                            $currentUserIsAdmin = $team->users()->where('user_id', auth()->id())->first()->pivot->is_admin;
                        @endphp
                        @foreach($members as $member)
                            <tr class="hover:bg-surface-2/50 transition-colors duration-150 group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($member->avatar_path)
                                            <img src="{{ asset('storage/' . $member->avatar_path) }}" 
                                                 alt="{{ $member->name }}" 
                                                 class="w-9 h-9 rounded-[4px] object-cover border border-border group-hover:border-border-light transition-colors">
                                        @else
                                            <div class="w-9 h-9 rounded-[4px] bg-surface-3 flex items-center justify-center text-text-secondary font-mono font-medium border border-border group-hover:border-border-light transition-colors text-xs">
                                                {{ substr($member->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <div class="min-w-0">
                                            <a href="{{ route('members.show', ['team' => $team, 'member' => $member]) }}" class="font-medium text-text-primary hover:text-accent transition-colors block text-[13px] truncate">
                                                {{ $member->name }}
                                            </a>
                                            <div class="text-[11px] text-text-muted font-mono truncate">{{ $member->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($member->pivot->is_admin)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-[4px] text-[10px] font-mono uppercase tracking-[0.08em] bg-accent/15 text-accent border border-accent/20">
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-[4px] text-[10px] font-mono uppercase tracking-[0.08em] bg-surface-2 text-text-secondary border border-border">
                                            Member
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-text-secondary font-mono text-[11px] uppercase tracking-[0.08em]">
                                    {{ $member->pivot->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end items-center gap-1.5">
                                        <a href="{{ route('members.show', ['team' => $team, 'member' => $member]) }}" class="p-1.5 text-text-muted hover:text-text-primary hover:bg-surface-3 rounded-[4px] transition-all duration-150" title="View Profile">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                        </a>
                                        @php
                                            $isCurrentUser = auth()->id() === $member->id;
                                        @endphp

                                        @if($currentUserIsAdmin && !$isCurrentUser)
                                            <a href="{{ route('members.edit', ['team' => $team, 'member' => $member]) }}" class="p-1.5 text-text-muted hover:text-accent hover:bg-surface-3 rounded-[4px] transition-all duration-150" title="Manage Role">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                                            </a>
                                            <button
                                                onclick="openModal('remove-member-modal', '{{ route('members.destroy', ['team' => $team, 'member' => $member]) }}')"
                                                class="p-1.5 text-text-muted hover:text-danger hover:bg-danger/10 rounded-[4px] transition-all duration-150"
                                                title="Remove Member"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                                            </button>
                                        @endif

                                        @if($isCurrentUser)
                                            <span class="px-2 py-0.5 text-[9px] font-mono uppercase tracking-[0.08em] text-text-muted bg-surface-2 border border-border rounded-[4px]">You</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-confirm-modal
        id="remove-member-modal"
        title="Remove Team Member"
        message="Are you sure you want to remove this member from the team? This action cannot be undone."
        confirmText="Remove Member"
    />
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-layouts.app>
