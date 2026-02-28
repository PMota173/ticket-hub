<header class="fixed top-0 w-full z-50 bg-bg/90 backdrop-blur-xl border-b border-border transition-all duration-150">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 h-16 flex items-center justify-between">
        <!-- Logo -->
        <a href="/" class="flex items-center gap-3 group transition-colors duration-150">
            <div class="flex items-center justify-center w-4 h-4 bg-text-primary border border-text-primary transition-transform duration-150 group-hover:scale-90"></div>
            <span class="font-mono font-bold tracking-tight text-text-primary group-hover:text-text-secondary transition-colors duration-150 text-lg">tickethub_</span>
        </a>

        <!-- Main Nav -->
        <nav class="hidden md:flex items-center gap-8">
            <a href="/#features" class="text-xs font-mono tracking-widest uppercase {{ request()->is('#features') ? 'text-text-primary' : 'text-text-muted hover:text-text-primary' }} transition-colors duration-150">Features</a>
            <a href="{{ route('portal.index') }}" class="text-xs font-mono tracking-widest uppercase {{ request()->routeIs('portal.*') ? 'text-accent' : 'text-text-muted hover:text-text-primary' }} transition-colors duration-150">Explore</a>
            <a href="{{ route('guides.index') }}" class="text-xs font-mono tracking-widest uppercase {{ request()->routeIs('guides.*') ? 'text-accent' : 'text-text-muted hover:text-text-primary' }} transition-colors duration-150">Docs</a>
            <a href="{{ url('/') }}#pricing" class="text-xs font-mono tracking-widest uppercase {{ request()->is('#pricing') ? 'text-text-primary' : 'text-text-muted hover:text-text-primary' }} transition-colors duration-150">Pricing</a>
        </nav>

        <!-- Actions -->
        <div class="flex items-center gap-6">
            @auth
                <a href="{{ route('dashboard') }}" class="group relative inline-flex items-center justify-center bg-accent text-bg font-mono text-xs font-semibold px-4 py-2 transition-transform hover:-translate-y-0.5 active:translate-y-0">
                    <span class="absolute inset-0 border border-accent"></span>
                    <span class="relative">
                        [ Dashboard ]
                    </span>
                </a>
            @else
                <a href="{{ route('login') }}" class="text-xs font-mono tracking-widest uppercase text-text-muted hover:text-text-primary transition-colors duration-150">Log in</a>
                <a href="{{ route('register') }}" class="group relative inline-flex items-center justify-center bg-text-primary text-bg font-mono text-xs font-semibold px-4 py-2 transition-transform hover:-translate-y-0.5 active:translate-y-0">
                    <span class="absolute inset-0 border border-text-primary"></span>
                    <span class="relative">
                        [ Get Started ]
                    </span>
                </a>
            @endauth
        </div>
    </div>
</header>
