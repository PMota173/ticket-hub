<aside class="w-72 bg-surface-1 border-r border-border flex flex-col h-screen sticky top-0 font-sans">
    <!-- Header -->
    <div class="p-6">
        <a href="/" class="flex items-center gap-3 mb-8 group transition-colors duration-150">
            <div class="w-10 h-10 bg-accent rounded-[6px] flex items-center justify-center transition-transform duration-150 group-hover:-translate-y-[1px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="text-white">
                    <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/>
                    <path d="M13 5v2"/>
                    <path d="M13 17v2"/>
                    <path d="M13 11v2"/>
                </svg>
            </div>
            <span class="text-xl font-display font-medium tracking-tight text-text-primary group-hover:text-accent transition-colors duration-150">Ticket Hub</span>
        </a>

        <!-- Navigation -->
        <nav class="space-y-1">
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-[6px] text-sm font-medium transition-all duration-150 group relative {{ request()->routeIs('dashboard') ? 'text-text-primary bg-surface-2 border-l-[2px] border-accent' : 'text-text-secondary hover:text-text-primary hover:bg-surface-2 border-l-[2px] border-transparent' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->routeIs('dashboard') ? 'text-text-primary' : 'text-text-secondary group-hover:text-text-primary' }} transition-colors duration-150"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                Feed
            </a>

            <a href="{{ route('portal.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-[6px] text-sm font-medium transition-all duration-150 group relative {{ request()->routeIs('portal.index') ? 'text-text-primary bg-surface-2 border-l-[2px] border-accent' : 'text-text-secondary hover:text-text-primary hover:bg-surface-2 border-l-[2px] border-transparent' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->routeIs('portal.index') ? 'text-text-primary' : 'text-text-secondary group-hover:text-text-primary' }} transition-colors duration-150"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>
                Explore
            </a>
            
            <a href="{{ route('teams.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-[6px] text-sm font-medium transition-all duration-150 group relative {{ request()->routeIs('teams.index') ? 'text-text-primary bg-surface-2 border-l-[2px] border-accent' : 'text-text-secondary hover:text-text-primary hover:bg-surface-2 border-l-[2px] border-transparent' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->routeIs('teams.index') ? 'text-text-primary' : 'text-text-secondary group-hover:text-text-primary' }} transition-colors duration-150"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                My Teams
            </a>

            <a href="{{ route('teams.create') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-[6px] text-sm font-medium transition-all duration-150 group relative {{ request()->routeIs('teams.create') ? 'text-text-primary bg-surface-2 border-l-[2px] border-accent' : 'text-text-secondary hover:text-text-primary hover:bg-surface-2 border-l-[2px] border-transparent' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->routeIs('teams.create') ? 'text-text-primary' : 'text-text-secondary group-hover:text-text-primary' }} transition-colors duration-150"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                Create Team
            </a>

            <a href="{{ route('my-invitations.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-[6px] text-sm font-medium transition-all duration-150 group relative {{ request()->routeIs('my-invitations.index') ? 'text-text-primary bg-surface-2 border-l-[2px] border-accent' : 'text-text-secondary hover:text-text-primary hover:bg-surface-2 border-l-[2px] border-transparent' }}">
                <div class="relative">
                    @if(isset($pendingInvitationsCount) && $pendingInvitationsCount > 0)
                        <span class="absolute -top-1 -right-1 flex h-2 w-2">
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-accent border border-surface-1 group-hover:border-surface-2"></span>
                        </span>
                    @endif
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->routeIs('my-invitations.index') ? 'text-text-primary' : 'text-text-secondary group-hover:text-text-primary' }} transition-colors duration-150"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                </div>
                My Invitations
            </a>

            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-[6px] text-sm font-medium transition-all duration-150 group relative {{ request()->routeIs('profile.edit') ? 'text-text-primary bg-surface-2 border-l-[2px] border-accent' : 'text-text-secondary hover:text-text-primary hover:bg-surface-2 border-l-[2px] border-transparent' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->routeIs('profile.edit') ? 'text-text-primary' : 'text-text-secondary group-hover:text-text-primary' }} transition-colors duration-150"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.72v.18a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                Settings
            </a>
        </nav>
    </div>

    <!-- User Profile -->
    <div class="mt-auto p-4 border-t border-border bg-bg/50">
        <a href="{{ route('users.show', auth()->user()) }}" class="block group">
            <div class="flex items-center gap-3 p-2.5 rounded-[6px] hover:bg-surface-2 transition-colors duration-150">
                <div class="w-9 h-9 flex-shrink-0">
                    @if(auth()->user()->avatar_path)
                        <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" 
                             alt="{{ auth()->user()->name }}" 
                             class="w-full h-full rounded-[4px] object-cover border border-border">
                    @else
                        <div class="w-full h-full rounded-[4px] bg-surface-3 flex items-center justify-center text-text-secondary font-medium font-mono border border-border text-xs">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-text-primary truncate group-hover:text-accent transition-colors duration-150">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-text-muted truncate font-mono">{{ auth()->user()->email }}</p>
                </div>
                <div class="flex-shrink-0">
                    <form action="/logout" method="POST" onclick="event.stopPropagation()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-text-muted hover:text-danger transition-colors duration-150 p-1" title="Log Out">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
