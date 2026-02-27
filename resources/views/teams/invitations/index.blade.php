<x-layouts.app title="Pending Invitations - {{ $team->name }} - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="max-w-5xl mx-auto">
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-6 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <div>
                <h1 class="text-3xl font-display font-medium tracking-tight text-text-primary mb-2">Pending Invitations</h1>
                <p class="text-text-secondary text-[13px]">Track and manage outstanding team invites.</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('members.index', $team) }}" class="text-[11px] font-mono uppercase tracking-[0.08em] text-text-secondary hover:text-text-primary transition-colors duration-150">
                    Directory
                </a>
                <x-blue-button href="{{ route('invitations.create', $team) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                    Send Invite
                </x-blue-button>
            </div>
        </div>

        <!-- Invitations List -->
        <div class="bg-surface-1 border border-border rounded-[8px] overflow-hidden opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            <div class="px-6 py-4 border-b border-border bg-surface-2">
                <h3 class="text-[11px] font-mono text-text-primary uppercase tracking-[0.08em]">Sent Invites</h3>
            </div>

            @if($invitations->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-surface-1 text-text-muted uppercase tracking-[0.08em] text-[10px] font-mono">
                        <tr>
                            <th class="px-6 py-4 border-b border-border">Recipient Email</th>
                            <th class="px-6 py-4 border-b border-border">Sender</th>
                            <th class="px-6 py-4 border-b border-border">Sent Date</th>
                            <th class="px-6 py-4 border-b border-border text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @foreach($invitations as $invitation)
                            <tr class="hover:bg-surface-2/50 transition-colors duration-150 group">
                                <td class="px-6 py-4 text-text-primary font-medium text-[13px]">
                                    {{ $invitation->email }}
                                </td>
                                <td class="px-6 py-4 text-text-secondary text-[13px]">
                                    {{ $invitation->invitedBy ? $invitation->invitedBy->name : 'Unknown' }}
                                </td>
                                <td class="px-6 py-4 text-text-secondary font-mono text-[11px] uppercase tracking-[0.08em]">
                                    {{ $invitation->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button 
                                        onclick="openModal('cancel-invitation-modal', '{{ route('invitations.destroy', ['team' => $team, 'invitation' => $invitation]) }}')"
                                        class="p-1.5 text-text-muted hover:text-danger hover:bg-danger/10 rounded-[4px] transition-all duration-150 opacity-0 group-hover:opacity-100" 
                                        title="Revoke Invitation"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <div class="p-16 text-center">
                    <div class="mb-4 inline-flex items-center justify-center w-12 h-12 rounded-[6px] bg-surface-2 text-text-muted border border-border">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    </div>
                    <h3 class="text-[15px] font-medium text-text-primary mb-1">No pending invitations</h3>
                    <p class="text-text-secondary text-[13px] max-w-xs mx-auto">All sent invitations have been accepted or revoked.</p>
                </div>
            @endif
        </div>
    </div>

    <x-confirm-modal
        id="cancel-invitation-modal"
        title="Revoke Invitation"
        message="Are you sure you want to cancel this invitation? The link will be invalidated immediately."
        confirmText="Revoke Access"
    />
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-layouts.app>
