<header class="sticky top-0 z-50 w-full bg-slate-950/10 backdrop-blur-md border-b border-white/5">
    <div class="max-w-7xl mx-auto flex items-center justify-between py-3 px-6 lg:px-8">
        <div class="flex items-center gap-2.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="lucide lucide-ticket w-7 h-7 text-blue-500">
                <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path>
                <path d="M13 5v2"></path>
                <path d="M13 17v2"></path>
                <path d="M13 11v2"></path>
            </svg>
            <span class="text-lg font-bold text-white tracking-tight">Ticket Hub</span>
        </div>

        @guest
            <div class="flex items-center gap-3">
                <x-gray-button href="/login" class="!px-4 !py-1.5 !text-xs border-white/10 hover:bg-white/5 transition-all">
                    Sign in
                </x-gray-button>
                <x-blue-button href="/register" class="!px-4 !py-1.5 !text-xs shadow-lg shadow-blue-600/20">
                    Get Started
                </x-blue-button>
            </div>
        @endguest
        @auth
            <x-blue-button href="/dashboard" class="!px-4 !py-1.5 !text-xs shadow-lg shadow-blue-600/20">
                Open Dashboard
            </x-blue-button>
        @endauth
    </div>
</header>
