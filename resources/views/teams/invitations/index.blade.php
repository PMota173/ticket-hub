<x-layouts.app title="Pending Invitations - {{ $team->name }} - {{ config('app.name', 'Ticket Hub') }}">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold tracking-tight text-white">Pending Invitations</h2>
            <p class="text-slate-400 mt-2">Manage pending invitations for your team.</p>
        </div>
        <div class="flex gap-4">
            <x-gray-button href="{{ route('members.index', $team) }}">
                Back to Members
            </x-gray-button>
            <x-blue-button href="{{ route('invitations.create', $team) }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                Invite Member
            </x-blue-button>
        </div>
    </div>

    <!-- Invitations List -->
    <div class="bg-slate-900/50 border border-slate-700 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-700">
            <h3 class="text-lg font-semibold text-white">Pending Invites</h3>
        </div>

        @if($invitations->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-950/50 text-slate-400 uppercase tracking-wider text-xs">
                    <tr>
                        <th class="px-6 py-4 font-medium">Email</th>
                        <th class="px-6 py-4 font-medium">Invited By</th>
                        <th class="px-6 py-4 font-medium">Sent At</th>
                        <th class="px-6 py-4 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @foreach($invitations as $invitation)
                        <tr class="hover:bg-slate-800/30 transition-colors">
                            <td class="px-6 py-4 text-white">
                                {{ $invitation->email }}
                            </td>
                            <td class="px-6 py-4 text-slate-400">
                                {{ $invitation->invitedBy ? $invitation->invitedBy->name : 'Unknown' }}
                            </td>
                            <td class="px-6 py-4 text-slate-400">
                                {{ $invitation->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button 
                                    onclick="openModal('cancel-invitation-modal', '{{ route('invitations.destroy', ['team' => $team, 'invitation' => $invitation]) }}')"
                                    class="text-slate-400 hover:text-red-500 transition-colors" 
                                    title="Cancel Invitation"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <div class="p-12 text-center text-slate-400">
                <div class="mb-4 inline-flex items-center justify-center w-12 h-12 rounded-full bg-slate-800 text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                </div>
                <h3 class="text-lg font-medium text-white mb-2">No pending invitations</h3>
                <p>Invite new members to your team to see them here.</p>
            </div>
        @endif
    </div>

    <x-confirm-modal
        id="cancel-invitation-modal"
        title="Cancel Invitation"
        message="Are you sure you want to cancel this invitation? The link will no longer be valid."
        confirmText="Cancel Invitation"
    />
</x-layouts.app>
