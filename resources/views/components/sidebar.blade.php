<aside class="w-72 bg-slate-900/50 border-r border-slate-800 flex flex-col min-h-screen sticky top-0 h-screen">
    <!-- Header -->
    <div class="p-6">
        <div class="flex items-center gap-3 mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="lucide lucide-ticket w-8 h-8 text-blue-500">
                <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path>
                <path d="M13 5v2"></path>
                <path d="M13 17v2"></path>
                <path d="M13 11v2"></path>
            </svg>
            <h1 class="text-2xl font-bold tracking-tight text-white">Ticket Hub</h1>
        </div>
        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider pl-11">Support System</p>
    </div>

    <!-- Divider -->
    <div class="h-px bg-slate-800 mx-6 mb-6"></div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 space-y-2">
        <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg group transition-all {{ request()->routeIs('dashboard') ? 'text-white bg-blue-600/10 text-blue-400' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="lucide lucide-layout-dashboard w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300' }}">
                <rect width="7" height="9" x="3" y="3" rx="1"></rect>
                <rect width="7" height="5" x="14" y="3" rx="1"></rect>
                <rect width="7" height="9" x="14" y="12" rx="1"></rect>
                <rect width="7" height="5" x="3" y="16" rx="1"></rect>
            </svg>
            Dashboard
        </a>

        <a href="/tickets"
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg group transition-all {{ request()->is('tickets') ? 'text-white bg-blue-600/10 text-blue-400' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="lucide lucide-kanban w-5 h-5 {{ request()->is('tickets') ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors">
                <path d="M6 5v11"></path>
                <path d="M12 5v6"></path>
                <path d="M18 5v14"></path>
            </svg>
            Ticket Board
        </a>

        <a href="/tickets/create"
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg group transition-all {{ request()->is('tickets/create') ? 'text-white bg-blue-600/10 text-blue-400' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="lucide lucide-plus w-5 h-5 {{ request()->is('tickets/create') ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors">
                <path d="M5 12h14"></path>
                <path d="M12 5v14"></path>
            </svg>
            Create Ticket
        </a>

        <a href="#"
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg text-slate-400 hover:text-white hover:bg-slate-800/50 transition-all group">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="lucide lucide-settings w-5 h-5 text-slate-500 group-hover:text-slate-300 transition-colors">
                <path
                    d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            </svg>
            Settings
        </a>
    </nav>

        <!-- Bottom Section -->
    <div class="p-4 border-t border-slate-800">
        <div class="flex items-center gap-3 px-2 py-2 mb-2">
            <div
                class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center shrink-0 border border-slate-600">
                <span class="text-sm font-medium text-white">{{ Auth::user()->name }}</span>
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}<p>
                <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <form method="POST" action="/logout">
            @csrf
            @method('DELETE')
            <button class="w-full flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-400 hover:text-red-400 hover:bg-red-400/10 rounded-lg transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out w-4 h-4 text-slate-500 group-hover:text-red-400 transition-colors">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" x2="9" y1="12" y2="12"></line>
                </svg>
                Sign Out
            </button>
        </form>
    </div>
</aside>
