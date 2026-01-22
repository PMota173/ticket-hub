<x-layouts.app title="My Invitations - {{ config('app.name', 'Ticket Hub') }}" sidebar="global">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold tracking-tight text-white">My Invitations</h2>
            <p class="text-slate-400 mt-2">Manage your pending team invitations.</p>
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
                        <th class="px-6 py-4 font-medium">Team</th>
                        <th class="px-6 py-4 font-medium">Invited By</th>
                        <th class="px-6 py-4 font-medium">Sent At</th>
                        <th class="px-6 py-4 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @foreach($invitations as $invitation)
                        <tr class="hover:bg-slate-800/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded bg-slate-800 flex items-center justify-center text-slate-400 font-bold border border-slate-700">
                                        {{ substr($invitation->team->name, 0, 1) }}
                                    </div>
                                    <div class="font-medium text-white">
                                        {{ $invitation->team->name }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-400">
                                {{ $invitation->invitedBy ? $invitation->invitedBy->name : 'Unknown' }}
                            </td>
                            <td class="px-6 py-4 text-slate-400">
                                {{ $invitation->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end items-center gap-3">
                                    <a href="{{ route('invitations.accept', $invitation->token) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                        Accept
                                    </a>
                                    <button
                                        onclick="openModal('decline-invitation-modal-{{ $invitation->id }}', '{{ route('my-invitations.destroy', $invitation) }}')"
                                        class="text-slate-400 hover:text-red-500 transition-colors text-xs font-medium px-3 py-1.5 border border-slate-700 rounded-md hover:border-red-500/50"
                                    >
                                        Decline
                                    </button>
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
            <div class="p-12 text-center text-slate-400">
                <div class="mb-4 inline-flex items-center justify-center w-12 h-12 rounded-full bg-slate-800 text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-inbox"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
                </div>
                <h3 class="text-lg font-medium text-white mb-2">No pending invitations</h3>
                <p>You don't have any pending invitations at the moment.</p>
            </div>
        @endif
    </div>
</x-layouts.app>
