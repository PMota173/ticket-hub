<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Explore Teams - {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>
<body class="bg-slate-900 text-white flex min-h-screen flex-col font-sans antialiased">
    <x-header />

    <main class="flex-1 flex flex-col">
        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-slate-800 border-b border-slate-700">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-purple-500/10 opacity-50"></div>
            <div class="max-w-7xl mx-auto px-6 py-20 lg:py-24 relative z-10 text-center">
                <h1 class="text-4xl md:text-5xl font-bold tracking-tight mb-6">
                    Find the help you need
                </h1>
                <p class="text-lg md:text-xl text-slate-400 max-w-2xl mx-auto mb-10">
                    Browse public teams, explore open tickets, and join the conversation. Support made transparent.
                </p>

                <!-- Search Bar -->
                <form action="{{ route('portal.index') }}" method="GET" class="max-w-xl mx-auto relative">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search text-slate-500"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        </div>
                        <input type="text" name="search" value="{{ $search }}" placeholder="Search for teams (e.g., Engineering, Support)..." 
                            class="block w-full rounded-full border-slate-600 bg-slate-900/50 py-4 pl-12 pr-4 text-white placeholder-slate-500 shadow-xl focus:border-blue-500 focus:ring-blue-500 sm:text-lg transition-all">
                    </div>
                </form>
            </div>
        </div>

        <!-- Teams Grid -->
        <div class="max-w-7xl mx-auto px-6 py-12 w-full">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-semibold text-white">Popular Teams</h2>
                <span class="text-sm text-slate-400">Showing {{ $teams->count() }} teams</span>
            </div>

            @if($teams->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($teams as $team)
                        <a href="{{ route('portal.show', $team) }}" class="group relative flex flex-col bg-slate-800 border border-slate-700 rounded-2xl p-6 hover:bg-slate-750 hover:border-blue-500/50 transition-all duration-300 shadow-lg hover:shadow-blue-500/10">
                            <div class="flex items-start justify-between mb-4">
                                @if($team->logo)
                                    <img src="{{ $team->logo }}" alt="{{ $team->name }}" class="w-12 h-12 rounded-xl object-cover border border-slate-600">
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-lg font-bold border border-white/10 shadow-inner">
                                        {{ substr($team->name, 0, 1) }}
                                    </div>
                                @endif
                                
                                <div class="flex items-center gap-1.5 text-xs font-medium text-slate-400 bg-slate-900/50 px-2.5 py-1 rounded-full border border-slate-700/50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ticket"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                                    {{ $team->tickets_count ?? 0 }} Tickets
                                </div>
                            </div>
                            
                            <h3 class="text-xl font-bold text-white group-hover:text-blue-400 transition-colors mb-2">{{ $team->name }}</h3>
                            <p class="text-slate-400 text-sm line-clamp-2 mb-6 flex-grow">{{ $team->description ?? 'No description provided.' }}</p>
                            
                            <div class="pt-4 border-t border-slate-700/50 flex items-center justify-between text-sm">
                                <span class="text-slate-500 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                    {{ $team->members_count ?? 0 }} Members
                                </span>
                                <span class="text-blue-400 font-medium group-hover:translate-x-1 transition-transform inline-flex items-center">
                                    View Portal 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-1"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
                
                <div class="mt-10">
                    {{ $teams->links() }}
                </div>
            @else
                <div class="text-center py-20 bg-slate-800/50 rounded-3xl border border-slate-700/50 border-dashed">
                    <div class="w-16 h-16 bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-x text-slate-400"><path d="m13.5 8.5-5 5"/><path d="m8.5 8.5 5 5"/><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                    <h3 class="text-xl font-medium text-white mb-2">No teams found</h3>
                    <p class="text-slate-400">We couldn't find any public teams matching "{{ $search }}".</p>
                    <a href="{{ route('portal.index') }}" class="inline-block mt-4 text-blue-400 hover:text-blue-300 font-medium">Clear search</a>
                </div>
            @endif
        </div>
        
        <x-footer class="mt-auto" />
    </main>
</body>
</html>
