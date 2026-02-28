<x-layouts.app title="Tickets Board - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="mb-12 flex flex-col md:flex-row md:items-center justify-between gap-6 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
        <div>
            <div class="flex items-center gap-2 text-[11px] font-mono font-medium text-text-muted uppercase tracking-[0.08em] mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" class="text-text-secondary"><rect width="18" height="18" x="3" y="3"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                <span>Project Board</span>
            </div>
            <h1 class="text-3xl font-display font-medium tracking-tight text-text-primary mb-2">Tickets Board</h1>
            <p class="text-text-secondary text-sm">Organize work and track progress across your workflow.</p>
        </div>
        <div class="flex flex-col md:flex-row items-center gap-3 w-full md:w-auto">
            <a href="{{ route('tickets.inbox', $team) }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-xs font-mono font-medium text-text-secondary transition-all duration-150 bg-surface-1 border border-border hover:border-text-secondary hover:text-text-primary w-full md:w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"><path d="M22 13V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h8"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/><path d="M19 16v6"/><path d="M22 19h-6"/></svg>
                [ View Inbox ]
            </a>
            <x-blue-button href="{{ route('tickets.create', $team) }}" class="w-full md:w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" class="mr-1.5"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Open New Ticket
            </x-blue-button>
        </div>
    </div>

    <!-- Mobile Tab Navigation -->
    <div class="md:hidden flex overflow-x-auto border-b border-border mb-6 no-scrollbar snap-x font-mono text-xs">
        <button onclick="switchMobileTab('open')" id="tab-open" class="snap-start whitespace-nowrap px-4 py-3 border-b-2 border-text-primary text-text-primary uppercase tracking-widest font-semibold transition-colors flex items-center gap-2">
            Open <span id="tab-count-open" class="text-[10px] bg-surface-2 px-1.5 py-0.5">{{ $tickets->where('status', \App\Enums\TicketStatus::OPEN)->count() }}</span>
        </button>
        <button onclick="switchMobileTab('in_progress')" id="tab-in_progress" class="snap-start whitespace-nowrap px-4 py-3 border-b-2 border-transparent text-text-secondary hover:text-text-primary uppercase tracking-widest transition-colors flex items-center gap-2">
            Active <span id="tab-count-in_progress" class="text-[10px] bg-surface-2 px-1.5 py-0.5">{{ $tickets->where('status', \App\Enums\TicketStatus::IN_PROGRESS)->count() }}</span>
        </button>
        <button onclick="switchMobileTab('waiting')" id="tab-waiting" class="snap-start whitespace-nowrap px-4 py-3 border-b-2 border-transparent text-text-secondary hover:text-text-primary uppercase tracking-widest transition-colors flex items-center gap-2">
            Waiting <span id="tab-count-waiting" class="text-[10px] bg-surface-2 px-1.5 py-0.5">{{ $tickets->where('status', \App\Enums\TicketStatus::WAITING)->count() }}</span>
        </button>
        <button onclick="switchMobileTab('closed')" id="tab-closed" class="snap-start whitespace-nowrap px-4 py-3 border-b-2 border-transparent text-text-secondary hover:text-text-primary uppercase tracking-widest transition-colors flex items-center gap-2">
            Solved <span id="tab-count-closed" class="text-[10px] bg-surface-2 px-1.5 py-0.5">{{ $tickets->where('status', \App\Enums\TicketStatus::CLOSED)->count() }}</span>
        </button>
    </div>

    <!-- Kanban Grid -->
    <div class="opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
        @if($tickets->isEmpty())
            <div class="bg-surface-1 border border-border border-dashed p-20 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-none bg-surface-2 mb-6 border border-border">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="miter" class="text-text-muted">
                        <rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/>
                    </svg>
                </div>
                <h2 class="text-xl font-display font-medium text-text-primary mb-2">Board is empty</h2>
                <p class="text-text-secondary text-sm max-w-sm mx-auto mb-8 font-sans">No tickets have been moved to the active board yet. Check the Triage Inbox for incoming requests.</p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('tickets.inbox', $team) }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-surface-2 border border-border text-text-primary font-mono text-sm hover:bg-surface-3 transition-colors">
                        [ Open Triage ]
                    </a>
                    <x-blue-button href="{{ route('tickets.create', $team) }}">
                        Create Ticket
                    </x-blue-button>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-start">
                <!-- Open Column -->
                <div id="col-open" class="flex flex-col bg-surface-1 border border-border rounded-none overflow-hidden transition-colors duration-150 relative">
                    <div class="absolute top-0 left-0 right-0 h-0.5 bg-text-secondary"></div>
                    <div class="px-4 py-3 border-b border-border flex items-center justify-between bg-surface-2">
                        <div class="flex items-center gap-2">
                            <h3 class="font-mono text-xs font-semibold text-text-primary uppercase tracking-widest">open_</h3>
                        </div>
                        <span id="count-open" class="text-[10px] font-mono text-text-secondary bg-bg px-2 py-0.5 border border-border">
                            {{ $tickets->where('status', \App\Enums\TicketStatus::OPEN)->count() }}
                        </span>
                    </div>
                    <div class="p-3 space-y-3 min-h-[200px] md:min-h-[600px] transition-all bg-bg" id="open">
                        @foreach($tickets->where('status', \App\Enums\TicketStatus::OPEN) as $ticket)
                            <x-kanban-card :ticket="$ticket" :team="$team" />
                        @endforeach
                    </div>
                </div>

                <!-- In Progress Column -->
                <div id="col-in_progress" class="hidden md:flex flex-col bg-surface-1 border border-border rounded-none overflow-hidden transition-colors duration-150 relative">
                    <div class="absolute top-0 left-0 right-0 h-0.5 bg-accent"></div>
                    <div class="px-4 py-3 border-b border-border flex items-center justify-between bg-surface-2">
                        <div class="flex items-center gap-2">
                            <h3 class="font-mono text-xs font-semibold text-text-primary uppercase tracking-widest">active_</h3>
                        </div>
                        <span id="count-in_progress" class="text-[10px] font-mono text-accent bg-bg px-2 py-0.5 border border-border">
                            {{ $tickets->where('status', \App\Enums\TicketStatus::IN_PROGRESS)->count() }}
                        </span>
                    </div>
                    <div class="p-3 space-y-3 min-h-[200px] md:min-h-[600px] transition-all bg-bg" id="in_progress">
                        @foreach($tickets->where('status', \App\Enums\TicketStatus::IN_PROGRESS) as $ticket)
                            <x-kanban-card :ticket="$ticket" :team="$team" />
                        @endforeach
                    </div>
                </div>

                <!-- Waiting Column -->
                <div id="col-waiting" class="hidden md:flex flex-col bg-surface-1 border border-border rounded-none overflow-hidden transition-colors duration-150 relative">
                    <div class="absolute top-0 left-0 right-0 h-0.5 bg-warning"></div>
                    <div class="px-4 py-3 border-b border-border flex items-center justify-between bg-surface-2">
                        <div class="flex items-center gap-2">
                            <h3 class="font-mono text-xs font-semibold text-text-primary uppercase tracking-widest">waiting_</h3>
                        </div>
                        <span id="count-waiting" class="text-[10px] font-mono text-warning bg-bg px-2 py-0.5 border border-border">
                            {{ $tickets->where('status', \App\Enums\TicketStatus::WAITING)->count() }}
                        </span>
                    </div>
                    <div class="p-3 space-y-3 min-h-[200px] md:min-h-[600px] transition-all bg-bg" id="waiting">
                        @foreach($tickets->where('status', \App\Enums\TicketStatus::WAITING) as $ticket)
                            <x-kanban-card :ticket="$ticket" :team="$team" />
                        @endforeach
                    </div>
                </div>

                <!-- Solved Column -->
                <div id="col-closed" class="hidden md:flex flex-col bg-surface-1 border border-border rounded-none overflow-hidden transition-colors duration-150 relative">
                    <div class="absolute top-0 left-0 right-0 h-0.5 bg-success"></div>
                    <div class="px-4 py-3 border-b border-border flex items-center justify-between bg-surface-2">
                        <div class="flex items-center gap-2">
                            <h3 class="font-mono text-xs font-semibold text-text-primary uppercase tracking-widest">solved_</h3>
                        </div>
                        <span id="count-closed" class="text-[10px] font-mono text-success bg-bg px-2 py-0.5 border border-border">
                            {{ $tickets->where('status', \App\Enums\TicketStatus::CLOSED)->count() }}
                        </span>
                    </div>
                    <div class="p-3 space-y-3 min-h-[200px] md:min-h-[600px] transition-all bg-bg" id="closed">
                        @foreach($tickets->where('status', \App\Enums\TicketStatus::CLOSED) as $ticket)
                            <x-kanban-card :ticket="$ticket" :team="$team" />
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    <x-confirm-modal 
        id="delete-ticket-modal" 
        title="Archive Ticket" 
        message="Are you sure you want to archive this ticket? It will be removed from the active board." 
        confirmText="Confirm Archive" 
    />

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                if (el.id !== id) el.classList.add('hidden');
            });
            dropdown.classList.toggle('hidden');
        }

        window.onclick = function(event) {
            if (!event.target.closest('button')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                    el.classList.add('hidden');
                });
            }
        }

        // Mobile Tab Switching Logic
        function switchMobileTab(status) {
            if (window.innerWidth >= 768) return; // Only active on mobile

            const columns = ['open', 'in_progress', 'waiting', 'closed'];
            
            columns.forEach(col => {
                const columnEl = document.getElementById('col-' + col);
                const tabEl = document.getElementById('tab-' + col);
                
                if (col === status) {
                    columnEl.classList.remove('hidden');
                    columnEl.classList.add('flex');
                    tabEl.classList.replace('border-transparent', 'border-text-primary');
                    tabEl.classList.replace('text-text-secondary', 'text-text-primary');
                    tabEl.classList.add('font-semibold');
                } else {
                    columnEl.classList.add('hidden');
                    columnEl.classList.remove('flex');
                    tabEl.classList.replace('border-text-primary', 'border-transparent');
                    tabEl.classList.replace('text-text-primary', 'text-text-secondary');
                    tabEl.classList.remove('font-semibold');
                }
            });
        }

        // Handle window resize to reset display states
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                // Show all columns on desktop
                ['open', 'in_progress', 'waiting', 'closed'].forEach(col => {
                    const columnEl = document.getElementById('col-' + col);
                    columnEl.classList.remove('hidden');
                    columnEl.classList.add('flex');
                });
            } else {
                // On resize to mobile, default to "open" tab
                switchMobileTab('open');
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.draggable-card');
            const columns = document.querySelectorAll('[id="open"], [id="in_progress"], [id="waiting"], [id="closed"]');

            let draggedCard = null;

            cards.forEach(card => {
                card.addEventListener('dragstart', (e) => {
                    draggedCard = card;
                    e.dataTransfer.effectAllowed = 'move';
                    card.classList.add('opacity-40', 'scale-95');
                });

                card.addEventListener('dragend', () => {
                    draggedCard = null;
                    card.classList.remove('opacity-40', 'scale-95');
                    columns.forEach(col => {
                        col.parentElement.classList.remove('border-text-primary');
                    });
                });
            });

            columns.forEach(column => {
                column.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    e.dataTransfer.dropEffect = 'move';
                    column.parentElement.classList.add('border-text-primary');
                });

                column.addEventListener('dragleave', () => {
                    column.parentElement.classList.remove('border-text-primary');
                });

                column.addEventListener('drop', (e) => {
                    e.preventDefault();
                    column.parentElement.classList.remove('border-text-primary');

                    if (draggedCard) {
                        const sourceColumn = draggedCard.parentElement;
                        const targetColumn = column;
                        
                        if (sourceColumn.id === targetColumn.id) return;

                        const newStatus = targetColumn.id;
                        const oldStatus = sourceColumn.id;
                        const ticketId = draggedCard.getAttribute('data-id');
                        
                        targetColumn.appendChild(draggedCard);

                        updateColumnCount(oldStatus, -1);
                        updateColumnCount(newStatus, 1);
                        updateTicketStatus(ticketId, newStatus);
                    }
                });
            });

            function updateColumnCount(status, change) {
                const countBadge = document.getElementById(`count-${status}`);
                const mobileTabBadge = document.getElementById(`tab-count-${status}`);
                
                if (countBadge) {
                    let currentCount = parseInt(countBadge.textContent);
                    countBadge.textContent = currentCount + change;
                }
                
                if (mobileTabBadge) {
                    let currentCount = parseInt(mobileTabBadge.textContent);
                    mobileTabBadge.textContent = currentCount + change;
                }
            }

            function updateTicketStatus(ticketId, status) {
                fetch(`/teams/{{ $team->slug }}/tickets/${ticketId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        _method: 'PATCH',
                        status: status
                    })
                });
            }
        });
    </script>
</x-layouts.app>
