<x-layouts.app title="My Invitations - {{ config('app.name', 'Ticket Hub') }}" sidebar="global">
    <div class="max-w-5xl mx-auto">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="text-4xl font-extrabold tracking-tight text-white mb-2">Inbox</h2>
                <p class="text-slate-400 text-lg">Manage your pending team invitations.</p>
            </div>
        </div>

        <!-- Invitations List -->
        <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] shadow-xl overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-800 bg-slate-900/80">
                <h3 class="text-xs font-black text-slate-500 uppercase tracking-[0.2em]">Pending Requests</h3>
            </div>

            @if($invitations->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-950/50 text-slate-500 uppercase tracking-[0.15em] text-[10px] font-black">
                        <tr>
                            <th class="px-8 py-5">Workspace</th>
                            <th class="px-8 py-5">Invited By</th>
                            <th class="px-8 py-5">Received</th>
                            <th class="px-8 py-5 text-right">Response</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/50">
                        @foreach($invitations as $invitation)
                            <tr class="hover:bg-slate-800/30 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 font-bold border border-slate-700 shadow-inner">
                                            {{ substr($invitation->team->name, 0, 1) }}
                                        </div>
                                        <div class="font-bold text-white text-sm">
                                            {{ $invitation->team->name }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-slate-400 text-sm font-medium">
                                    {{ $invitation->invitedBy ? $invitation->invitedBy->name : 'Unknown' }}
                                </td>
                                <td class="px-8 py-5 text-slate-500 text-xs font-medium">
                                    {{ $invitation->created_at->diffForHumans() }}
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div class="flex justify-end items-center gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button
                                            onclick="openModal('decline-invitation-modal-{{ $invitation->id }}', '{{ route('my-invitations.destroy', $invitation) }}')"
                                            class="text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-red-400 transition-colors px-4 py-2"
                                        >
                                            Decline
                                        </button>
                                        <a href="{{ route('invitations.accept', $invitation->token) }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all shadow-lg hover:scale-105">
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
                <div class="p-20 text-center">
                    <div class="mb-6 inline-flex items-center justify-center w-20 h-20 rounded-[2rem] bg-slate-800/50 text-slate-600 border border-slate-700/50 shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle-2"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 tracking-tight">All caught up</h3>
                    <p class="text-slate-500 font-medium">You have no pending invitations to review.</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>