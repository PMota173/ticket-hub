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
                        <span>Opened by <span class="text-white">{{ $ticket->user->name }}</span></span>
                        <span>&bull;</span>
                        <span>{{ $ticket->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <!-- Description Card -->
                <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-6 shadow-sm">
                    <h3 class="text-sm font-medium text-slate-500 uppercase tracking-wider mb-4">Description</h3>
                    <div class="prose prose-invert max-w-none text-slate-300 leading-relaxed whitespace-pre-wrap">{{ $ticket->description }}</div>
                </div>

                <!-- Future: Comments Section will go here -->
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
                            <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 font-bold border border-slate-700">
                                {{ substr($ticket->assignee->name, 0, 1) }}
                            </div>
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