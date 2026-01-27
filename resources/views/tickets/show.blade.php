<x-layouts.app title="Ticket #{{ $ticket->id }} - {{ $ticket->title }}">
    <div class="max-w-7xl mx-auto">
        <!-- Breadcrumb / Back -->
        <div class="mb-6">
            <x-back-button href="{{ route('tickets.index', $team) }}">Back to Board</x-back-button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content (Left) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Ticket Header -->
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">{{ $ticket->title }}</h1>
                    <div class="flex items-center gap-2 text-sm text-slate-400">
                        <span class="font-mono text-slate-500">#{{ $ticket->id }}</span>
                        <span>&bull;</span>
                        <span>Opened by <span class="text-white">{{ $ticket->author->name }}</span></span>
                        <span>&bull;</span>
                        <span>{{ $ticket->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <!-- Description Card -->
                <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-6 shadow-sm">
                    <h3 class="text-sm font-medium text-slate-500 uppercase tracking-wider mb-4">Description</h3>
                    <div class="prose prose-invert max-w-none text-slate-300 leading-relaxed whitespace-pre-wrap">{{ $ticket->description }}</div>
                </div>

                <!-- Comments Section -->
                <div class="mt-8 pt-8 border-t border-slate-800">
                    <h3 class="text-lg font-bold text-white mb-6">Activity & Comments</h3>

                    <!-- Comment List -->
                    <div class="space-y-6 mb-8">
                        @forelse($ticket->comments as $comment)
                            <div class="flex gap-4 group">
                                <div class="flex-shrink-0">
                                    @if($comment->user->avatar_path)
                                        <img src="{{ asset('storage/' . $comment->user->avatar_path) }}" 
                                             alt="{{ $comment->user->name }}" 
                                             class="w-10 h-10 rounded-full object-cover border border-slate-700">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 font-bold border border-slate-700">
                                            {{ substr($comment->user->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow">
                                    <div class="flex items-center justify-between mb-1">
                                        <div class="flex items-center gap-2">
                                            <span class="font-medium text-white">{{ $comment->user->name }}</span>
                                            <span class="text-xs text-slate-500">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        @can('delete', $comment)
                                            <form action="{{ route('tickets.comments.destroy', [$team, $ticket, $comment]) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-slate-600 hover:text-red-400 transition-colors" title="Delete comment">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                    <div class="text-slate-300 text-sm leading-relaxed bg-slate-900/30 rounded-lg p-3 border border-slate-800/50">
                                        {!! nl2br(e($comment->body)) !!}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-slate-500 text-sm italic">No comments yet.</p>
                        @endforelse
                    </div>

                    <!-- Add Comment Form -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 hidden sm:block">
                            @if(auth()->user()->avatar_path)
                                <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" 
                                     alt="{{ auth()->user()->name }}" 
                                     class="w-10 h-10 rounded-full object-cover border border-slate-700">
                            @else
                                <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 font-bold border border-slate-700">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow">
                            <form action="{{ route('tickets.comments.store', [$team, $ticket]) }}" method="POST">
                                @csrf
                                <div class="relative">
                                    <textarea 
                                        name="body" 
                                        rows="3" 
                                        placeholder="Add a comment..." 
                                        class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500 placeholder:text-slate-600 resize-y min-h-[100px]"
                                        required
                                    ></textarea>
                                    @error('body')
                                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mt-2 flex justify-end">
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                                        Post Comment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar (Right) -->
            <div class="space-y-6">
                <!-- Status & Priority Card -->
                <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-5 shadow-sm">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Details</h3>
                    
                    <div class="space-y-4">
                        <!-- Status -->
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1.5">Status</label>
                            <form action="{{ route('tickets.update', [$team, $ticket]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" 
                                    class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                    <option value="open" {{ $ticket->status === \App\Enums\TicketStatus::OPEN ? 'selected' : '' }}>Open</option>
                                    <option value="in_progress" {{ $ticket->status === \App\Enums\TicketStatus::IN_PROGRESS ? 'selected' : '' }}>In Progress</option>
                                    <option value="waiting" {{ $ticket->status === \App\Enums\TicketStatus::WAITING ? 'selected' : '' }}>Waiting</option>
                                    <option value="closed" {{ $ticket->status === \App\Enums\TicketStatus::CLOSED ? 'selected' : '' }}>Closed</option>
                                </select>
                            </form>
                        </div>

                        <!-- Priority -->
                        <div>
                            <span class="block text-xs font-medium text-slate-400 mb-1.5">Priority</span>
                            <div class="flex items-center gap-2">
                                <x-ticket-priority-badge :priority="$ticket->priority" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Assignee Card -->
                <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-5 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Assignee</h3>
                        @if($team->users->contains(auth()->user()))
                            <form action="{{ route('tickets.update', [$team, $ticket]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                
                                @if($ticket->assigned_id !== auth()->id())
                                    <input type="hidden" name="assigned_id" value="{{ auth()->id() }}">
                                    <button type="submit" class="text-xs text-blue-400 hover:text-blue-300 font-medium transition-colors">
                                        Assign to me
                                    </button>
                                @else
                                    <input type="hidden" name="assigned_id" value="">
                                    <button type="submit" class="text-xs text-red-400 hover:text-red-300 font-medium transition-colors">
                                        Unassign me
                                    </button>
                                @endif
                            </form>
                        @endif
                    </div>

                    @if($ticket->assignee)
                        <div class="flex items-center gap-3">
                            @if($ticket->assignee->avatar_path)
                                <img src="{{ asset('storage/' . $ticket->assignee->avatar_path) }}" 
                                     alt="{{ $ticket->assignee->name }}" 
                                     class="w-10 h-10 rounded-full object-cover border border-slate-700">
                            @else
                                <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 font-bold border border-slate-700">
                                    {{ substr($ticket->assignee->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <p class="text-sm font-medium text-white">{{ $ticket->assignee->name }}</p>
                                <p class="text-xs text-slate-500">{{ $ticket->assignee->email }}</p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3 text-slate-500">
                            <div class="w-10 h-10 rounded-full bg-slate-800/50 flex items-center justify-center border border-slate-700/50 border-dashed">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                            <span class="text-sm italic">No one assigned</span>
                        </div>
                    @endif
                </div>

                <!-- Tags Card -->
                <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-5 shadow-sm">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Tags</h3>
                    
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($ticket->tags as $tag)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                {{ $tag->name }}
                                <form action="{{ route('tickets.tags.destroy', [$team, $ticket, $tag]) }}" method="POST" class="inline-flex ml-1.5">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-blue-400 hover:text-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 18 12"/></svg>
                                    </button>
                                </form>
                            </span>
                        @endforeach
                    </div>

                    @php
                        // Get tags that are in the team but not in the ticket
                        // We use the 'tags' relationship on team (N+1 is acceptable for single view or rely on eager loading if added)
                        // Using a simple filter here
                        $existingTagIds = $ticket->tags->pluck('id')->toArray();
                        $availableTags = $team->tags->filter(fn($tag) => !in_array($tag->id, $existingTagIds));
                    @endphp

                    @if($availableTags->isNotEmpty())
                        <div class="mb-3">
                            <p class="text-[10px] uppercase font-bold text-slate-500 mb-2">Suggested</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($availableTags as $tag)
                                    <form action="{{ route('tickets.tags.store', [$team, $ticket]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="name" value="{{ $tag->name }}">
                                        <button type="submit" class="px-2 py-1 text-xs rounded-md bg-slate-800 text-slate-400 border border-slate-700 hover:bg-slate-700 hover:text-slate-200 transition-colors">
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
                            placeholder="Add tag..." 
                            class="flex-1 bg-slate-950 border border-slate-700 text-white text-xs rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 placeholder:text-slate-600 transition-all"
                            required
                        >
                        <button type="submit" class="bg-slate-800 hover:bg-slate-700 text-slate-300 border border-slate-700 rounded-lg px-3 py-2 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        </button>
                    </form>
                </div>

                <!-- Actions -->
                <div class="flex flex-col gap-3">
                    <a href="{{ route('tickets.edit', [$team, $ticket]) }}" class="w-full inline-flex justify-center items-center gap-2 px-4 py-2.5 text-sm font-medium text-slate-300 bg-slate-800 hover:bg-slate-700 border border-slate-700 rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                        Edit Ticket
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>