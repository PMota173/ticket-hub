<x-layouts.app title="Ticket #{{ $ticket->id }} - {{ $ticket->title }}" sidebar="team">
    <div class="max-w-7xl mx-auto">
        <!-- Breadcrumb / Navigation -->
        <div class="mb-6 flex items-center justify-between opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <a href="{{ route('tickets.index', $team) }}" class="inline-flex items-center gap-2 text-sm font-medium text-text-secondary hover:text-text-primary transition-colors duration-150 group">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform duration-150 group-hover:-translate-x-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to Board
            </a>
            
            <div class="flex items-center gap-2">
                <x-ticket-status-badge :status="$ticket->status" />
                <x-ticket-priority-badge :priority="$ticket->priority" />
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            <!-- Main Content (Left) -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Ticket Header -->
                <div>
                    <div class="flex items-center gap-2 text-[11px] font-mono text-text-muted uppercase tracking-[0.08em] mb-2">
                        <span>Ticket Detail</span>
                        <span class="text-border-light">•</span>
                        <span>#{{ $ticket->id }}</span>
                    </div>
                    <h1 class="text-3xl font-display font-medium text-text-primary mb-6 leading-tight tracking-tight">{{ $ticket->title }}</h1>
                    
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0">
                            @if($ticket->author?->avatar_path)
                                <img src="{{ asset('storage/' . $ticket->author->avatar_path) }}" 
                                     alt="{{ $ticket->author->name }}" 
                                     class="w-8 h-8 rounded-[4px] object-cover border border-border">
                            @else
                                <div class="w-8 h-8 rounded-[4px] bg-surface-2 flex items-center justify-center text-text-secondary font-mono text-sm border border-border">
                                    {{ substr($ticket->author?->name ?? '?', 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="text-[13px] font-medium text-text-primary">{{ $ticket->author?->name ?? 'Unknown' }}</p>
                            <p class="text-[11px] font-mono text-text-muted">Opened {{ $ticket->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Description Card -->
                <div class="bg-surface-1 border border-border rounded-[8px] p-6">
                    <h3 class="text-[11px] font-mono text-text-muted uppercase tracking-[0.08em] mb-4">Description</h3>
                    <div class="prose prose-invert max-w-none text-text-secondary leading-relaxed text-[15px] whitespace-pre-wrap">{{ $ticket->description }}</div>
                </div>

                <!-- Activity Section -->
                <div class="pt-8 border-t border-border">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-medium text-text-primary tracking-tight flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            Activity Timeline
                        </h3>
                        <span class="text-[11px] font-mono text-text-secondary bg-surface-2 px-2 py-0.5 rounded-[4px] border border-border">{{ $ticket->comments->count() + $ticket->activityLogs->count() }} Events</span>
                    </div>

                    @php
                        $events = collect()
                            ->concat($ticket->comments->map(fn($c) => ['type' => 'comment', 'model' => $c, 'date' => $c->created_at]))
                            ->concat($ticket->activityLogs->map(fn($l) => ['type' => 'log', 'model' => $l, 'date' => $l->created_at]))
                            ->sortBy('date')
                            ->values();
                    @endphp

                    <!-- Event List -->
                    <div class="space-y-4 mb-8">
                        @forelse($events as $event)
                            @if($event['type'] === 'comment')
                                @php $comment = $event['model']; @endphp
                                <div class="flex gap-4 group relative">
                                    <div class="absolute left-4 top-8 bottom-[-16px] w-px bg-border group-last:hidden"></div>
                                    <div class="relative z-10 flex-shrink-0 mt-1">
                                        @if($comment->author->avatar_path ?? false)
                                            <img src="{{ asset('storage/' . $comment->author->avatar_path) }}" 
                                                 alt="{{ $comment->author->name }}" 
                                                 class="w-8 h-8 rounded-[4px] object-cover border border-border bg-surface-2">
                                        @else
                                            <div class="w-8 h-8 rounded-[4px] bg-surface-2 flex items-center justify-center text-text-secondary font-mono text-xs border border-border">
                                                {{ substr($comment->author->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow min-w-0">
                                        <div class="flex items-center justify-between mb-1.5">
                                            <div class="flex items-center gap-2">
                                                <span class="text-[13px] font-medium text-text-primary">{{ $comment->author->name }}</span>
                                                <span class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            @can('delete', $comment)
                                                <form action="{{ route('tickets.comments.destroy', [$team, $ticket, $comment]) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity duration-150">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-1 text-text-muted hover:text-danger transition-colors duration-150" title="Delete comment">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                        <div class="text-text-secondary text-[14px] leading-relaxed bg-surface-1 rounded-[6px] p-4 border border-border">
                                            {!! nl2br(e($comment->body)) !!}
                                        </div>
                                    </div>
                                </div>
                            @else
                                <x-activity-log-item :log="$event['model']" />
                            @endif
                        @empty
                            <div class="py-8 text-center bg-surface-1 rounded-[6px] border border-border border-dashed">
                                <p class="text-text-secondary text-[13px] italic">No activity recorded yet.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Add Comment Form -->
                    <div class="bg-surface-1 border border-border rounded-[8px] p-5">
                        <form action="{{ route('tickets.comments.store', [$team, $ticket]) }}" method="POST">
                            @csrf
                            <div class="flex gap-4">
                                <div class="flex-shrink-0 hidden sm:block">
                                    @if(auth()->user()->avatar_path)
                                        <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" 
                                             alt="{{ auth()->user()->name }}" 
                                             class="w-8 h-8 rounded-[4px] object-cover border border-border">
                                    @else
                                        <div class="w-8 h-8 rounded-[4px] bg-surface-2 flex items-center justify-center text-text-secondary font-mono text-xs border border-border">
                                            {{ substr(auth()->user()->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow">
                                    <textarea 
                                        name="body" 
                                        rows="3" 
                                        placeholder="Type your message here..." 
                                        class="w-full bg-surface-2 border border-border text-text-primary text-[14px] rounded-[6px] p-3 focus:outline-none focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] placeholder-text-muted resize-none min-h-[100px] transition-all duration-150"
                                        required
                                    ></textarea>
                                    @error('body')
                                        <p class="text-danger text-[11px] font-mono mt-1.5">{{ $message }}</p>
                                    @enderror
                                    <div class="mt-3 flex justify-end">
                                        <x-blue-button type="submit">
                                            Post Reply
                                        </x-blue-button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar (Right) -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Status & Control Card -->
                <section class="bg-surface-1 border border-border rounded-[8px] p-5">
                    <h3 class="text-[11px] font-mono text-text-muted uppercase tracking-[0.08em] mb-4">Management</h3>
                    
                    <div class="space-y-5">
                        <!-- Status Selector -->
                        <div>
                            <label class="block text-[10px] font-mono text-text-secondary uppercase tracking-[0.08em] mb-2">Update Status</label>
                            <form action="{{ route('tickets.update', [$team, $ticket]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="relative group">
                                    <select name="status" onchange="this.form.submit()" 
                                        class="w-full bg-surface-2 border border-border text-text-primary text-[13px] rounded-[6px] focus:outline-none focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] p-2.5 appearance-none cursor-pointer transition-all duration-150">
                                        <option value="triage" {{ $ticket->status === \App\Enums\TicketStatus::TRIAGE ? 'selected' : '' }}>Triage</option>
                                        <option value="open" {{ $ticket->status === \App\Enums\TicketStatus::OPEN ? 'selected' : '' }}>Open</option>
                                        <option value="in_progress" {{ $ticket->status === \App\Enums\TicketStatus::IN_PROGRESS ? 'selected' : '' }}>In Progress</option>
                                        <option value="waiting" {{ $ticket->status === \App\Enums\TicketStatus::WAITING ? 'selected' : '' }}>Waiting</option>
                                        <option value="closed" {{ $ticket->status === \App\Enums\TicketStatus::CLOSED ? 'selected' : '' }}>Closed</option>
                                    </select>
                                    <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-text-muted group-hover:text-text-primary transition-colors duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="pt-4 border-t border-border">
                            <span class="block text-[10px] font-mono text-text-secondary uppercase tracking-[0.08em] mb-2">Priority Level</span>
                            <x-ticket-priority-badge :priority="$ticket->priority" />
                        </div>
                    </div>
                </section>

                <!-- Assignee Card -->
                <section class="bg-surface-1 border border-border rounded-[8px] p-5">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Ownership</h3>
                        @if($team->users->contains(auth()->user()))
                            <form action="{{ route('tickets.update', [$team, $ticket]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                
                                @if($ticket->assigned_id !== auth()->id())
                                    <input type="hidden" name="assigned_id" value="{{ auth()->id() }}">
                                    <button type="submit" class="text-[10px] font-mono text-accent hover:text-accent-hover uppercase tracking-[0.08em] transition-colors duration-150">
                                        Take Control
                                    </button>
                                @else
                                    <input type="hidden" name="assigned_id" value="">
                                    <button type="submit" class="text-[10px] font-mono text-danger hover:text-danger/80 uppercase tracking-[0.08em] transition-colors duration-150">
                                        Release
                                    </button>
                                @endif
                            </form>
                        @endif
                    </div>

                    @if($ticket->assignee)
                        <div class="flex items-center gap-3 bg-surface-2 p-2.5 rounded-[6px] border border-border">
                            <div class="flex-shrink-0">
                                @if($ticket->assignee->avatar_path)
                                    <img src="{{ asset('storage/' . $ticket->assignee->avatar_path) }}" 
                                         alt="{{ $ticket->assignee->name }}" 
                                         class="w-8 h-8 rounded-[4px] object-cover border border-border">
                                @else
                                    <div class="w-8 h-8 rounded-[4px] bg-accent/10 flex items-center justify-center text-accent font-mono text-xs border border-accent/20">
                                        {{ substr($ticket->assignee->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="text-[13px] font-medium text-text-primary truncate">{{ $ticket->assignee->name }}</p>
                                <p class="text-[10px] text-text-muted font-mono uppercase tracking-[0.08em] truncate">Agent assigned</p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3 bg-bg p-3 rounded-[6px] border border-border border-dashed">
                            <div class="w-8 h-8 rounded-[4px] bg-surface-2 flex items-center justify-center text-text-secondary border border-border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                            </div>
                            <span class="text-[13px] text-text-secondary italic">Unclaimed</span>
                        </div>
                    @endif
                </section>

                <!-- Tags Section -->
                <section class="bg-surface-1 border border-border rounded-[8px] p-5">
                    <h3 class="text-[11px] font-mono text-text-muted uppercase tracking-[0.08em] mb-4">Categorization</h3>
                    
                    <div class="flex flex-wrap gap-2 mb-5">
                        @foreach($ticket->tags as $tag)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-[4px] text-[11px] font-mono bg-surface-2 text-text-primary border border-border uppercase tracking-[0.08em]">
                                {{ $tag->name }}
                                <form action="{{ route('tickets.tags.destroy', [$team, $ticket, $tag]) }}" method="POST" class="inline-flex ml-1.5">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-text-muted hover:text-danger transition-colors duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 18 12"/></svg>
                                    </button>
                                </form>
                            </span>
                        @endforeach
                    </div>

                    @php
                        $existingTagIds = $ticket->tags->pluck('id')->toArray();
                        $availableTags = $team->tags->filter(fn($tag) => !in_array($tag->id, $existingTagIds));
                    @endphp

                    @if($availableTags->isNotEmpty())
                        <div class="mb-5">
                            <p class="text-[10px] font-mono text-text-secondary uppercase tracking-[0.08em] mb-2">Quick Tags</p>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($availableTags->take(5) as $tag)
                                    <form action="{{ route('tickets.tags.store', [$team, $ticket]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="name" value="{{ $tag->name }}">
                                        <button type="submit" class="px-2 py-0.5 text-[10px] font-mono rounded-[4px] bg-bg text-text-secondary border border-border hover:border-border-light hover:text-text-primary transition-all duration-150">
                                            + {{ $tag->name }}
                                        </button>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('tickets.tags.store', [$team, $ticket]) }}" method="POST" class="flex gap-2">
                        @csrf
                        <input 
                            type="text" 
                            name="name" 
                            placeholder="New tag..." 
                            class="flex-1 bg-surface-2 border border-border text-text-primary text-[12px] font-mono rounded-[6px] px-3 py-2 focus:outline-none focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] placeholder-text-muted transition-all duration-150"
                            required
                        >
                        <button type="submit" class="bg-surface-2 hover:bg-surface-3 text-text-primary rounded-[6px] px-3 border border-border transition-colors duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        </button>
                    </form>
                </section>

                <!-- Actions -->
                <div class="flex flex-col gap-2">
                    <x-gray-button href="{{ route('tickets.edit', [$team, $ticket]) }}" class="w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1.5"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                        Modify Ticket
                    </x-gray-button>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-layouts.app>
