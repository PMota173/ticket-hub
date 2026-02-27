<header class="fixed top-0 w-full z-50 bg-bg/80 backdrop-blur-xl border-b border-border transition-all duration-150">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 h-16 flex items-center justify-between">
        <!-- Logo -->
        <a href="/" class="flex items-center gap-3 group transition-colors duration-150">
            <div class="w-8 h-8 bg-accent rounded-[6px] flex items-center justify-center transition-transform duration-150 group-hover:-translate-y-[1px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
            </div>
            <span class="font-display font-medium text-text-primary group-hover:text-accent transition-colors duration-150">Ticket Hub</span>
        </a>

        <!-- Main Nav -->
        <nav class="hidden md:flex items-center gap-8">
            <a href="/#features" class="text-[11px] font-mono tracking-[0.08em] uppercase {{ request()->is('#features') ? 'text-text-primary' : 'text-text-muted hover:text-text-primary' }} transition-colors duration-150">Features</a>
            <a href="{{ route('portal.index') }}" class="text-[11px] font-mono tracking-[0.08em] uppercase {{ request()->routeIs('portal.*') ? 'text-accent' : 'text-text-muted hover:text-text-primary' }} transition-colors duration-150">Explore</a>
            <a href="{{ route('guides.index') }}" class="text-[11px] font-mono tracking-[0.08em] uppercase {{ request()->routeIs('guides.*') ? 'text-accent' : 'text-text-muted hover:text-text-primary' }} transition-colors duration-150">Docs</a>
            <a href="{{ url('/') }}#pricing" class="text-[11px] font-mono tracking-[0.08em] uppercase {{ request()->is('#pricing') ? 'text-text-primary' : 'text-text-muted hover:text-text-primary' }} transition-colors duration-150">Pricing</a>
        </nav>

        <!-- Actions -->
        <div class="flex items-center gap-4">
            @auth
                <a href="{{ route('dashboard') }}" class="bg-accent hover:bg-accent-hover text-white text-[11px] font-mono tracking-[0.08em] uppercase px-5 py-2 rounded-[6px] transition-all duration-150 hover:shadow-[0_0_12px_var(--color-accent-glow)]">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="text-[11px] font-mono tracking-[0.08em] uppercase text-text-muted hover:text-text-primary transition-colors duration-150">Log in</a>
                <a href="{{ route('register') }}" class="bg-text-primary text-bg hover:bg-text-primary/90 text-[11px] font-mono tracking-[0.08em] uppercase px-5 py-2 rounded-[6px] transition-colors duration-150">
                    Get Started
                </a>
            @endauth
        </div>
    </div>
</header>
