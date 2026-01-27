<x-layouts.app title="Pending Invitations - {{ $team->name }} - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-12">
            <div>
                <h2 class="text-4xl font-extrabold tracking-tight text-white mb-2">Pending Invitations</h2>
                <p class="text-slate-400 text-lg">Track and manage outstanding team invites.</p>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('members.index', $team) }}" class="inline-flex items-center gap-2 px-5 py-3 text-xs font-black uppercase tracking-widest text-slate-500 hover:text-white transition-colors">
                    Back to Directory
                </a>
                <x-blue-button href="{{ route('invitations.create', $team) }}" class="rounded-full px-6 py-3 shadow-lg shadow-blue-600/20 hover:scale-105 active:scale-95 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus mr-2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                    Send New Invite
                </x-blue-button>
            </div>
        </div>

        <!-- Invitations List -->
        <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] shadow-xl overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-800 bg-slate-900/80">
                <h3 class="text-xs font-black text-slate-500 uppercase tracking-[0.2em]">Sent Invites</h3>
            </div>

            @if($invitations->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-950/50 text-slate-500 uppercase tracking-[0.15em] text-[10px] font-black">
                        <tr>
                            <th class="px-8 py-5">Recipient Email</th>
                            <th class="px-8 py-5">Sender</th>
                            <th class="px-8 py-5">Sent Date</th>
                            <th class="px-8 py-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/50">
                        @foreach($invitations as $invitation)
                            <tr class="hover:bg-slate-800/30 transition-colors group">
                                <td class="px-8 py-5 text-white font-bold">
                                    {{ $invitation->email }}
                                </td>
                                <td class="px-8 py-5 text-slate-400 text-sm">
                                    {{ $invitation->invitedBy ? $invitation->invitedBy->name : 'Unknown' }}
                                </td>
                                <td class="px-8 py-5 text-slate-500 text-xs font-medium">
                                    {{ $invitation->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <button 
                                        onclick="openModal('cancel-invitation-modal', '{{ route('invitations.destroy', ['team' => $team, 'invitation' => $invitation]) }}')"
                                        class="p-2 text-slate-500 hover:text-red-500 hover:bg-slate-800 rounded-lg transition-all opacity-0 group-hover:opacity-100" 
                                        title="Revoke Invitation"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <div class="p-20 text-center text-slate-400">
                    <div class="mb-6 inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-slate-800/50 text-slate-600 border border-slate-700/50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 tracking-tight">No pending invitations</h3>
                    <p class="text-slate-500 font-medium max-w-xs mx-auto">All sent invitations have been accepted or revoked.</p>
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
</x-layouts.app>