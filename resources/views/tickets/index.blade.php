<x-layouts.app title="Tickets Board - {{ config('app.name', 'Ticket Hub') }}">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold tracking-tight text-white">Tickets Board</h2>
            <p class="text-slate-400 mt-2">Manage your tickets by dragging them across columns.</p>
        </div>
        <x-blue-button href="/tickets/create">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus mr-2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            New Ticket
        </x-blue-button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 overflow-x-auto pb-4 items-start">
        <!-- Open -->
        <div class="flex-shrink-0 w-80 md:w-auto bg-slate-900/30 rounded-xl border border-slate-800 p-4">
            <div class="flex items-center justify-between mb-4 px-1">
                <h3 class="font-semibold text-slate-300">Open</h3>
                <span id="count-open" class="text-sm font-bold text-blue-500 bg-blue-500/10 px-2.5 py-0.5 rounded-full border border-blue-500/20">
                    {{ $tickets->where('status', 'open')->count() }}
                </span>
            </div>
            <div class="space-y-3 min-h-[500px]" id="open">
                @foreach($tickets->where('status', 'open') as $ticket)
                    <x-kanban-card :ticket="$ticket" />
                @endforeach
            </div>
        </div>

        <!-- In Progress -->
        <div class="flex-shrink-0 w-80 md:w-auto bg-slate-900/30 rounded-xl border border-slate-800 p-4">
            <div class="flex items-center justify-between mb-4 px-1">
                <h3 class="font-semibold text-slate-300">In Progress</h3>
                <span id="count-in_progress" class="text-sm font-bold text-purple-400 bg-purple-500/10 px-2.5 py-0.5 rounded-full border border-purple-500/20">
                    {{ $tickets->where('status', 'in_progress')->count() }}
                </span>
            </div>
            <div class="space-y-3 min-h-[500px]" id="in_progress">
                @foreach($tickets->where('status', 'in_progress') as $ticket)
                    <x-kanban-card :ticket="$ticket" />
                @endforeach
            </div>
        </div>

        <!-- Waiting -->
        <div class="flex-shrink-0 w-80 md:w-auto bg-slate-900/30 rounded-xl border border-slate-800 p-4">
            <div class="flex items-center justify-between mb-4 px-1">
                <h3 class="font-semibold text-slate-300">Waiting</h3>
                <span id="count-waiting" class="text-sm font-bold text-orange-400 bg-orange-500/10 px-2.5 py-0.5 rounded-full border border-orange-500/20">
                    {{ $tickets->where('status', 'waiting')->count() }}
                </span>
            </div>
            <div class="space-y-3 min-h-[500px]" id="waiting">
                @foreach($tickets->where('status', 'waiting') as $ticket)
                    <x-kanban-card :ticket="$ticket" />
                @endforeach
            </div>
        </div>

        <!-- Solved -->
        <div class="flex-shrink-0 w-80 md:w-auto bg-slate-900/30 rounded-xl border border-slate-800 p-4">
            <div class="flex items-center justify-between mb-4 px-1">
                <h3 class="font-semibold text-slate-300">Solved</h3>
                <span id="count-closed" class="text-sm font-bold text-green-400 bg-green-500/10 px-2.5 py-0.5 rounded-full border border-green-500/20">
                    {{ $tickets->where('status', 'closed')->count() }}
                </span>
            </div>
            <div class="space-y-3 min-h-[500px]" id="closed">
                @foreach($tickets->where('status', 'closed') as $ticket)
                    <x-kanban-card :ticket="$ticket" />
                @endforeach
            </div>
        </div>
    </div>

    <x-confirm-modal 
        id="delete-ticket-modal" 
        title="Delete Ticket" 
        message="Are you sure you want to delete this ticket? This action cannot be undone." 
        confirmText="Delete Ticket" 
    />

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.draggable-card');
            const columns = document.querySelectorAll('[id="open"], [id="in_progress"], [id="waiting"], [id="closed"]');

            let draggedCard = null;

            // Add event listeners to cards
            cards.forEach(card => {
                card.addEventListener('dragstart', (e) => {
                    draggedCard = card;
                    e.dataTransfer.effectAllowed = 'move';
                    card.classList.add('opacity-50');
                });

                card.addEventListener('dragend', () => {
                    draggedCard = null;
                    card.classList.remove('opacity-50');
                    columns.forEach(col => col.classList.remove('bg-slate-800/50', 'ring-2', 'ring-blue-500/30'));
                });
            });

            // Add event listeners to columns
            columns.forEach(column => {
                column.addEventListener('dragover', (e) => {
                    e.preventDefault(); // Necessary to allow dropping
                    e.dataTransfer.dropEffect = 'move';
                    column.classList.add('bg-slate-800/50', 'ring-2', 'ring-blue-500/30');
                });

                column.addEventListener('dragleave', () => {
                    column.classList.remove('bg-slate-800/50', 'ring-2', 'ring-blue-500/30');
                });

                column.addEventListener('drop', (e) => {
                    e.preventDefault();
                    column.classList.remove('bg-slate-800/50', 'ring-2', 'ring-blue-500/30');

                    if (draggedCard) {
                        const sourceColumn = draggedCard.parentElement;
                        const targetColumn = column;
                        
                        if (sourceColumn.id === targetColumn.id) return;

                        const newStatus = targetColumn.id;
                        const oldStatus = sourceColumn.id;
                        const ticketId = draggedCard.getAttribute('data-id');
                        
                        // Optimistic UI update: Append card to new column immediately
                        targetColumn.appendChild(draggedCard);

                        // Update column counts
                        updateColumnCount(oldStatus, -1);
                        updateColumnCount(newStatus, 1);

                        // Update the status badge style (optional but nice touch)
                        updateCardStatusStyle(draggedCard, newStatus);
                        
                        // Send AJAX request to update status
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
                fetch(`/tickets/${ticketId}`, {
                    method: 'POST', // Using POST with _method PATCH
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        _method: 'PATCH',
                        status: status
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        console.error('Failed to update ticket status');
                        // In a real app, you might revert the UI change here
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }

            // Helper to add CSRF token meta tag if missing (usually in layout, but ensuring safety)
            if (!document.querySelector('meta[name="csrf-token"]')) {
                const meta = document.createElement('meta');
                meta.name = 'csrf-token';
                meta.content = '{{ csrf_token() }}';
                document.head.appendChild(meta);
            }

            function updateCardStatusStyle(card, status) {
                // This is a simplified visual update. 
                // In a perfect world, we'd regenerate the specific badge HTML,
                // but since the column defines the context, just moving it is usually enough for the user.
                // However, we can update the counter numbers if we wanted to be thorough.
                
                // For now, we'll just let the movement happen.
            }
        });
    </script>
</x-layouts.app>
