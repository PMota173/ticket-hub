<x-layouts.app title="Tickets Board - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="mb-12 flex flex-col md:flex-row md:items-center justify-between gap-6 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
        <div>
            <div class="flex items-center gap-2 text-[11px] font-mono font-medium text-text-muted uppercase tracking-[0.08em] mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                <span>Project Board</span>
            </div>
            <h1 class="text-3xl font-display font-medium tracking-tight text-text-primary mb-2">Tickets Board</h1>
            <p class="text-text-secondary text-sm">Organize work and track progress across your workflow.</p>
        </div>
        <x-blue-button href="{{ route('tickets.create', $team) }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1.5"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Open New Ticket
        </x-blue-button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-start opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
        <!-- Open Column -->
        <div class="flex flex-col bg-surface-1 border border-border rounded-[8px] overflow-hidden transition-colors duration-150">
            <div class="px-4 py-3 border-b border-border flex items-center justify-between bg-surface-2">
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-text-secondary"></div>
                    <h3 class="font-mono text-[11px] text-text-primary uppercase tracking-[0.08em]">Open</h3>
                </div>
                <span id="count-open" class="text-[10px] font-mono text-text-secondary bg-surface-3 px-2 py-0.5 rounded-[4px] border border-border">
                    {{ $tickets->where('status', \App\Enums\TicketStatus::OPEN)->count() }}
                </span>
            </div>
            <div class="p-3 space-y-3 min-h-[600px] transition-all bg-bg/50" id="open">
                @foreach($tickets->where('status', \App\Enums\TicketStatus::OPEN) as $ticket)
                    <x-kanban-card :ticket="$ticket" :team="$team" />
                @endforeach
            </div>
        </div>

        <!-- In Progress Column -->
        <div class="flex flex-col bg-surface-1 border border-border rounded-[8px] overflow-hidden transition-colors duration-150">
            <div class="px-4 py-3 border-b border-border flex items-center justify-between bg-surface-2">
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-accent"></div>
                    <h3 class="font-mono text-[11px] text-text-primary uppercase tracking-[0.08em]">Active</h3>
                </div>
                <span id="count-in_progress" class="text-[10px] font-mono text-accent bg-accent/10 px-2 py-0.5 rounded-[4px] border border-accent/20">
                    {{ $tickets->where('status', \App\Enums\TicketStatus::IN_PROGRESS)->count() }}
                </span>
            </div>
            <div class="p-3 space-y-3 min-h-[600px] transition-all bg-bg/50" id="in_progress">
                @foreach($tickets->where('status', \App\Enums\TicketStatus::IN_PROGRESS) as $ticket)
                    <x-kanban-card :ticket="$ticket" :team="$team" />
                @endforeach
            </div>
        </div>

        <!-- Waiting Column -->
        <div class="flex flex-col bg-surface-1 border border-border rounded-[8px] overflow-hidden transition-colors duration-150">
            <div class="px-4 py-3 border-b border-border flex items-center justify-between bg-surface-2">
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-warning"></div>
                    <h3 class="font-mono text-[11px] text-text-primary uppercase tracking-[0.08em]">Waiting</h3>
                </div>
                <span id="count-waiting" class="text-[10px] font-mono text-warning bg-warning/10 px-2 py-0.5 rounded-[4px] border border-warning/20">
                    {{ $tickets->where('status', \App\Enums\TicketStatus::WAITING)->count() }}
                </span>
            </div>
            <div class="p-3 space-y-3 min-h-[600px] transition-all bg-bg/50" id="waiting">
                @foreach($tickets->where('status', \App\Enums\TicketStatus::WAITING) as $ticket)
                    <x-kanban-card :ticket="$ticket" :team="$team" />
                @endforeach
            </div>
        </div>

        <!-- Solved Column -->
        <div class="flex flex-col bg-surface-1 border border-border rounded-[8px] overflow-hidden transition-colors duration-150">
            <div class="px-4 py-3 border-b border-border flex items-center justify-between bg-surface-2">
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-success"></div>
                    <h3 class="font-mono text-[11px] text-text-primary uppercase tracking-[0.08em]">Solved</h3>
                </div>
                <span id="count-closed" class="text-[10px] font-mono text-success bg-success/10 px-2 py-0.5 rounded-[4px] border border-success/20">
                    {{ $tickets->where('status', \App\Enums\TicketStatus::CLOSED)->count() }}
                </span>
            </div>
            <div class="p-3 space-y-3 min-h-[600px] transition-all bg-bg/50" id="closed">
                @foreach($tickets->where('status', \App\Enums\TicketStatus::CLOSED) as $ticket)
                    <x-kanban-card :ticket="$ticket" :team="$team" />
                @endforeach
            </div>
        </div>
    </div>

    <x-confirm-modal 
        id="delete-ticket-modal" 
        title="Archive Ticket" 
        message="Are you sure you want to delete this ticket? This action cannot be undone." 
        confirmText="Confirm Delete" 
    />

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
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

        // Close dropdowns when clicking outside
        window.onclick = function(event) {
            if (!event.target.closest('button')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                    el.classList.add('hidden');
                });
            }
        }

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
                        col.parentElement.classList.remove('border-accent', 'border-opacity-50');
                    });
                });
            });

            columns.forEach(column => {
                column.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    e.dataTransfer.dropEffect = 'move';
                    column.parentElement.classList.add('border-accent', 'border-opacity-50');
                });

                column.addEventListener('dragleave', () => {
                    column.parentElement.classList.remove('border-accent', 'border-opacity-50');
                });

                column.addEventListener('drop', (e) => {
                    e.preventDefault();
                    column.parentElement.classList.remove('border-accent', 'border-opacity-50');

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
                if (countBadge) {
                    let currentCount = parseInt(countBadge.textContent);
                    countBadge.textContent = currentCount + change;
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