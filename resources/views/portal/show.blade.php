<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $team->name }} - Portal</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500|inter:400,500|jetbrains-mono:400,500,600&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>
<body class="bg-bg text-text-primary flex min-h-screen flex-col font-sans antialiased selection:bg-accent selection:text-white relative">
    
    <div class="relative z-10 flex flex-col min-h-screen">
        <x-header />

        <!-- Team Header Banner -->
        <div class="h-48 bg-surface-1 border-b border-border relative overflow-hidden flex items-center justify-center">
            <!-- Back Link -->
            <div class="absolute top-6 left-6 z-20 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
                <a href="{{ route('portal.index') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-[6px] bg-surface-2 hover:bg-surface-3 text-text-secondary hover:text-text-primary text-[11px] font-mono uppercase tracking-[0.08em] transition-colors duration-150 border border-border">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    Directory
                </a>
            </div>
        </div>

        <main class="flex-1 max-w-7xl mx-auto w-full px-6 lg:px-8 -mt-16 relative z-10 pb-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <!-- Left Sidebar: Team Info -->
                <div class="lg:col-span-4 space-y-6 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
                    <div class="bg-surface-1 border border-border rounded-[8px] p-6">
                        <div class="flex flex-col items-center text-center mb-6">
                            @if($team->logo)
                                <div class="w-20 h-20 rounded-[6px] bg-surface-2 border border-border mb-4 overflow-hidden flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-20 h-20 rounded-[6px] bg-surface-2 flex items-center justify-center text-3xl font-display font-medium text-text-primary border border-border mb-4">
                                    {{ substr($team->name, 0, 1) }}
                                </div>
                            @endif
                            <h1 class="text-2xl font-display font-medium text-text-primary mb-2 tracking-tight">{{ $team->name }}</h1>
                            <div class="inline-flex items-center px-2 py-0.5 rounded-[4px] bg-bg border border-border text-[10px] font-mono text-text-muted uppercase tracking-[0.08em] mb-6">
                                Verified Hub
                            </div>

                            <!-- CTA Button -->
                            @auth
                                <button onclick="document.getElementById('create-ticket-modal').showModal()" class="w-full bg-accent hover:bg-accent-hover text-white text-[11px] font-mono uppercase tracking-[0.08em] py-3 rounded-[6px] transition-all duration-150 flex items-center justify-center gap-2 hover:-translate-y-[1px] hover:shadow-[0_0_12px_var(--color-accent-glow)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                    New Submission
                                </button>
                            @else
                                <a href="{{ route('login') }}?redirect={{ url()->current() }}" class="w-full bg-surface-2 hover:bg-surface-3 border border-border text-text-primary text-[11px] font-mono uppercase tracking-[0.08em] py-3 rounded-[6px] transition-colors duration-150 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>
                                    Login to Submit
                                </a>
                            @endauth
                        </div>

                        <div class="space-y-6 pt-6 border-t border-border">
                            <div>
                                <h3 class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em] mb-3">Workspace Bio</h3>
                                <p class="text-text-secondary text-[13px] leading-relaxed">
                                    {{ $team->description ?? 'No description provided.' }}
                                </p>
                            </div>

                            <div>
                                <h3 class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em] mb-3">Hub Statistics</h3>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="bg-bg rounded-[6px] p-3 border border-border">
                                        <div class="text-xl font-mono text-text-primary mb-1">{{ $team->tickets()->count() }}</div>
                                        <div class="text-[10px] font-mono text-text-secondary uppercase tracking-[0.08em]">Reports</div>
                                    </div>
                                    <div class="bg-bg rounded-[6px] p-3 border border-border">
                                        <div class="text-xl font-mono text-text-primary mb-1">{{ $team->users()->count() }}</div>
                                        <div class="text-[10px] font-mono text-text-secondary uppercase tracking-[0.08em]">Agents</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Content: Ticket Feed -->
                <div class="lg:col-span-8 opacity-0 animate-[fadeIn_0.3s_ease-out_100ms_forwards]">
                    <!-- Success Message -->
                    @if (session('status'))
                        <div class="mb-6 bg-success/10 border border-success/20 text-success p-4 rounded-[8px] flex items-center gap-3">
                            <div class="w-6 h-6 rounded-[4px] bg-success/20 flex items-center justify-center flex-shrink-0 border border-success/20">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            </div>
                            <span class="font-medium text-[13px]">{{ session('status') }}</span>
                        </div>
                    @endif

                    <div class="bg-surface-1 border border-border rounded-[8px] overflow-hidden">
                        <div class="px-6 py-5 border-b border-border bg-surface-2 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <h2 class="text-[13px] font-mono text-text-primary uppercase tracking-[0.08em]">Community Reports</h2>

                            <form action="{{ route('portal.show', $team) }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-text-muted group-focus-within:text-accent transition-colors duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                    </div>
                                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search..."
                                        class="bg-bg border border-border rounded-[6px] text-[12px] py-2 pl-9 pr-3 text-text-primary w-full sm:w-48 placeholder-text-muted focus:border-accent focus:ring-0 focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all outline-none">
                                </div>

                                <div class="flex items-center gap-2">
                                    <span class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">Sort</span>
                                    <select name="sort" onchange="this.form.submit()" class="bg-bg border border-border rounded-[6px] text-[11px] font-mono uppercase tracking-[0.08em] focus:border-accent focus:ring-0 focus:shadow-[0_0_0_3px_var(--color-accent-glow)] py-2 pl-2 pr-6 text-text-primary cursor-pointer outline-none transition-all">
                                        <option value="newest" {{ ($currentSort ?? 'newest') === 'newest' ? 'selected' : '' }}>Newest</option>
                                        <option value="oldest" {{ ($currentSort ?? 'newest') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                                        <option value="status" {{ ($currentSort ?? 'newest') === 'status' ? 'selected' : '' }}>Status</option>
                                        <option value="priority" {{ ($currentSort ?? 'newest') === 'priority' ? 'selected' : '' }}>Priority</option>
                                    </select>
                                </div>
                            </form>
                        </div>

                        <div class="divide-y divide-border">
                            @forelse($tickets as $ticket)
                                <a href="{{ route('portal.tickets.show', [$team, $ticket]) }}" class="block p-6 hover:bg-surface-2 transition-colors duration-150 group">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2.5 mb-2">
                                                <x-ticket-status-badge :status="$ticket->status" />
                                                <span class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">#{{ $ticket->id }}</span>
                                                <span class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">{{ $ticket->created_at->diffForHumans() }}</span>
                                            </div>
                                            <h3 class="text-[15px] font-medium text-text-primary group-hover:text-accent transition-colors duration-150 truncate mb-2">
                                                {{ $ticket->title }}
                                            </h3>
                                            <p class="text-[13px] text-text-secondary line-clamp-2 leading-relaxed">{{ $ticket->description }}</p>

                                            @if($ticket->tags->isNotEmpty())
                                                <div class="mt-3 flex flex-wrap gap-1.5">
                                                    @foreach($ticket->tags as $tag)
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded-[4px] text-[10px] font-mono uppercase tracking-[0.08em] bg-bg text-text-secondary border border-border">
                                                            {{ $tag->name }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Priority Indicator -->
                                        <div class="flex-shrink-0 pt-1">
                                            @if($ticket->priority->value === 'high' || $ticket->priority->value === 'urgent')
                                                <div class="w-2 h-2 rounded-full bg-danger"></div>
                                            @elseif($ticket->priority->value === 'medium')
                                                <div class="w-2 h-2 rounded-full bg-warning"></div>
                                            @else
                                                <div class="w-2 h-2 rounded-full bg-success"></div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="p-16 text-center">
                                    <div class="w-12 h-12 bg-surface-2 rounded-[6px] flex items-center justify-center mx-auto mb-4 border border-border">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
                                    </div>
                                    <h3 class="text-[15px] font-medium text-text-primary mb-1">No activity detected</h3>
                                    <p class="text-[13px] text-text-secondary">This feed is currently silent. Be the first to initiate a report.</p>
                                </div>
                            @endforelse
                        </div>

                        @if($tickets->hasPages())
                            <div class="px-6 py-5 border-t border-border bg-surface-2">
                                {{ $tickets->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>

        <!-- Create Ticket Modal -->
        @auth
        <dialog id="create-ticket-modal" class="hidden open:flex bg-transparent backdrop:bg-bg/90 p-0 w-full h-full fixed inset-0 z-50 items-center justify-center open:animate-fade-in">
            <div class="bg-surface-1 border border-border rounded-[8px] overflow-hidden w-full max-w-2xl max-h-[90vh] flex flex-col relative mx-4 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.5)]">
                <div class="px-6 py-4 border-b border-border flex items-center justify-between bg-surface-2">
                    <h3 class="text-[11px] font-mono text-text-primary uppercase tracking-[0.08em]">Initiate Submission</h3>
                    <form method="dialog">
                        <button class="text-text-secondary hover:text-text-primary transition-colors p-1.5 rounded-[4px] hover:bg-surface-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                        </button>
                    </form>
                </div>

                <form action="{{ route('portal.tickets.store', $team) }}" method="POST" class="p-6 space-y-6 overflow-y-auto bg-surface-1">
                    @csrf

                    <div class="space-y-5">
                        <div class="space-y-1.5">
                            <label for="title" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Issue Overview</label>
                            <input type="text" name="title" id="title" required placeholder="What needs attention?"
                                class="w-full bg-surface-2 border border-border rounded-[6px] px-4 py-2.5 text-text-primary placeholder-text-muted focus:border-accent focus:ring-0 focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all outline-none text-[13px]">
                        </div>

                        <div class="space-y-1.5">
                            <label for="description" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Context & Details</label>
                            <textarea name="description" id="description" rows="5" required placeholder="Describe the problem in high detail..."
                                class="w-full bg-surface-2 border border-border rounded-[6px] px-4 py-3 text-text-primary placeholder-text-muted focus:border-accent focus:ring-0 focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all outline-none resize-none text-[13px] leading-relaxed"></textarea>
                        </div>

                        <div class="grid grid-cols-1 gap-5">
                            <div class="space-y-1.5">
                                <label for="priority" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Priority Level</label>
                                <div class="relative">
                                    <select name="priority" id="priority" class="w-full bg-surface-2 border border-border rounded-[6px] px-4 py-2.5 text-text-primary focus:border-accent focus:ring-0 focus:shadow-[0_0_0_3px_var(--color-accent-glow)] outline-none appearance-none font-mono text-[11px] uppercase tracking-[0.08em] cursor-pointer transition-all">
                                        <option value="low">Low</option>
                                        <option value="medium" selected>Medium</option>
                                        <option value="high">High</option>
                                    </select>
                                    <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-text-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-5 flex items-center justify-end gap-4 border-t border-border mt-6">
                        <form method="dialog">
                            <button class="text-[11px] font-mono uppercase tracking-[0.08em] text-text-secondary hover:text-text-primary transition-colors duration-150">Discard</button>
                        </form>
                        <x-blue-button type="submit">
                            Submit Report
                        </x-blue-button>
                    </div>
                </form>
            </div>
        </dialog>
        @endauth
        <x-footer />
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>