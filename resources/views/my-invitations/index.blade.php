<x-layouts.app title="My Invitations - {{ config('app.name', 'Ticket Hub') }}" sidebar="global">
    <div class="max-w-5xl mx-auto">
        <div class="mb-8 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <h1 class="text-3xl font-display font-medium tracking-tight text-text-primary mb-2">Workspace Inbox</h1>
            <p class="text-text-secondary text-[13px]">Manage your pending team invitations.</p>
        </div>

        <!-- Invitations List -->
        <div class="bg-surface-1 border border-border rounded-[8px] overflow-hidden opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            <div class="px-6 py-4 border-b border-border bg-surface-2">
                <h3 class="text-[11px] font-mono text-text-primary uppercase tracking-[0.08em]">Pending Requests</h3>
            </div>

            @if($invitations->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-surface-1 text-text-muted uppercase tracking-[0.08em] text-[10px] font-mono">
                        <tr>
                            <th class="px-6 py-4 border-b border-border">Workspace</th>
                            <th class="px-6 py-4 border-b border-border">Invited By</th>
                            <th class="px-6 py-4 border-b border-border">Received</th>
                            <th class="px-6 py-4 border-b border-border text-right">Response</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @foreach($invitations as $invitation)
                            <tr class="hover:bg-surface-2/50 transition-colors duration-150 group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-[4px] bg-surface-2 border border-border flex items-center justify-center text-text-secondary font-mono font-medium text-sm group-hover:text-accent group-hover:border-accent/30 transition-colors">
                                            {{ substr($invitation->team->name, 0, 1) }}
                                        </div>
                                        <div class="font-medium text-text-primary text-[13px]">
                                            {{ $invitation->team->name }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-text-secondary text-[13px]">
                                    {{ $invitation->invitedBy ? $invitation->invitedBy->name : 'Unknown' }}
                                </td>
                                <td class="px-6 py-4 text-text-muted font-mono text-[11px] uppercase tracking-[0.08em]">
                                    {{ $invitation->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end items-center gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-150">
                                        <button
                                            onclick="openModal('decline-invitation-modal-{{ $invitation->id }}', '{{ route('my-invitations.destroy', $invitation) }}')"
                                            class="text-[11px] font-mono uppercase tracking-[0.08em] text-text-muted hover:text-danger transition-colors"
                                        >
                                            Decline
                                        </button>
                                        <a href="{{ route('invitations.accept', $invitation->token) }}" class="inline-flex items-center px-4 py-2 bg-accent hover:bg-accent-hover text-white text-[11px] font-mono uppercase tracking-[0.08em] rounded-[6px] transition-all duration-150 hover:shadow-[0_0_12px_var(--color-accent-glow)]">
                                            Join Team
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <x-confirm-modal
                                id="decline-invitation-modal-{{ $invitation->id }}"
                                title="Decline Invitation"
                                message="Are you sure you want to decline the invitation to join {{ $invitation->team->name }}?"
                                confirmText="Decline"
                            />
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <div class="p-16 text-center">
                    <div class="mb-4 inline-flex items-center justify-center w-12 h-12 rounded-[6px] bg-surface-2 text-text-muted border border-border">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle-2"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                    </div>
                    <h3 class="text-[15px] font-medium text-text-primary mb-1">Inbox empty</h3>
                    <p class="text-text-secondary text-[13px] max-w-xs mx-auto">You have no pending invitations to review.</p>
                </div>
            @endif
        </div>
    </div>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-layouts.app>
