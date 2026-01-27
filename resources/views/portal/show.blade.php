<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $team->name }} - Portal</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>
<body class="bg-slate-900 text-white flex min-h-screen flex-col font-sans antialiased">
    <x-header />

    <!-- Team Header Banner -->
    <div class="h-48 md:h-64 bg-slate-800 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/50 to-purple-900/50"></div>
        
        <!-- Back Link Positioned on Banner -->
        <div class="absolute top-6 left-6 z-20">
            <a href="{{ route('portal.index') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-900/50 hover:bg-slate-900 text-white text-sm font-medium backdrop-blur-sm transition-all border border-white/10 hover:border-white/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Back to Explore
            </a>
        </div>
    </div>

    <main class="flex-1 max-w-7xl mx-auto w-full px-6 lg:px-8 -mt-20 relative z-10 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left Sidebar: Team Info -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-xl">
                    <div class="flex flex-col items-center text-center -mt-12 mb-6">
                        @if($team->logo)
                            <img src="{{ $team->logo }}" alt="{{ $team->name }}" class="w-24 h-24 rounded-2xl object-cover border-4 border-slate-800 shadow-lg mb-4">
                        @else
                            <div class="w-24 h-24 rounded-2xl bg-blue-600 flex items-center justify-center text-3xl font-bold border-4 border-slate-800 shadow-lg mb-4">
                                {{ substr($team->name, 0, 1) }}
                            </div>
                        @endif
                        <h1 class="text-3xl font-bold text-white mb-2">{{ $team->name }}</h1>
                        <p class="text-slate-400 text-sm mb-4">{{ $team->slug }}</p>
                        
                        <!-- CTA Button -->
                        @auth
                            <button onclick="document.getElementById('create-ticket-modal').showModal()" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-medium py-2.5 px-4 rounded-xl transition-colors shadow-lg shadow-blue-900/20 flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                New Ticket
                            </button>
                        @else
                            <a href="{{ route('login') }}?redirect={{ url()->current() }}" class="w-full bg-slate-700 hover:bg-slate-600 text-white font-medium py-2.5 px-4 rounded-xl transition-colors flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-in"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>
                                Login to Submit
                            </a>
                        @endauth
                    </div>

                    <div class="space-y-4 pt-6 border-t border-slate-700/50">
                        <div>
                            <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">About</h3>
                            <p class="text-slate-300 text-sm leading-relaxed">
                                {{ $team->description ?? 'This team has not provided a description yet.' }}
                            </p>
                        </div>
                        
                        <div>
                            <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Stats</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-slate-900/50 rounded-lg p-3 border border-slate-700/50">
                                    <div class="text-2xl font-bold text-white">{{ $team->tickets()->count() }}</div>
                                    <div class="text-xs text-slate-500">Tickets</div>
                                </div>
                                <div class="bg-slate-900/50 rounded-lg p-3 border border-slate-700/50">
                                    <div class="text-2xl font-bold text-white">{{ $team->users()->count() }}</div>
                                    <div class="text-xs text-slate-500">Members</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Content: Ticket Feed -->
            <div class="lg:col-span-8">
                <!-- Success Message -->
                @if (session('status'))
                    <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 p-4 rounded-xl flex items-center gap-3 animate-fade-in-down">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        {{ session('status') }}
                    </div>
                @endif

                <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-xl">
                    <div class="px-6 py-4 border-b border-slate-700 bg-slate-800/50">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <h2 class="text-lg font-semibold text-white">Public Tickets</h2>
                            
                            <form action="{{ route('portal.show', $team) }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-500"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                    </div>
                                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search tickets..." 
                                        class="bg-slate-900 border-none rounded-lg text-sm focus:ring-1 focus:ring-blue-500 py-2 pl-9 pr-4 text-white w-full sm:w-64 placeholder-slate-500 transition-all">
                                </div>

                                <div class="flex items-center gap-2">
                                    <span class="text-sm text-slate-400 whitespace-nowrap">Sort by:</span>
                                    <select name="sort" onchange="this.form.submit()" class="bg-slate-900 border-none rounded-lg text-sm focus:ring-1 focus:ring-blue-500 py-2 pl-3 pr-8 text-slate-300 cursor-pointer">
                                        <option value="newest" {{ ($currentSort ?? 'newest') === 'newest' ? 'selected' : '' }}>Newest</option>
                                        <option value="oldest" {{ ($currentSort ?? 'newest') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                                        <option value="status" {{ ($currentSort ?? 'newest') === 'status' ? 'selected' : '' }}>Status</option>
                                        <option value="priority" {{ ($currentSort ?? 'newest') === 'priority' ? 'selected' : '' }}>Priority</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="divide-y divide-slate-700/50">
                        @forelse($tickets as $ticket)
                            <a href="{{ route('portal.tickets.show', [$team, $ticket]) }}" class="block p-6 hover:bg-slate-750 transition-colors group">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-1">
                                            <x-ticket-status-badge :status="$ticket->status" />
                                            <span class="text-slate-500 text-xs">•</span>
                                            <span class="text-slate-400 text-xs">#{{ $ticket->id }}</span>
                                            <span class="text-slate-500 text-xs">•</span>
                                            <span class="text-slate-400 text-xs">{{ $ticket->created_at->diffForHumans() }} by {{ $ticket->author->name ?? 'Unknown' }}</span>
                                        </div>
                                        <h3 class="text-lg font-medium text-white group-hover:text-blue-400 transition-colors truncate">
                                            {{ $ticket->title }}
                                        </h3>
                                        <p class="mt-1 text-sm text-slate-400 line-clamp-2">{{ $ticket->description }}</p>
                                        
                                        @if($ticket->tags->isNotEmpty())
                                            <div class="mt-3 flex flex-wrap gap-2">
                                                @foreach($ticket->tags as $tag)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-700 text-slate-300">
                                                        {{ $tag->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Priority Indicator -->
                                    <div class="flex-shrink-0" title="Priority: {{ $ticket->priority->value }}">
                                        @if($ticket->priority->value === 'high' || $ticket->priority->value === 'urgent')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-up text-red-500"><path d="M8 7L12 3L16 7"/><path d="M12 3V21"/></svg>
                                        @elseif($ticket->priority->value === 'medium')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus text-orange-400"><path d="M5 12h14"/></svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-down text-green-500"><path d="M8 17L12 21L16 17"/><path d="M12 3V21"/></svg>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="p-12 text-center">
                                <div class="w-16 h-16 bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-inbox text-slate-500"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
                                </div>
                                <h3 class="text-white font-medium mb-1">No tickets yet</h3>
                                <p class="text-slate-500 text-sm">Be the first to submit a request to this team.</p>
                            </div>
                        @endforelse
                    </div>

                    @if($tickets->hasPages())
                        <div class="px-6 py-4 border-t border-slate-700 bg-slate-800/50">
                            {{ $tickets->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- Create Ticket Modal -->
    @auth
    <dialog id="create-ticket-modal" class="hidden open:flex bg-transparent backdrop:bg-slate-900/80 p-0 w-full h-full fixed inset-0 z-50 items-center justify-center open:animate-fade-in">
        <div class="bg-slate-800 border border-slate-700 rounded-2xl shadow-2xl overflow-hidden w-full max-w-2xl max-h-[90vh] flex flex-col relative mx-4">
            <div class="px-6 py-4 border-b border-slate-700 flex items-center justify-between bg-slate-750">
                <h3 class="text-lg font-bold text-white">Create New Ticket</h3>
                <form method="dialog">
                    <button class="text-slate-400 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </form>
            </div>
            
            <form action="{{ route('portal.tickets.store', $team) }}" method="POST" class="p-6 space-y-6 overflow-y-auto">
                @csrf
                
                <div class="space-y-4">
                    <div class="space-y-2">
                        <label for="title" class="block text-sm font-medium text-slate-300">Issue Title</label>
                        <input type="text" name="title" id="title" required placeholder="What's the issue?" 
                            class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all outline-none">
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="block text-sm font-medium text-slate-300">Description</label>
                        <textarea name="description" id="description" rows="5" required placeholder="Please provide as much detail as possible..." 
                            class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all outline-none resize-none"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="priority" class="block text-sm font-medium text-slate-300">Priority</label>
                            <select name="priority" id="priority" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none appearance-none">
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="pt-2 flex justify-end gap-3">
                    <form method="dialog">
                        <button class="px-4 py-2 rounded-lg border border-slate-600 text-slate-300 hover:bg-slate-700 hover:text-white transition-colors font-medium">Cancel</button>
                    </form>
                    <button type="submit" class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-500 transition-colors font-medium shadow-lg shadow-blue-900/20">Submit Ticket</button>
                </div>
            </form>
        </div>
    </dialog>
    @endauth

    <x-footer class="mt-auto" />
</body>
</html>
