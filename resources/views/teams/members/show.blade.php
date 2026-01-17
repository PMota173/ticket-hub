<x-layouts.app title="Member Profile - {{ $member->name }} - {{ config('app.name', 'Ticket Hub') }}">
    <div class="mb-8">
        <x-back-button href="{{ route('members.index', $team) }}">Back to Members</x-back-button>
    </div>

    <div class="max-w-4xl">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
            <div class="flex items-center gap-6">
                <div class="w-24 h-24 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 text-3xl font-bold border-2 border-slate-700 shadow-xl shadow-slate-950/50">
                    {{ substr($member->name, 0, 1) }}
                </div>
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <h2 class="text-3xl font-bold tracking-tight text-white">{{ $member->name }}</h2>
                        @if($is_admin)
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                Admin
                            </span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-slate-500/10 text-slate-400 border border-slate-700">
                                Member
                            </span>
                        @endif
                    </div>
                    <p class="text-slate-400 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail w-4 h-4"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        {{ $member->email }}
                    </p>
                    <p class="text-xs text-slate-500 mt-2">
                        Joined the team on {{ $member_since->format('F d, Y') }}
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                @php
                    $currentUserIsAdmin = $team->users()->where('user_id', auth()->id())->first()->pivot->is_admin;
                @endphp

                @if($currentUserIsAdmin && auth()->id() !== $member->id)
                    <x-gray-button href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check w-4 h-4"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                        Change Role
                    </x-gray-button>

                    <button
                        onclick="openModal('remove-member-modal', '{{ route('members.destroy', ['team' => $team, 'member' => $member]) }}')"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-semibold text-red-400 transition-all duration-200 bg-red-500/10 rounded-lg border border-red-500/20 hover:bg-red-500 hover:text-white hover:shadow-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-minus w-4 h-4"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                        Remove from Team
                    </button>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-6">
                <p class="text-sm font-medium text-slate-400 mb-1">Total Tickets Created</p>
                <p class="text-3xl font-bold text-white">{{ $member->tickets()->where('team_id', $team->id)->count() }}</p>
            </div>
            <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-6">
                <p class="text-sm font-medium text-slate-400 mb-1">Open Tickets</p>
                <p class="text-3xl font-bold text-white">{{ $member->tickets()->where('team_id', $team->id)->where('status', 'open')->count() }}</p>
            </div>
            <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-6">
                <p class="text-sm font-medium text-slate-400 mb-1">Member Since</p>
                <p class="text-xl font-bold text-white">{{ $member_since->diffForHumans(null, true) }}</p>
            </div>
        </div>

        <div class="bg-slate-900/30 rounded-xl border border-slate-800 overflow-hidden">
            <div class="p-6 border-b border-slate-800">
                <h3 class="text-lg font-semibold text-white">Recent Activity</h3>
            </div>
            <div class="p-0">
                @php
                    $recentTickets = $member->tickets()->where('team_id', $team->id)->latest()->limit(5)->get();
                @endphp

                @forelse($recentTickets as $ticket)
                    <div class="p-6 border-b border-slate-800/50 last:border-0 hover:bg-slate-800/20 transition-colors">
                        <div class="flex items-center justify-between mb-2">
                            <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="font-semibold text-white hover:text-blue-400 transition-colors">
                                {{ $ticket->title }}
                            </a>
                            <span class="text-xs font-medium px-2 py-0.5 rounded-full
                                @if($ticket->status === 'open') bg-blue-500/10 text-blue-400
                                @elseif($ticket->status === 'closed') bg-green-500/10 text-green-400
                                @else bg-slate-500/10 text-slate-400
                                @endif
                            ">
                                {{ ucfirst($ticket->status) }}
                            </span>
                        </div>
                        <p class="text-sm text-slate-400 line-clamp-1 mb-2">
                            {{ $ticket->description }}
                        </p>
                        <p class="text-xs text-slate-500">
                            Created {{ $ticket->created_at->diffForHumans() }}
                        </p>
                    </div>
                @empty
                    <div class="p-12 text-center text-slate-500">
                        No recent ticket activity found for this member.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <x-confirm-modal
        id="remove-member-modal"
        title="Remove Team Member"
        message="Are you sure you want to remove {{ $member->name }} from the team? This action cannot be undone."
        confirmText="Remove Member"
    />
</x-layouts.app>
