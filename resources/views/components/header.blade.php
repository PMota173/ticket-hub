<header class="fixed top-0 w-full z-50 bg-slate-950/80 backdrop-blur-xl border-b border-white/5 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 h-20 flex items-center justify-between">
        <a href="/" class="flex items-center gap-3 group">
            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20 group-hover:scale-105 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
            </div>
            <span class="font-bold text-lg tracking-tight text-white group-hover:text-blue-400 transition-colors">Ticket Hub</span>
        </a>

        <div class="flex items-center gap-4">
            @auth
                <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold px-5 py-2.5 rounded-full transition-all shadow-lg shadow-blue-600/20 hover:scale-105">
                    Open Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-bold text-slate-400 hover:text-white transition-colors">Log in</a>
                <a href="{{ route('register') }}" class="bg-white text-slate-900 hover:bg-slate-200 text-sm font-bold px-5 py-2.5 rounded-full transition-all shadow-lg shadow-white/5 hover:scale-105">
                    Get Started
                </a>
            @endauth
        </div>
    </div>
</header>