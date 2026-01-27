<x-layouts.app title="Ticket #{{ $ticket->id }} - {{ $ticket->title }}" sidebar="team">
    <div class="max-w-7xl mx-auto">
        <!-- Breadcrumb / Navigation -->
        <div class="mb-8 flex items-center justify-between">
            <a href="{{ route('tickets.index', $team) }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-white transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:-translate-x-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to Board
            </a>
            
            <div class="flex items-center gap-3">
                <x-ticket-status-badge :status="$ticket->status" />
                <x-ticket-priority-badge :priority="$ticket->priority" />
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <!-- Main Content (Left) -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Ticket Header -->
                <div>
                    <div class="flex items-center gap-2 text-xs font-black text-slate-500 uppercase tracking-[0.2em] mb-3">
                        <span>Ticket Detail</span>
                        <span class="text-slate-800">•</span>
                        <span class="font-mono">#{{ $ticket->id }}</span>
                    </div>
                    <h1 class="text-4xl font-extrabold text-white mb-6 leading-tight tracking-tight">{{ $ticket->title }}</h1>
                    
                    <div class="flex items-center gap-4 p-1">
                        <div class="flex-shrink-0">
                            @if($ticket->author?->avatar_path)
                                <img src="{{ asset('storage/' . $ticket->author->avatar_path) }}" 
                                     alt="{{ $ticket->author->name }}" 
                                     class="w-10 h-10 rounded-full object-cover border-2 border-slate-800">
                            @else
                                <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 font-bold border-2 border-slate-800">
                                    {{ substr($ticket->author?->name ?? '?', 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-bold text-white">{{ $ticket->author?->name ?? 'Unknown' }}</p>
                            <p class="text-xs text-slate-500 font-medium">Opened {{ $ticket->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Description Card -->
                <div class="bg-slate-900/50 border border-slate-800 rounded-3xl p-8 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-blue-600/30"></div>
                    <h3 class="text-xs font-black text-slate-500 uppercase tracking-[0.2em] mb-6">Description</h3>
                    <div class="prose prose-invert max-w-none text-slate-300 leading-relaxed text-lg whitespace-pre-wrap">{{ $ticket->description }}</div>
                </div>

                <!-- Activity Section -->
                <div class="pt-12 border-t border-slate-800">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xl font-bold text-white tracking-tight flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-blue-500"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            Activity & Discussion
                        </h3>
                        <span class="text-xs font-bold text-slate-500 bg-slate-900 px-2 py-1 rounded-full border border-slate-800">{{ $ticket->comments->count() }} Comments</span>
                    </div>

                    <!-- Comment List -->
                    <div class="space-y-6 mb-12">
                        @forelse($ticket->comments as $comment)
                            <div class="flex gap-5 group">
                                <div class="flex-shrink-0">
                                    @if($comment->author->avatar_path ?? false)
                                        <img src="{{ asset('storage/' . $comment->author->avatar_path) }}" 
                                             alt="{{ $comment->author->name }}" 
                                             class="w-10 h-10 rounded-full object-cover border-2 border-slate-800 group-hover:border-blue-500/30 transition-colors">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 font-bold border-2 border-slate-800 group-hover:border-blue-500/30 transition-colors">
                                            {{ substr($comment->author->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow min-w-0">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm font-bold text-white">{{ $comment->author->name }}</span>
                                            <span class="text-[10px] font-bold text-slate-600 uppercase">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        @can('delete', $comment)
                                            <form action="{{ route('tickets.comments.destroy', [$team, $ticket, $comment]) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1 text-slate-600 hover:text-red-400 transition-colors" title="Delete comment">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                    <div class="text-slate-300 text-sm leading-relaxed bg-slate-900/40 rounded-2xl p-5 border border-slate-800/50 shadow-sm group-hover:border-slate-700 transition-colors">
                                        {!! nl2br(e($comment->body)) !!}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="py-10 text-center bg-slate-900/20 rounded-3xl border border-slate-800 border-dashed">
                                <p class="text-slate-500 font-medium italic">No conversation has started yet.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Add Comment Form -->
                    <div class="bg-slate-900/50 border border-slate-800 rounded-3xl p-6 shadow-xl">
                        <form action="{{ route('tickets.comments.store', [$team, $ticket]) }}" method="POST">
                            @csrf
                            <div class="flex gap-4">
                                <div class="flex-shrink-0 hidden sm:block">
                                    @if(auth()->user()->avatar_path)
                                        <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" 
                                             alt="{{ auth()->user()->name }}" 
                                             class="w-10 h-10 rounded-full object-cover border-2 border-slate-800">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 font-bold border-2 border-slate-800">
                                            {{ substr(auth()->user()->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow">
                                    <textarea 
                                        name="body" 
                                        rows="3" 
                                        placeholder="Type your message here..." 
                                        class="w-full bg-slate-950 border border-slate-800 text-white text-sm rounded-2xl p-4 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 placeholder:text-slate-600 resize-none min-h-[120px] transition-all"
                                        required
                                    ></textarea>
                                    @error('body')
                                        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                    <div class="mt-4 flex justify-end">
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-xs font-black uppercase tracking-widest px-6 py-3 rounded-full transition-all shadow-lg shadow-blue-600/20 hover:scale-105 active:scale-95">
                                            Post Reply
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar (Right) -->
            <div class="lg:col-span-4 space-y-8">
                
                <!-- Status & Control Card -->
                <section class="bg-slate-900/50 border border-slate-800 rounded-3xl p-6 shadow-lg">
                    <h3 class="text-xs font-black text-slate-500 uppercase tracking-[0.2em] mb-6">Management</h3>
                    
                    <div class="space-y-6">
                        <!-- Status Selector -->
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Update Status</label>
                            <form action="{{ route('tickets.update', [$team, $ticket]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="relative group">
                                    <select name="status" onchange="this.form.submit()" 
                                        class="w-full bg-slate-950 border border-slate-800 text-white text-sm rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 p-3 appearance-none cursor-pointer">
                                        <option value="open" {{ $ticket->status === \App\Enums\TicketStatus::OPEN ? 'selected' : '' }}>Open</option>
                                        <option value="in_progress" {{ $ticket->status === \App\Enums\TicketStatus::IN_PROGRESS ? 'selected' : '' }}>In Progress</option>
                                        <option value="waiting" {{ $ticket->status === \App\Enums\TicketStatus::WAITING ? 'selected' : '' }}>Waiting</option>
                                        <option value="closed" {{ $ticket->status === \App\Enums\TicketStatus::CLOSED ? 'selected' : '' }}>Closed</option>
                                    </select>
                                    <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-500 group-hover:text-slate-300 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="pt-6 border-t border-slate-800/50">
                            <span class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Priority Level</span>
                            <x-ticket-priority-badge :priority="$ticket->priority" />
                        </div>
                    </div>
                </section>

                <!-- Assignee Card -->
                <section class="bg-slate-900/50 border border-slate-800 rounded-3xl p-6 shadow-lg">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xs font-black text-slate-500 uppercase tracking-[0.2em]">Ownership</h3>
                        @if($team->users->contains(auth()->user()))
                            <form action="{{ route('tickets.update', [$team, $ticket]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                
                                @if($ticket->assigned_id !== auth()->id())
                                    <input type="hidden" name="assigned_id" value="{{ auth()->id() }}">
                                    <button type="submit" class="text-[10px] font-black text-blue-500 hover:text-blue-400 uppercase tracking-widest transition-colors">
                                        Take Control
                                    </button>
                                @else
                                    <input type="hidden" name="assigned_id" value="">
                                    <button type="submit" class="text-[10px] font-black text-red-500 hover:text-red-400 uppercase tracking-widest transition-colors">
                                        Release
                                    </button>
                                @endif
                            </form>
                        @endif
                    </div>

                    @if($ticket->assignee)
                        <div class="flex items-center gap-4 bg-slate-950/50 p-3 rounded-2xl border border-slate-800">
                            <div class="flex-shrink-0">
                                @if($ticket->assignee->avatar_path)
                                    <img src="{{ asset('storage/' . $ticket->assignee->avatar_path) }}" 
                                         alt="{{ $ticket->assignee->name }}" 
                                         class="w-10 h-10 rounded-xl object-cover border border-slate-800">
                                @else
                                    <div class="w-10 h-10 rounded-xl bg-blue-600/10 flex items-center justify-center text-blue-500 font-bold border border-blue-500/20">
                                        {{ substr($ticket->assignee->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-white truncate">{{ $ticket->assignee->name }}</p>
                                <p class="text-[10px] text-slate-500 font-bold uppercase truncate">Agent assigned</p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-4 bg-slate-950/20 p-4 rounded-2xl border border-slate-800 border-dashed">
                            <div class="w-10 h-10 rounded-xl bg-slate-800/50 flex items-center justify-center text-slate-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                            </div>
                            <span class="text-sm font-medium text-slate-500 italic">Unclaimed</span>
                        </div>
                    @endif
                </section>

                <!-- Tags Section -->
                <section class="bg-slate-900/50 border border-slate-800 rounded-3xl p-6 shadow-lg">
                    <h3 class="text-xs font-black text-slate-500 uppercase tracking-[0.2em] mb-6">Categorization</h3>
                    
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($ticket->tags as $tag)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-blue-500/10 text-blue-400 border border-blue-500/20 uppercase tracking-widest">
                                {{ $tag->name }}
                                <form action="{{ route('tickets.tags.destroy', [$team, $ticket, $tag]) }}" method="POST" class="inline-flex ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-blue-400 hover:text-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 18 12"/></svg>
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
                        <div class="mb-6">
                            <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest mb-3">Quick Tags</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($availableTags->take(5) as $tag)
                                    <form action="{{ route('tickets.tags.store', [$team, $ticket]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="name" value="{{ $tag->name }}">
                                        <button type="submit" class="px-2.5 py-1 text-[10px] font-bold rounded-lg bg-slate-800 text-slate-400 border border-slate-700 hover:border-slate-500 hover:text-slate-200 transition-all">
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
                            class="flex-1 bg-slate-950 border border-slate-800 text-white text-xs font-bold rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 placeholder:text-slate-700 transition-all"
                            required
                        >
                        <button type="submit" class="bg-slate-800 hover:bg-slate-700 text-white rounded-xl px-3 border border-slate-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        </button>
                    </form>
                </section>

                <!-- Actions -->
                <div class="flex flex-col gap-3">
                    <a href="{{ route('tickets.edit', [$team, $ticket]) }}" class="w-full inline-flex justify-center items-center gap-3 px-6 py-3.5 text-xs font-black uppercase tracking-[0.2em] text-white bg-slate-800 hover:bg-slate-700 border border-slate-700 rounded-2xl transition-all shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-edit-3"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                        Modify Ticket
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
