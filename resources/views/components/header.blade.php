<header class="fixed top-0 w-full z-50 bg-slate-950/60 backdrop-blur-xl border-b border-white/5 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 h-20 flex items-center justify-between">
        <!-- Logo -->
        <a href="/" class="flex items-center gap-3 group">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/20 group-hover:scale-105 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
            </div>
            <span class="font-bold text-lg tracking-tight text-white group-hover:text-blue-400 transition-colors">Ticket Hub</span>
        </a>

        <!-- Main Nav -->
        <nav class="hidden md:flex items-center gap-10">
            <a href="/#features" class="text-[10px] font-black uppercase tracking-[0.2em] {{ request()->is('#features') ? 'text-white' : 'text-slate-500 hover:text-white' }} transition-colors">Features</a>
            <a href="{{ route('portal.index') }}" class="text-[10px] font-black uppercase tracking-[0.2em] {{ request()->routeIs('portal.*') ? 'text-blue-400' : 'text-slate-500 hover:text-white' }} transition-colors">Explore</a>
            <a href="{{ url('/') }}#pricing" class="text-[10px] font-black uppercase tracking-[0.2em] {{ request()->is('#pricing') ? 'text-white' : 'text-slate-500 hover:text-white' }} transition-colors">Pricing</a>
        </nav>

        <!-- Actions -->
        <div class="flex items-center gap-6">
            @auth
                <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black uppercase tracking-[0.2em] px-6 py-3 rounded-full transition-all shadow-lg shadow-blue-600/20 hover:scale-105 active:scale-95">
                    Open Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 hover:text-white transition-colors">Log in</a>
                <a href="{{ route('register') }}" class="bg-white text-slate-950 hover:bg-slate-200 text-[10px] font-black uppercase tracking-[0.2em] px-6 py-3 rounded-full transition-all shadow-lg shadow-white/10 hover:scale-105 active:scale-95">
                    Get Started
                </a>
            @endauth
        </div>
    </div>
</header>