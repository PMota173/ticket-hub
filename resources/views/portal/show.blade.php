<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $team->name }} - Portal</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>
<body class="bg-slate-950 text-white flex min-h-screen flex-col font-sans antialiased selection:bg-blue-500">
    <x-header />

    <!-- Team Header Banner -->
    <div class="h-64 bg-slate-900 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/40 to-purple-900/40 backdrop-blur-3xl"></div>
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>

        <!-- Back Link -->
        <div class="absolute top-8 left-8 z-20">
            <a href="{{ route('portal.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-950/50 hover:bg-slate-950 text-white text-[10px] font-black uppercase tracking-[0.2em] backdrop-blur-md transition-all border border-white/5 hover:border-white/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Explore Workspaces
            </a>
        </div>
    </div>

    <main class="flex-1 max-w-7xl mx-auto w-full px-6 lg:px-8 -mt-24 relative z-10 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            <!-- Left Sidebar: Team Info -->
            <div class="lg:col-span-4 space-y-8">
                <div class="bg-slate-900 border border-slate-800 rounded-[2.5rem] p-8 shadow-2xl relative overflow-hidden">
                    <div class="flex flex-col items-center text-center mb-8">
                        @if($team->logo)
                            <div class="w-24 h-24 rounded-2xl bg-slate-900 border-2 border-slate-800 shadow-xl mb-6 overflow-hidden flex items-center justify-center">
                                <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-4xl font-black text-white border-2 border-slate-800 shadow-xl mb-6">
                                {{ substr($team->name, 0, 1) }}
                            </div>
                        @endif
                        <h1 class="text-3xl font-black text-white mb-2 tracking-tighter">{{ $team->name }}</h1>
                        <div class="inline-flex items-center px-2 py-0.5 rounded-full bg-slate-950 border border-slate-800 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-6">
                            Verified Hub
                        </div>

                        <!-- CTA Button -->
                        @auth
                            <button onclick="document.getElementById('create-ticket-modal').showModal()" class="w-full bg-blue-600 hover:bg-blue-500 text-white text-xs font-black uppercase tracking-[0.2em] py-4 rounded-2xl transition-all shadow-xl shadow-blue-900/20 flex items-center justify-center gap-2 group hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:rotate-90"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                New Submission
                            </button>
                        @else
                            <a href="{{ route('login') }}?redirect={{ url()->current() }}" class="w-full bg-slate-800 hover:bg-slate-700 text-white text-xs font-black uppercase tracking-[0.2em] py-4 rounded-2xl transition-all flex items-center justify-center gap-2 group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-slate-500 group-hover:text-white"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>
                                Access to Submit
                            </a>
                        @endauth
                    </div>

                    <div class="space-y-8 pt-8 border-t border-slate-800/50">
                        <div>
                            <h3 class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] mb-4">Workspace Bio</h3>
                            <p class="text-slate-400 text-sm leading-relaxed font-medium">
                                {{ $team->description ?? 'No description provided.' }}
                            </p>
                        </div>

                        <div>
                            <h3 class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] mb-4">Hub Statistics</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-slate-950 rounded-2xl p-4 border border-slate-800 shadow-inner">
                                    <div class="text-2xl font-black text-white tracking-tighter">{{ $team->tickets()->count() }}</div>
                                    <div class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">Reports</div>
                                </div>
                                <div class="bg-slate-950 rounded-2xl p-4 border border-slate-800 shadow-inner">
                                    <div class="text-2xl font-black text-white tracking-tighter">{{ $team->users()->count() }}</div>
                                    <div class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">Agents</div>
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
                    <div class="mb-8 bg-green-500/10 border border-green-500/20 text-green-400 p-5 rounded-3xl flex items-center gap-4 animate-fade-in-down">
                        <div class="w-8 h-8 rounded-full bg-green-500/20 flex items-center justify-center flex-shrink-0 border border-green-500/20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                        <span class="font-bold text-sm">{{ session('status') }}</span>
                    </div>
                @endif

                <div class="bg-slate-900 border border-slate-800 rounded-[2.5rem] overflow-hidden shadow-2xl">
                    <div class="px-8 py-6 border-b border-slate-800 bg-slate-900/80">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                            <h2 class="text-xl font-black text-white tracking-tight uppercase tracking-widest text-xs">Community Reports</h2>

                            <form action="{{ route('portal.show', $team) }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-600 group-focus-within:text-blue-500 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                    </div>
                                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search ID or Title..."
                                        class="bg-slate-950 border border-slate-800 rounded-xl text-xs font-bold py-2.5 pl-10 pr-4 text-white w-full sm:w-48 placeholder-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all outline-none">
                                </div>

                                <div class="flex items-center gap-3">
                                    <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest whitespace-nowrap">Sort</span>
                                    <select name="sort" onchange="this.form.submit()" class="bg-slate-950 border border-slate-800 rounded-xl text-[10px] font-black uppercase tracking-widest focus:border-blue-500 py-2.5 pl-3 pr-8 text-slate-400 cursor-pointer outline-none transition-all">
                                        <option value="newest" {{ ($currentSort ?? 'newest') === 'newest' ? 'selected' : '' }}>Newest</option>
                                        <option value="oldest" {{ ($currentSort ?? 'newest') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                                        <option value="status" {{ ($currentSort ?? 'newest') === 'status' ? 'selected' : '' }}>Status</option>
                                        <option value="priority" {{ ($currentSort ?? 'newest') === 'priority' ? 'selected' : '' }}>Priority</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="divide-y divide-slate-800/50">
                        @forelse($tickets as $ticket)
                            <a href="{{ route('portal.tickets.show', [$team, $ticket]) }}" class="block p-8 hover:bg-slate-850 transition-all duration-300 group">
                                <div class="flex items-start justify-between gap-6">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-3 mb-3">
                                            <x-ticket-status-badge :status="$ticket->status" />
                                            <span class="text-[10px] font-black text-slate-700 font-mono tracking-widest">#{{ $ticket->id }}</span>
                                            <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">{{ $ticket->created_at->diffForHumans() }}</span>
                                        </div>
                                        <h3 class="text-xl font-bold text-white group-hover:text-blue-400 transition-colors truncate mb-2 tracking-tight">
                                            {{ $ticket->title }}
                                        </h3>
                                        <p class="text-sm text-slate-500 line-clamp-2 leading-relaxed font-medium">{{ $ticket->description }}</p>

                                        @if($ticket->tags->isNotEmpty())
                                            <div class="mt-4 flex flex-wrap gap-2">
                                                @foreach($ticket->tags as $tag)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[9px] font-black uppercase tracking-widest bg-slate-950 text-slate-500 border border-slate-800">
                                                        {{ $tag->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Priority Indicator -->
                                    <div class="flex-shrink-0 pt-1">
                                        @if($ticket->priority->value === 'high' || $ticket->priority->value === 'urgent')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-red-500 shadow-glow-red"><path d="M8 7L12 3L16 7"/><path d="M12 3V21"/></svg>
                                        @elseif($ticket->priority->value === 'medium')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-orange-500"><path d="M5 12h14"/></svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-green-500"><path d="M8 17L12 21L16 17"/><path d="M12 3V21"/></svg>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="p-20 text-center">
                                <div class="w-20 h-20 bg-slate-950 rounded-[2rem] flex items-center justify-center mx-auto mb-6 border border-slate-800 shadow-inner">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-inbox text-slate-700"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2 tracking-tight">No activity detected</h3>
                                <p class="text-slate-600 font-medium">This feed is currently silent. Be the first to initiate a report.</p>
                            </div>
                        @endforelse
                    </div>

                    @if($tickets->hasPages())
                        <div class="px-8 py-6 border-t border-slate-800 bg-slate-900/80">
                            {{ $tickets->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- Create Ticket Modal -->
    @auth
    <dialog id="create-ticket-modal" class="hidden open:flex bg-transparent backdrop:bg-slate-950/90 p-0 w-full h-full fixed inset-0 z-50 items-center justify-center open:animate-fade-in">
        <div class="bg-slate-900 border border-slate-800 rounded-[3rem] shadow-2xl overflow-hidden w-full max-w-2xl max-h-[90vh] flex flex-col relative mx-4">
            <div class="px-10 py-6 border-b border-slate-800 flex items-center justify-between bg-slate-900/80">
                <h3 class="text-xs font-black text-white uppercase tracking-[0.3em]">Initiate Submission</h3>
                <form method="dialog">
                    <button class="text-slate-600 hover:text-white transition-colors p-2 rounded-full hover:bg-slate-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </form>
            </div>

            <form action="{{ route('portal.tickets.store', $team) }}" method="POST" class="p-10 space-y-10 overflow-y-auto">
                @csrf

                <div class="space-y-8">
                    <div class="space-y-2">
                        <label for="title" class="text-[10px] font-black text-slate-600 uppercase tracking-widest ml-1">Issue Overview</label>
                        <input type="text" name="title" id="title" required placeholder="What needs attention?"
                            class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-6 py-4 text-white placeholder-slate-800 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none font-bold text-lg">
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="text-[10px] font-black text-slate-600 uppercase tracking-widest ml-1">Context & Details</label>
                        <textarea name="description" id="description" rows="5" required placeholder="Describe the problem in high detail..."
                            class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-6 py-4 text-white placeholder-slate-800 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none resize-none font-medium leading-relaxed"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="priority" class="text-[10px] font-black text-slate-600 uppercase tracking-widest ml-1">Priority Level</label>
                            <div class="relative">
                                <select name="priority" id="priority" class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-6 py-4 text-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none appearance-none font-bold text-xs uppercase tracking-widest cursor-pointer">
                                    <option value="low">Low Priority</option>
                                    <option value="medium" selected>Medium Priority</option>
                                    <option value="high">High Priority</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-6 border-t border-slate-800/50">
                    <form method="dialog">
                        <button class="text-[10px] font-black uppercase tracking-widest text-slate-600 hover:text-white transition-colors">Discard</button>
                    </form>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black uppercase tracking-[0.2em] px-8 py-4 rounded-full transition-all shadow-xl shadow-blue-900/40 hover:scale-105 active:scale-95">
                        Submit Report
                    </button>
                </div>
            </form>
        </div>
    </dialog>
    @endauth

    <x-footer />
</body>
</html>
