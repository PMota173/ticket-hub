<x-layouts.app title="Inbox - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
        <div>
            <div class="flex items-center gap-2 text-[11px] font-mono font-medium text-text-muted uppercase tracking-[0.08em] mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" class="text-text-secondary"><path d="M22 13V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h8"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/><path d="M19 16v6"/><path d="M22 19h-6"/></svg>
                <span>Triage</span>
            </div>
            <h1 class="text-3xl font-display font-medium tracking-tight text-text-primary mb-2">Inbox</h1>
            <p class="text-text-secondary text-sm font-sans">Review incoming tickets before moving them to the active board.</p>
        </div>
        <x-blue-button href="{{ route('tickets.create', $team) }}" class="w-full md:w-auto">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" class="mr-1.5"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Open New Ticket
        </x-blue-button>
    </div>

    <!-- Inbox List -->
    <div class="bg-surface-1 border border-border rounded-none overflow-hidden opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
        <div class="px-6 py-3 border-b border-border bg-surface-2 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <h3 class="font-mono text-xs font-semibold text-text-primary uppercase tracking-widest">pending_triage_</h3>
                <span class="text-[10px] font-mono text-text-secondary bg-bg px-2 py-0.5 border border-border">
                    {{ $tickets->count() }}
                </span>
            </div>
        </div>

        @if($tickets->isEmpty())
            <div class="p-16 text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-none bg-surface-2 mb-4 border border-border">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" class="text-success">
                        <path d="M20 6 9 17l-5-5"/>
                    </svg>
                </div>
                <h3 class="text-[15px] font-medium text-text-primary mb-1">Inbox Zero</h3>
                <p class="text-text-secondary text-[13px] max-w-sm mx-auto mb-6">There are no new tickets waiting for triage.</p>
            </div>
        @else
            <div class="divide-y divide-border">
                @foreach($tickets as $ticket)
                    <div class="p-4 sm:p-6 hover:bg-surface-2/50 transition-colors duration-150 group flex flex-col sm:flex-row sm:items-center gap-4 justify-between">
                        <!-- Left Info -->
                        <div class="flex items-start gap-4 min-w-0">
                            <div class="flex-shrink-0 mt-1">
                                <x-ticket-priority-badge :priority="$ticket->priority" />
                            </div>
                            <div class="min-w-0">
                                <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="block mb-1 group-hover:text-accent transition-colors">
                                    <h4 class="text-sm font-semibold text-text-primary truncate font-sans">{{ $ticket->title }}</h4>
                                </a>
                                <p class="text-xs text-text-secondary font-sans line-clamp-1 mb-2">{{ $ticket->description }}</p>
                                
                                <div class="flex items-center gap-3 text-[10px] font-mono text-text-muted uppercase tracking-widest">
                                    <span class="text-text-primary">tkt-{{ $ticket->id }}</span>
                                    <span>&bull;</span>
                                    <span class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        {{ $ticket->created_at->diffForHumans() }}
                                    </span>
                                    @if($ticket->author)
                                        <span>&bull;</span>
                                        <span class="truncate max-w-[120px]">By {{ $ticket->author->name }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Right Actions -->
                        <div class="flex items-center gap-3 sm:flex-shrink-0">
                            <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="inline-flex items-center justify-center px-4 py-2 bg-transparent border border-border text-text-secondary hover:text-text-primary hover:border-text-secondary transition-colors text-xs font-mono font-medium">
                                View Details
                            </a>
                            
                            <form action="{{ route('tickets.update', [$team, $ticket]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="open">
                                <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-text-primary text-bg font-mono text-xs font-semibold hover:bg-text-secondary transition-transform duration-150 hover:-translate-y-0.5 border border-text-primary uppercase tracking-widest">
                                    [ Move to Board ]
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-layouts.app>