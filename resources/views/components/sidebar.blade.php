@php
    $team = request()->route('team');
@endphp

<aside class="w-64 bg-bg border-r border-border flex flex-col h-screen sticky top-0 font-mono">
    <!-- Header -->
    <div class="p-6 border-b border-border">
        <div class="flex flex-col gap-2 mb-4">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-[10px] font-mono font-medium text-text-muted hover:text-text-primary transition-colors uppercase tracking-widest group">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" class="transition-transform group-hover:-translate-x-1"><path d="m15 18-6-6 6-6"/></svg>
                dashboard_
            </a>
        </div>

        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-surface-2 flex items-center justify-center text-text-primary font-medium border border-border overflow-hidden text-xs">
                {{ substr($team->name ?? 'T', 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <h1 class="text-xs font-semibold text-text-primary truncate uppercase tracking-widest">{{ $team->name ?? 'Team' }}</h1>
                <p class="text-[10px] text-text-muted truncate">workspace</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex-1 py-6 overflow-y-auto">
        <div class="px-6 mb-4">
            <span class="text-xs text-text-muted uppercase tracking-widest">// Team</span>
        </div>
        <nav class="space-y-1">
            <a href="{{ route('teams.show', $team) }}" class="flex items-center gap-3 px-6 py-2 text-sm transition-all duration-150 group relative {{ request()->routeIs('teams.show') ? 'text-text-primary bg-surface-1 border-l border-text-primary' : 'text-text-secondary hover:text-text-primary hover:bg-surface-1 border-l border-transparent' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" class="{{ request()->routeIs('teams.show') ? 'text-text-primary' : 'text-text-secondary group-hover:text-text-primary' }} transition-colors duration-150"><rect width="7" height="9" x="3" y="3"/><rect width="7" height="5" x="14" y="3"/><rect width="7" height="9" x="14" y="12"/><rect width="7" height="5" x="3" y="16"/></svg>
                overview_
            </a>

            <a href="{{ route('members.index', $team) }}"
               class="flex items-center gap-3 px-6 py-2 text-sm transition-all duration-150 group relative {{ request()->routeIs('members.index') ? 'text-text-primary bg-surface-1 border-l border-text-primary' : 'text-text-secondary hover:text-text-primary hover:bg-surface-1 border-l border-transparent' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" class="{{ request()->routeIs('members.index') ? 'text-text-primary' : 'text-text-secondary group-hover:text-text-primary' }} transition-colors duration-150"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                members_
            </a>

            <a href="{{ route('tickets.inbox', $team) }}"
               class="flex items-center justify-between px-6 py-2 text-sm transition-all duration-150 group relative {{ request()->routeIs('tickets.inbox') ? 'text-text-primary bg-surface-1 border-l border-text-primary' : 'text-text-secondary hover:text-text-primary hover:bg-surface-1 border-l border-transparent' }}">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" class="{{ request()->routeIs('tickets.inbox') ? 'text-text-primary' : 'text-text-secondary group-hover:text-text-primary' }} transition-colors duration-150"><path d="M22 13V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h8"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/><path d="M19 16v6"/><path d="M22 19h-6"/></svg>
                    inbox_
                </div>
            </a>

            <a href="{{ route('tickets.index', $team) }}"
               class="flex items-center gap-3 px-6 py-2 text-sm transition-all duration-150 group relative {{ request()->routeIs('tickets.index') ? 'text-text-primary bg-surface-1 border-l border-text-primary' : 'text-text-secondary hover:text-text-primary hover:bg-surface-1 border-l border-transparent' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" class="{{ request()->routeIs('tickets.index') ? 'text-text-primary' : 'text-text-secondary group-hover:text-text-primary' }} transition-colors duration-150"><path d="M6 5v11"/><path d="M12 5v6"/><path d="M18 5v14"/></svg>
                ticket_board_
            </a>

            <a href="{{ route('tickets.create', $team) }}"
               class="flex items-center gap-3 px-6 py-2 text-sm transition-all duration-150 group relative {{ request()->routeIs('tickets.create') ? 'text-text-primary bg-surface-1 border-l border-text-primary' : 'text-text-secondary hover:text-text-primary hover:bg-surface-1 border-l border-transparent' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" class="{{ request()->routeIs('tickets.create') ? 'text-text-primary' : 'text-text-secondary group-hover:text-text-primary' }} transition-colors duration-150"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                create_ticket_
            </a>

            @if($team->hasAdmin(auth()->user()))
            <div class="px-6 pt-6 pb-2">
                <span class="text-xs text-text-muted uppercase tracking-widest">// Admin</span>
            </div>

            <a href="{{ route('teams.edit', $team) }}"
               class="flex items-center gap-3 px-6 py-2 text-sm transition-all duration-150 group relative {{ request()->routeIs('teams.edit') ? 'text-text-primary bg-surface-1 border-l border-text-primary' : 'text-text-secondary hover:text-text-primary hover:bg-surface-1 border-l border-transparent' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" class="{{ request()->routeIs('teams.edit') ? 'text-text-primary' : 'text-text-secondary group-hover:text-text-primary' }} transition-colors duration-150"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.72v.18a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                edit_team_
            </a>

            <a href="{{ route('invitations.index', $team) }}"
               class="flex items-center gap-3 px-6 py-2 text-sm transition-all duration-150 group relative {{ request()->routeIs('invitations.*') ? 'text-text-primary bg-surface-1 border-l border-text-primary' : 'text-text-secondary hover:text-text-primary hover:bg-surface-1 border-l border-transparent' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" class="{{ request()->routeIs('invitations.*') ? 'text-text-primary' : 'text-text-secondary group-hover:text-text-primary' }} transition-colors duration-150"><rect width="20" height="16" x="2" y="4"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                invitations_
            </a>

            <a href="{{ route('robots.index', $team) }}"
               class="flex items-center gap-3 px-6 py-2 text-sm transition-all duration-150 group relative {{ request()->routeIs('robots.*') ? 'text-text-primary bg-surface-1 border-l border-text-primary' : 'text-text-secondary hover:text-text-primary hover:bg-surface-1 border-l border-transparent' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" class="{{ request()->routeIs('robots.*') ? 'text-text-primary' : 'text-text-secondary group-hover:text-text-primary' }} transition-colors duration-150"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
                team_robots_
            </a>
            @endif
        </nav>
    </div>

    <!-- User Profile Footer -->
    <div class="mt-auto border-t border-border bg-surface-1">
        <a href="{{ route('members.show', ['team' => $team, 'member' => auth()->user()]) }}" class="block group p-4 hover:bg-surface-2 transition-colors duration-150">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 flex-shrink-0">
                    @if(auth()->user()->avatar_path)
                        <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}"
                             alt="{{ auth()->user()->name }}"
                             class="w-full h-full object-cover border border-border">
                    @else
                        <div class="w-full h-full bg-bg flex items-center justify-center text-text-primary border border-border text-xs">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-text-primary truncate group-hover:text-accent transition-colors duration-150">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-text-muted truncate">usr_{{ substr(md5(auth()->user()->id), 0, 6) }}</p>
                </div>
                <div class="flex-shrink-0">
                    <form action="/logout" method="POST" onclick="event.stopPropagation()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-text-muted hover:text-danger transition-colors duration-150 p-1 border border-transparent hover:border-danger" title="Log Out">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter">
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