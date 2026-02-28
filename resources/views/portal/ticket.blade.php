<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $ticket->title }} - {{ $team->name }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500|inter:400,500|jetbrains-mono:400,500,600&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>
<body class="bg-bg text-text-primary flex min-h-screen flex-col font-sans antialiased selection:bg-accent selection:text-white relative">
    <x-header />

    <main class="flex-1 max-w-6xl mx-auto w-full px-6 lg:px-8 py-20">
        <!-- Back Navigation -->
        <div class="mb-10 flex items-center justify-between opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <a href="{{ route('portal.show', $team) }}" class="inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.08em] text-text-secondary hover:text-text-primary transition-colors duration-150 group">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:-translate-x-1"><path d="m15 18-6-6 6-6"/></svg>
                Workspace
            </a>
            
            <a href="{{ route('portal.index') }}" class="text-[11px] font-mono uppercase tracking-[0.08em] text-accent hover:text-accent-hover transition-colors duration-150">
                Directory
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-8 space-y-10 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
                <!-- Ticket Header -->
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <x-ticket-status-badge :status="$ticket->status" />
                        <span class="text-border-light font-mono text-[11px] uppercase tracking-[0.08em]">REF-{{ $ticket->id }}</span>
                    </div>
                    
                    <h1 class="text-3xl font-display font-medium text-text-primary mb-8 leading-tight tracking-tight">{{ $ticket->title }}</h1>
                    
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0">
                            @if($ticket->author?->avatar_path)
                                <img src="{{ asset('storage/' . $ticket->author->avatar_path) }}" 
                                     alt="{{ $ticket->author->name }}" 
                                     class="w-10 h-10 rounded-[4px] object-cover border border-border">
                            @else
                                <div class="w-10 h-10 rounded-[4px] bg-surface-2 flex items-center justify-center text-text-secondary font-mono text-sm border border-border">
                                    {{ substr($ticket->author?->name ?? '?', 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="text-[13px] font-medium text-text-primary">{{ $ticket->author?->name ?? 'Community Member' }}</p>
                            <p class="text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Reported {{ $ticket->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-surface-1 border border-border rounded-[8px] p-6">
                    <div class="prose prose-invert max-w-none text-text-secondary text-[15px] leading-relaxed">
                        {!! nl2br(e($ticket->description)) !!}
                    </div>
                </div>
                
                @if($ticket->tags->isNotEmpty())
                    <div class="flex flex-wrap gap-2 pt-2">
                        @foreach($ticket->tags as $tag)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-[4px] text-[10px] font-mono uppercase tracking-[0.08em] bg-surface-2 text-text-secondary border border-border">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <!-- Comments -->
                <div class="pt-10 border-t border-border">
                    <h3 class="text-[13px] font-mono text-text-primary uppercase tracking-[0.08em] mb-8 flex items-center gap-4">
                        Thread
                        <div class="h-px flex-1 bg-border"></div>
                    </h3>

                    @php
                        $events = collect()
                            ->concat($ticket->comments->map(fn($c) => ['type' => 'comment', 'model' => $c, 'date' => $c->created_at]))
                            ->concat($ticket->activityLogs->map(fn($l) => ['type' => 'log', 'model' => $l, 'date' => $l->created_at]))
                            ->sortBy('date')
                            ->values();
                    @endphp

                    <div class="space-y-8 mb-12 relative">
                        <div class="absolute left-4 top-8 bottom-0 w-px bg-border hidden sm:block"></div>
                        @forelse($events as $event)
                            @if($event['type'] === 'comment')
                                @php $comment = $event['model']; @endphp
                                <div class="flex gap-4 relative z-10 group">
                                    <div class="flex-shrink-0 hidden sm:block">
                                        @if($comment->author->avatar_path ?? false)
                                            <img src="{{ asset('storage/' . $comment->author->avatar_path) }}" 
                                                 alt="{{ $comment->author->name }}" 
                                                 class="w-9 h-9 rounded-[4px] object-cover border border-border transition-colors duration-150 group-hover:border-border-light bg-surface-2">
                                        @else
                                            <div class="w-9 h-9 rounded-[4px] bg-surface-2 flex items-center justify-center text-text-secondary font-mono text-xs border border-border transition-colors duration-150 group-hover:border-border-light">
                                                {{ substr($comment->author->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow min-w-0">
                                        <div class="flex items-center justify-between mb-1.5">
                                            <div class="flex items-center gap-3">
                                                <span class="text-[13px] font-medium text-text-primary">{{ $comment->author->name }}</span>
                                                <span class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <div class="bg-surface-1 border border-border rounded-[6px] p-4 text-text-secondary text-[14px] leading-relaxed group-hover:border-border-light transition-colors duration-150">
                                            {!! nl2br(e($comment->body)) !!}
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="relative z-10 pl-0 sm:pl-[52px]">
                                    <x-activity-log-item :log="$event['model']" />
                                </div>
                            @endif
                        @empty
                            <div class="text-center py-12 bg-surface-1 rounded-[8px] border border-border border-dashed">
                                <p class="text-text-muted font-mono uppercase tracking-[0.08em] text-[11px]">No activity recorded</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Post Comment -->
                    @auth
                        <div class="bg-surface-1 border border-border rounded-[8px] p-6 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.5)]">
                            <form action="{{ route('tickets.comments.store', [$team, $ticket]) }}" method="POST">
                                @csrf
                                <div class="space-y-5">
                                    <div class="flex items-center gap-2 mb-1">
                                        <div class="w-1.5 h-1.5 rounded-full bg-accent"></div>
                                        <h4 class="text-[11px] font-mono text-text-primary uppercase tracking-[0.08em]">Add to thread</h4>
                                    </div>
                                    
                                    <textarea 
                                        name="body" 
                                        rows="4" 
                                        placeholder="Add your input to this thread..." 
                                        class="w-full bg-surface-2 border border-border text-text-primary rounded-[6px] p-4 focus:outline-none focus:ring-0 focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] placeholder-text-muted resize-none min-h-[120px] transition-all duration-150 text-[14px] leading-relaxed"
                                        required
                                    ></textarea>
                                    
                                    @error('body')
                                        <p class="text-danger text-[11px] font-mono mt-2">{{ $message }}</p>
                                    @enderror
                                    
                                    <div class="flex justify-end pt-2">
                                        <x-blue-button type="submit">
                                            Post Reply
                                        </x-blue-button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="bg-surface-1/50 rounded-[8px] p-10 text-center border border-border">
                            <h4 class="text-[15px] font-medium text-text-primary uppercase tracking-[0.08em] mb-3">Thread Gated</h4>
                            <p class="text-text-secondary text-[13px] mb-8 max-w-sm mx-auto">You must be authenticated within the network to contribute to this discussion.</p>
                            <a href="{{ route('login') }}?redirect={{ url()->current() }}" class="inline-flex bg-text-primary text-bg text-[11px] font-mono uppercase tracking-[0.08em] px-6 py-2.5 rounded-[6px] hover:bg-text-primary/90 transition-all duration-150">
                                Verify Identity
                            </a>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 space-y-6 opacity-0 animate-[fadeIn_0.3s_ease-out_100ms_forwards]">
                <!-- Team Card -->
                <div class="bg-surface-1 border border-border rounded-[8px] p-6 hover:border-border-light transition-all duration-150 group">
                    <div class="flex items-center gap-4 mb-5">
                        @if($team->logo)
                            <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="w-10 h-10 rounded-[4px] object-cover border border-border">
                        @else
                            <div class="w-10 h-10 rounded-[4px] bg-surface-2 flex items-center justify-center text-text-secondary font-mono text-lg border border-border">
                                {{ substr($team->name, 0, 1) }}
                            </div>
                        @endif
                        <div class="min-w-0">
                            <h3 class="font-medium text-text-primary text-[15px] truncate group-hover:text-accent transition-colors duration-150">{{ $team->name }}</h3>
                            <a href="{{ route('portal.show', $team) }}" class="text-[10px] font-mono text-accent hover:text-accent-hover uppercase tracking-[0.08em] transition-colors inline-flex items-center gap-1">
                                Workspace Portal <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                    <p class="text-[13px] text-text-secondary leading-relaxed mb-6">
                        {{ \Illuminate\Support\Str::limit($team->description, 120) }}
                    </p>
                    
                    @auth
                        <button onclick="document.getElementById('create-ticket-modal').showModal()" class="w-full bg-surface-2 hover:bg-surface-3 border border-border text-text-primary text-[11px] font-mono uppercase tracking-[0.08em] py-2.5 rounded-[6px] transition-all duration-150">
                            New Submission
                        </button>
                    @endauth
                </div>

                <!-- Info Card -->
                <div class="bg-surface-1 border border-border rounded-[8px] p-6">
                    <h3 class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em] mb-6">Report Metadata</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Initialized</span>
                            <span class="text-[12px] font-medium text-text-primary">{{ $ticket->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Last Update</span>
                            <span class="text-[12px] font-medium text-text-primary">{{ $ticket->updated_at->diffForHumans() }}</span>
                        </div>
                        <div class="pt-4 border-t border-border flex justify-between items-center">
                            <span class="text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Priority</span>
                            <x-ticket-priority-badge :priority="$ticket->priority" />
                        </div>
                    </div>
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
            
            <form action="{{ route('portal.tickets.store', $team) }}" method="POST" class="p-6 space-y-6 overflow-y-auto">
                @csrf
                <div class="space-y-5">
                    <div class="space-y-1.5">
                        <label for="title" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Issue Overview</label>
                        <input type="text" name="title" id="title" required placeholder="What needs attention?" 
                            class="w-full bg-surface-2 border border-border rounded-[6px] px-4 py-2.5 text-text-primary placeholder-text-muted focus:border-accent focus:ring-0 focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all duration-150 outline-none text-[13px]">
                    </div>
                    <div class="space-y-1.5">
                        <label for="description" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Context & Details</label>
                        <textarea name="description" id="description" rows="5" required placeholder="Describe the problem in high detail..." 
                            class="w-full bg-surface-2 border border-border rounded-[6px] px-4 py-3 text-text-primary placeholder-text-muted focus:border-accent focus:ring-0 focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all duration-150 outline-none resize-none text-[13px] leading-relaxed"></textarea>
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
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>