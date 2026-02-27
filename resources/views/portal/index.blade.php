<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Explore Workspaces - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500|inter:400,500|jetbrains-mono:400,500,600&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
    <style>
        .grid-bg {
            background-image: linear-gradient(to right, var(--color-border) 1px, transparent 1px),
                              linear-gradient(to bottom, var(--color-border) 1px, transparent 1px);
            background-size: 40px 40px;
            background-position: center top;
            mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 80%);
            -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0) 80%);
        }
    </style>
</head>
<body class="bg-bg text-text-primary flex min-h-screen flex-col font-sans antialiased selection:bg-accent selection:text-white relative">
    
    <div class="absolute inset-0 grid-bg pointer-events-none z-0"></div>

    <div class="relative z-10 flex flex-col min-h-screen">
        <x-header />

        <main class="flex-1 flex flex-col">
            <!-- Hero Section -->
            <section class="relative overflow-hidden border-b border-border pt-20 pb-24 lg:pt-32 lg:pb-32 bg-bg/50 backdrop-blur-sm">
                <div class="max-w-4xl mx-auto px-6 relative text-center opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-[4px] bg-accent/10 border border-accent/20 text-accent text-[11px] font-mono uppercase tracking-[0.08em] mb-6">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Directory
                    </div>
                    <h1 class="text-4xl md:text-5xl font-display font-medium tracking-tight text-text-primary mb-6">
                        Explore <span class="text-accent">Public Workspaces.</span>
                    </h1>
                    <p class="text-text-secondary mb-10 max-w-2xl mx-auto text-sm leading-relaxed">
                        Connect with teams, browse open issues, and find the support you need through our transparent community portals.
                    </p>

                    <!-- Search Bar -->
                    <form action="{{ route('portal.index') }}" method="GET" class="max-w-xl mx-auto relative group">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-text-muted group-focus-within:text-accent transition-colors duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            </div>
                            <input type="text" name="search" value="{{ $search }}" placeholder="Search by team name or description..." 
                                class="block w-full rounded-[6px] border border-border bg-surface-2 py-3 pl-12 pr-4 text-text-primary text-[13px] placeholder-text-muted focus:border-accent focus:ring-0 focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all duration-150 outline-none">
                        </div>
                    </form>
                </div>
            </section>

            <!-- Teams Grid -->
            <section class="max-w-7xl mx-auto px-6 py-20 w-full opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-text-secondary"></div>
                        <h2 class="text-[11px] font-mono font-medium text-text-muted uppercase tracking-[0.08em]">Active Communities</h2>
                    </div>
                    <span class="text-[11px] font-mono text-text-secondary uppercase tracking-[0.08em] bg-surface-2 px-2 py-1 rounded-[4px] border border-border">
                        {{ $teams->total() }} results
                    </span>
                </div>

                @if($teams->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($teams as $team)
                            <a href="{{ route('portal.show', $team) }}" class="group relative flex flex-col bg-surface-1 border border-border rounded-[8px] p-6 hover:bg-surface-2 hover:border-border-light transition-all duration-150 hover:-translate-y-[1px]">
                                <div class="flex items-start justify-between mb-6">
                                    @if($team->logo)
                                        <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="w-12 h-12 rounded-[6px] object-cover border border-border">
                                    @else
                                        <div class="w-12 h-12 rounded-[6px] bg-surface-3 flex items-center justify-center text-text-primary font-mono text-lg border border-border">
                                            {{ substr($team->name, 0, 1) }}
                                        </div>
                                    @endif
                                    
                                    <div class="flex items-center gap-1.5 text-[10px] font-mono text-text-secondary bg-bg px-2 py-1 rounded-[4px] border border-border uppercase tracking-[0.08em]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                                        {{ $team->tickets_count ?? 0 }} Tickets
                                    </div>
                                </div>
                                
                                <h3 class="text-lg font-medium text-text-primary group-hover:text-accent transition-colors duration-150 mb-2 truncate">{{ $team->name }}</h3>
                                <p class="text-text-secondary text-[13px] leading-relaxed mb-6 flex-grow line-clamp-2">{{ $team->description ?? 'No description provided.' }}</p>
                                
                                <div class="pt-4 border-t border-border flex items-center justify-between">
                                    <div class="flex items-center gap-1.5 text-text-muted font-mono text-[10px] uppercase tracking-[0.08em]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                        {{ $team->members_count ?? 0 }} Contributors
                                    </div>
                                    <div class="text-accent font-mono text-[10px] uppercase tracking-[0.08em] group-hover:translate-x-1 transition-transform duration-150 inline-flex items-center gap-1.5">
                                        Launch 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    
                    <div class="mt-12">
                        {{ $teams->links() }}
                    </div>
                @else
                    <div class="text-center py-24 bg-surface-1 rounded-[8px] border border-border border-dashed">
                        <div class="w-12 h-12 bg-surface-2 rounded-[6px] flex items-center justify-center mx-auto mb-6 border border-border">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary"><path d="m13.5 8.5-5 5"/><path d="m8.5 8.5 5 5"/><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        </div>
                        <h3 class="text-lg font-medium text-text-primary mb-2">No workspaces found</h3>
                        <p class="text-text-secondary text-[13px] mb-6 max-w-md mx-auto">We couldn't find any public teams matching "{{ $search }}". Try refining your search.</p>
                        <a href="{{ route('portal.index') }}" class="inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.08em] text-accent hover:text-accent-hover transition-colors">
                            Clear Search <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                        </a>
                    </div>
                @endif
            </section>
            
            <x-footer />
        </main>
    </div>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>