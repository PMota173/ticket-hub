<x-layouts.app title="Team Members - {{ $team->name }} - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-12">
            <div>
                <h2 class="text-4xl font-extrabold tracking-tight text-white mb-2">Team Directory</h2>
                <p class="text-slate-400 text-lg">Manage access and roles for your workspace.</p>
            </div>
            <x-blue-button href="{{ route('invitations.create', $team) }}" class="rounded-full px-6 py-3 shadow-lg shadow-blue-600/20 hover:scale-105 active:scale-95 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus mr-2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                Invite Member
            </x-blue-button>
        </div>

        <!-- Members List -->
        <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] shadow-xl overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-800 bg-slate-900/80 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <h3 class="text-xs font-black text-slate-500 uppercase tracking-[0.2em]">All Members</h3>
                <div class="relative w-full md:w-64 group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500 group-focus-within:text-blue-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                    <input type="text" placeholder="Search directory..." class="block w-full pl-10 pr-4 py-2.5 border border-slate-800 rounded-xl bg-slate-950 text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm font-medium transition-all">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-950/50 text-slate-500 uppercase tracking-[0.15em] text-[10px] font-black">
                        <tr>
                            <th class="px-8 py-5">User Profile</th>
                            <th class="px-8 py-5">Role</th>
                            <th class="px-8 py-5">Joined</th>
                            <th class="px-8 py-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/50">
                        @php
                            $currentUserIsAdmin = $team->users()->where('user_id', auth()->id())->first()->pivot->is_admin;
                        @endphp
                        @foreach($members as $member)
                            <tr class="hover:bg-slate-800/30 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        @if($member->avatar_path)
                                            <img src="{{ asset('storage/' . $member->avatar_path) }}" 
                                                 alt="{{ $member->name }}" 
                                                 class="w-10 h-10 rounded-xl object-cover border border-slate-700 group-hover:border-blue-500/30 transition-colors">
                                        @else
                                            <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 font-bold border border-slate-700 group-hover:border-blue-500/30 transition-colors">
                                                {{ substr($member->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <div>
                                            <a href="{{ route('members.show', ['team' => $team, 'member' => $member]) }}" class="font-bold text-white hover:text-blue-400 transition-colors block text-sm mb-0.5">
                                                {{ $member->name }}
                                            </a>
                                            <div class="text-[10px] text-slate-500 font-medium">{{ $member->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    @if($member->pivot->is_admin)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest bg-slate-800 text-slate-500 border border-slate-700">
                                            Member
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-5 text-slate-400 text-xs font-medium">
                                    {{ $member->pivot->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div class="flex justify-end items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('members.show', ['team' => $team, 'member' => $member]) }}" class="p-2 text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition-all" title="View Profile">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0z"/><circle cx="12" cy="12" r="3"/></svg>
                                        </a>
                                        @php
                                            $isCurrentUser = auth()->id() === $member->id;
                                        @endphp

                                        @if($currentUserIsAdmin && !$isCurrentUser)
                                            <a href="{{ route('members.edit', ['team' => $team, 'member' => $member]) }}" class="p-2 text-slate-400 hover:text-blue-400 hover:bg-slate-800 rounded-lg transition-all" title="Manage Role">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                                            </a>
                                            <button
                                                onclick="openModal('remove-member-modal', '{{ route('members.destroy', ['team' => $team, 'member' => $member]) }}')"
                                                class="p-2 text-slate-400 hover:text-red-500 hover:bg-slate-800 rounded-lg transition-all"
                                                title="Remove Member"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-minus"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                                            </button>
                                        @endif

                                        @if($isCurrentUser)
                                            <span class="px-2 py-1 text-[10px] font-black uppercase tracking-widest text-slate-500 bg-slate-950 rounded-lg">You</span>
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
</x-layouts.app>
