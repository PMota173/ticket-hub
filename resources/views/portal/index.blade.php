<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Explore Workspaces - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
    <style>
        .hero-glow {
            background: radial-gradient(circle at 50% 50%, rgba(59, 130, 246, 0.1), transparent 50%);
        }
    </style>
</head>
<body class="bg-slate-950 text-white flex min-h-screen flex-col font-sans antialiased selection:bg-blue-500">
    <x-header />

    <main class="flex-1 flex flex-col">
        <!-- Hero Section -->
        <section class="relative overflow-hidden border-b border-slate-900 pt-20 pb-24 lg:pt-32 lg:pb-40">
            <div class="absolute inset-0 hero-glow pointer-events-none"></div>
            <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[10px] font-black uppercase tracking-[0.2em] mb-8">
                    Discover Community
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tighter text-white mb-8 leading-none">
                    Explore <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-400">Public Workspaces.</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-400 max-w-2xl mx-auto mb-12 leading-relaxed">
                    Connect with teams, browse open issues, and find the support you need through our transparent community portals.
                </p>

                <!-- Search Bar -->
                <form action="{{ route('portal.index') }}" method="GET" class="max-w-2xl mx-auto relative group">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none text-slate-500 group-focus-within:text-blue-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        </div>
                        <input type="text" name="search" value="{{ $search }}" placeholder="Search by team name or description..." 
                            class="block w-full rounded-2xl border-slate-800 bg-slate-900/50 py-5 pl-16 pr-6 text-white placeholder-slate-600 shadow-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 sm:text-lg transition-all outline-none">
                    </div>
                </form>
            </div>
        </section>

        <!-- Teams Grid -->
        <section class="max-w-7xl mx-auto px-6 py-20 w-full">
            <div class="flex items-center justify-between mb-12">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                    <h2 class="text-xl font-bold text-white tracking-tight uppercase tracking-widest text-xs">Active Communities</h2>
                </div>
                <span class="text-xs font-black text-slate-500 uppercase tracking-widest bg-slate-900 px-3 py-1.5 rounded-full border border-slate-800">
                    {{ $teams->total() }} results
                </span>
            </div>

            @if($teams->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($teams as $team)
                        <a href="{{ route('portal.show', $team) }}" class="group relative flex flex-col bg-slate-900/50 border border-slate-800 rounded-3xl p-8 hover:bg-slate-900 hover:border-blue-500/40 transition-all duration-500 shadow-xl hover:shadow-blue-500/5">
                            <div class="flex items-start justify-between mb-8">
                                @if($team->logo)
                                    <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="w-16 h-16 rounded-2xl object-cover border border-slate-800 shadow-lg group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white font-black text-2xl shadow-lg group-hover:scale-110 transition-transform duration-500">
                                        {{ substr($team->name, 0, 1) }}
                                    </div>
                                @endif
                                
                                <div class="flex items-center gap-1.5 text-[10px] font-black text-slate-400 bg-slate-950 px-3 py-1.5 rounded-full border border-slate-800 uppercase tracking-widest">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-blue-500"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                                    {{ $team->tickets_count ?? 0 }} Tickets
                                </div>
                            </div>
                            
                            <h3 class="text-2xl font-bold text-white group-hover:text-blue-400 transition-colors mb-3 tracking-tight">{{ $team->name }}</h3>
                            <p class="text-slate-400 text-sm leading-relaxed mb-10 flex-grow opacity-80 group-hover:opacity-100 transition-opacity line-clamp-3">{{ $team->description ?? 'No description provided.' }}</p>
                            
                            <div class="pt-6 border-t border-slate-800/50 flex items-center justify-between">
                                <div class="flex items-center gap-2 text-slate-500 font-bold text-[10px] uppercase tracking-widest">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                    {{ $team->members_count ?? 0 }} Contributors
                                </div>
                                <div class="text-blue-400 font-black text-[10px] uppercase tracking-[0.2em] group-hover:translate-x-1 transition-transform inline-flex items-center gap-2">
                                    Launch Portal 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                
                <div class="mt-16">
                    {{ $teams->links() }}
                </div>
            @else
                <div class="text-center py-32 bg-slate-900/30 rounded-[3rem] border border-slate-800 border-dashed">
                    <div class="w-20 h-20 bg-slate-800/50 rounded-2xl flex items-center justify-center mx-auto mb-8 border border-slate-700 shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-x text-slate-600"><path d="m13.5 8.5-5 5"/><path d="m8.5 8.5 5 5"/><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3 tracking-tight">No workspaces match your search</h3>
                    <p class="text-slate-500 text-lg mb-10 max-w-md mx-auto">We couldn't find any public teams matching "{{ $search }}". Try refining your keywords.</p>
                    <a href="{{ route('portal.index') }}" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-[0.2em] text-blue-500 hover:text-blue-400 transition-colors">
                        Clear Search Parameters <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </a>
                </div>
            @endif
        </section>
        
        <x-footer />
    </main>
</body>
</html>