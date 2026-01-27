<x-layouts.app title="Member Profile - {{ $member->name }} - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="max-w-5xl mx-auto">
        <!-- Back Navigation -->
        <div class="mb-12">
            <x-back-button href="{{ route('members.index', $team) }}">Back to Directory</x-back-button>
        </div>

        <div class="flex flex-col lg:flex-row gap-10 items-start">
            <!-- Member Card -->
            <div class="w-full lg:w-1/3 space-y-8">
                <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] p-8 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-32 bg-gradient-to-b from-slate-800/50 to-transparent"></div>
                    
                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="mb-6">
                            @if($member->avatar_path)
                                <img src="{{ asset('storage/' . $member->avatar_path) }}" 
                                     alt="{{ $member->name }}" 
                                     class="w-32 h-32 rounded-[2rem] object-cover border-4 border-slate-900 shadow-2xl">
                            @else
                                <div class="w-32 h-32 rounded-[2rem] bg-slate-800 flex items-center justify-center text-slate-500 font-black text-4xl border-4 border-slate-900 shadow-2xl">
                                    {{ substr($member->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        
                        <h1 class="text-2xl font-black text-white tracking-tight mb-2">{{ $member->name }}</h1>
                        <p class="text-slate-400 font-medium text-sm mb-6">{{ $member->email }}</p>
                        
                        <div class="flex items-center gap-3 justify-center mb-8">
                            @if($is_admin)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-blue-500 text-white shadow-lg shadow-blue-500/20">
                                    Admin Access
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-slate-800 text-slate-400 border border-slate-700">
                                    Team Member
                                </span>
                            @endif
                        </div>

                        @php
                            $currentUserIsAdmin = $team->users()->where('user_id', auth()->id())->first()->pivot->is_admin;
                        @endphp

                        @if($currentUserIsAdmin && auth()->id() !== $member->id)
                            <div class="w-full pt-8 border-t border-slate-800/50 flex flex-col gap-3">
                                <a href="{{ route('members.edit', ['team' => $team, 'member' => $member]) }}" class="w-full inline-flex justify-center items-center gap-2 px-4 py-3 bg-slate-950 hover:bg-slate-800 text-slate-300 hover:text-white text-xs font-bold rounded-xl transition-all border border-slate-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                                    Modify Role
                                </a>
                                <button
                                    onclick="openModal('remove-member-modal', '{{ route('members.destroy', ['team' => $team, 'member' => $member]) }}')"
                                    class="w-full inline-flex justify-center items-center gap-2 px-4 py-3 bg-red-500/5 hover:bg-red-500/10 text-red-400 hover:text-red-300 text-xs font-bold rounded-xl transition-all border border-red-500/10 hover:border-red-500/20"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                                    Remove User
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-slate-900/30 border border-slate-800 rounded-3xl p-6">
                    <div class="flex items-center justify-between text-xs font-medium text-slate-500 mb-2">
                        <span>Joined Team</span>
                        <span class="text-white font-bold">{{ $member_since->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between text-xs font-medium text-slate-500">
                        <span>Tenure</span>
                        <span class="text-white font-bold">{{ $member_since->diffForHumans(null, true) }}</span>
                    </div>
                </div>
            </div>

            <!-- Stats & Activity -->
            <div class="w-full lg:w-2/3 space-y-8">
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="bg-slate-900/50 border border-slate-800 rounded-3xl p-6 hover:border-blue-500/30 transition-colors group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-2 bg-blue-500/10 rounded-xl text-blue-500 group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                            </div>
                        </div>
                        <p class="text-3xl font-black text-white mb-1 tracking-tight">{{ $member->tickets()->where('team_id', $team->id)->count() }}</p>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Tickets Created</p>
                    </div>

                    <div class="bg-slate-900/50 border border-slate-800 rounded-3xl p-6 hover:border-purple-500/30 transition-colors group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-2 bg-purple-500/10 rounded-xl text-purple-500 group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="m9 12 2 2 4-4"/></svg>
                            </div>
                        </div>
                        <p class="text-3xl font-black text-white mb-1 tracking-tight">{{ \App\Models\Ticket::where('team_id', $team->id)->where('assigned_id', $member->id)->count() }}</p>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Assigned Tasks</p>
                    </div>

                    <div class="bg-slate-900/50 border border-slate-800 rounded-3xl p-6 hover:border-green-500/30 transition-colors group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-2 bg-green-500/10 rounded-xl text-green-500 group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                            </div>
                        </div>
                        <p class="text-3xl font-black text-white mb-1 tracking-tight">{{ $member->tickets()->where('team_id', $team->id)->open()->count() }}</p>
                        <p class="text--[10px] font-black text-slate-500 uppercase tracking-widest">Currently Open</p>
                    </div>
                </div>

                <!-- Assigned Tickets Table -->
                <div class="bg-slate-900/50 border border-slate-800 rounded-3xl shadow-lg overflow-hidden">
                    <div class="px-8 py-6 border-b border-slate-800 bg-slate-900/80">
                        <h3 class="text-xs font-black text-slate-500 uppercase tracking-[0.2em]">Current Workload</h3>
                    </div>
                    
                    @php
                        $assignedTickets = \App\Models\Ticket::where('team_id', $team->id)
                            ->where('assigned_id', $member->id)
                            ->latest()
                            ->limit(5)
                            ->get();
                    @endphp

                    <div class="divide-y divide-slate-800/50">
                        @forelse($assignedTickets as $ticket)
                            <div class="p-6 hover:bg-slate-800/30 transition-colors group">
                                <div class="flex items-center justify-between mb-2">
                                    <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="font-bold text-white hover:text-blue-400 transition-colors text-sm">
                                        {{ $ticket->title }}
                                    </a>
                                    <x-ticket-status-badge :status="$ticket->status" />
                                </div>
                                <p class="text-xs text-slate-500 line-clamp-1 mb-3 font-medium">
                                    {{ $ticket->description }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-bold text-slate-600 uppercase tracking-wide">{{ $ticket->created_at->diffForHumans() }}</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-bold text-slate-600 uppercase tracking-wide">Priority</span>
                                        <x-ticket-priority-badge :priority="$ticket->priority" />
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-16 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-slate-800/50 mb-4 border border-slate-700/50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-600"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                                </div>
                                <p class="text-slate-500 font-bold text-sm">No active tasks assigned.</p>
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
</x-layouts.app>