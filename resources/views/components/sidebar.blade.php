@php
    $team = request()->route('team');
@endphp

<aside class="w-72 bg-slate-900 border-r border-slate-800 flex flex-col h-screen sticky top-0 font-sans">
    <!-- Header -->
    <div class="p-6">
        <div class="flex flex-col gap-1 mb-6">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-white transition-colors uppercase tracking-wider group">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:-translate-x-1"><path d="m15 18-6-6 6-6"/></svg>
                Dashboard
            </a>
        </div>

        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-600/10 flex items-center justify-center text-blue-500 font-bold border border-blue-500/20 shadow-lg shadow-blue-500/5 overflow-hidden">
                {{ substr($team->name ?? 'T', 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <h1 class="text-lg font-bold tracking-tight text-white truncate">{{ $team->name ?? 'Team' }}</h1>
                <p class="text-[10px] font-bold text-blue-500 uppercase tracking-widest">Workspace</p>
            </div>
        </div>
    </div>

    <!-- Divider -->
    <div class="h-px bg-slate-800 mx-6 mb-6"></div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 space-y-1">
        <a href="{{ route('teams.show', $team) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 group relative overflow-hidden {{ request()->routeIs('teams.show') ? 'text-white bg-blue-500/10' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
            @if(request()->routeIs('teams.show'))
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r-full"></div>
            @endif
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->routeIs('teams.show') ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
            Overview
        </a>

        <a href="{{ route('members.index', $team) }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 group relative overflow-hidden {{ request()->routeIs('members.index') ? 'text-white bg-blue-500/10' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
            @if(request()->routeIs('members.index'))
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r-full"></div>
            @endif
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->routeIs('members.index') ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            Members
        </a>

        <a href="{{ route('tickets.index', $team) }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 group relative overflow-hidden {{ request()->routeIs('tickets.index') ? 'text-white bg-blue-500/10' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
            @if(request()->routeIs('tickets.index'))
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r-full"></div>
            @endif
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->routeIs('tickets.index') ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors"><path d="M6 5v11"/><path d="M12 5v6"/><path d="M18 5v14"/></svg>
            Ticket Board
        </a>

        <a href="{{ route('tickets.create', $team) }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 group relative overflow-hidden {{ request()->routeIs('tickets.create') ? 'text-white bg-blue-500/10' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
            @if(request()->routeIs('tickets.create'))
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r-full"></div>
            @endif
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->routeIs('tickets.create') ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
            Create Ticket
        </a>

        @if($team->hasAdmin(auth()->user()))
        <div class="pt-6 pb-2 px-4">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Admin</p>
        </div>

        <a href="{{ route('teams.edit', $team) }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 group relative overflow-hidden {{ request()->routeIs('teams.edit') ? 'text-white bg-blue-500/10' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
            @if(request()->routeIs('teams.edit'))
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r-full"></div>
            @endif
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->routeIs('teams.edit') ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.72v.18a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
            Edit Team
        </a>

        <a href="{{ route('invitations.index', $team) }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 group relative overflow-hidden {{ request()->routeIs('invitations.*') ? 'text-white bg-blue-500/10' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
            @if(request()->routeIs('invitations.*'))
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r-full"></div>
            @endif
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->routeIs('invitations.*') ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            Pending Invitations
        </a>

        <a href="{{ route('robots.index', $team) }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 group relative overflow-hidden {{ request()->routeIs('robots.*') ? 'text-white bg-blue-500/10' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
            @if(request()->routeIs('robots.*'))
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r-full"></div>
            @endif
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->routeIs('robots.*') ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
            Team Robots
        </a>
        @endif
    </nav>

    <!-- User Profile Footer -->
    <div class="mt-auto p-4 border-t border-slate-800">
        <a href="{{ route('members.show', ['team' => $team, 'member' => auth()->user()]) }}" class="block group">
            <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-800 transition-colors">
                <div class="w-10 h-10 flex-shrink-0">
                    @if(auth()->user()->avatar_path)
                        <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}"
                             alt="{{ auth()->user()->name }}"
                             class="w-full h-full rounded-lg object-cover border border-slate-700">
                    @else
                        <div class="w-full h-full rounded-lg bg-slate-800 flex items-center justify-center text-slate-400 font-bold border border-slate-700">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-white truncate group-hover:text-blue-400 transition-colors">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                </div>
                <div class="flex-shrink-0">
                    <form action="/logout" method="POST" onclick="event.stopPropagation()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-slate-500 hover:text-red-400 transition-colors p-1" title="Log Out">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="lucide lucide-log-out">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                <polyline points="16 17 21 12 16 7"/>
                                <line x1="21" x2="9" y1="12" y2="12"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </a>
    </div>
</aside>
