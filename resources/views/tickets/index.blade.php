<x-layouts.app title="Tickets Board - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h2 class="text-4xl font-extrabold tracking-tight text-white mb-2">Ticket Board</h2>
            <p class="text-slate-400 text-lg">Organize work and track progress across your workflow.</p>
        </div>
        <x-blue-button href="{{ route('tickets.create', $team) }}" class="rounded-full px-6 py-3 shadow-lg shadow-blue-600/20">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus mr-2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Open New Ticket
        </x-blue-button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-start">
        <!-- Open Column -->
        <div class="flex flex-col bg-slate-900/40 border border-slate-800 rounded-3xl overflow-hidden shadow-inner">
            <div class="p-5 border-b border-slate-800 flex items-center justify-between relative">
                <div class="absolute top-0 left-0 right-0 h-1 bg-blue-500/50"></div>
                <div class="flex items-center gap-2.5">
                    <div class="w-2 h-2 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.5)]"></div>
                    <h3 class="font-bold text-white uppercase tracking-widest text-xs">Open</h3>
                </div>
                <span id="count-open" class="text-[10px] font-black text-blue-400 bg-blue-500/10 px-2 py-0.5 rounded-full border border-blue-500/20">
                    {{ $tickets->where('status', \App\Enums\TicketStatus::OPEN)->count() }}
                </span>
            </div>
            <div class="p-3 space-y-3 min-h-[600px] transition-all" id="open">
                @foreach($tickets->where('status', \App\Enums\TicketStatus::OPEN) as $ticket)
                    <x-kanban-card :ticket="$ticket" :team="$team" />
                @endforeach
            </div>
        </div>

        <!-- In Progress Column -->
        <div class="flex flex-col bg-slate-900/40 border border-slate-800 rounded-3xl overflow-hidden shadow-inner">
            <div class="p-5 border-b border-slate-800 flex items-center justify-between relative">
                <div class="absolute top-0 left-0 right-0 h-1 bg-purple-500/50"></div>
                <div class="flex items-center gap-2.5">
                    <div class="w-2 h-2 rounded-full bg-purple-500 shadow-[0_0_8px_rgba(168,85,247,0.5)]"></div>
                    <h3 class="font-bold text-white uppercase tracking-widest text-xs">Active</h3>
                </div>
                <span id="count-in_progress" class="text-[10px] font-black text-purple-400 bg-purple-500/10 px-2 py-0.5 rounded-full border border-purple-500/20">
                    {{ $tickets->where('status', \App\Enums\TicketStatus::IN_PROGRESS)->count() }}
                </span>
            </div>
            <div class="p-3 space-y-3 min-h-[600px] transition-all" id="in_progress">
                @foreach($tickets->where('status', \App\Enums\TicketStatus::IN_PROGRESS) as $ticket)
                    <x-kanban-card :ticket="$ticket" :team="$team" />
                @endforeach
            </div>
        </div>

        <!-- Waiting Column -->
        <div class="flex flex-col bg-slate-900/40 border border-slate-800 rounded-3xl overflow-hidden shadow-inner">
            <div class="p-5 border-b border-slate-800 flex items-center justify-between relative">
                <div class="absolute top-0 left-0 right-0 h-1 bg-orange-500/50"></div>
                <div class="flex items-center gap-2.5">
                    <div class="w-2 h-2 rounded-full bg-orange-500 shadow-[0_0_8px_rgba(249,115,22,0.5)]"></div>
                    <h3 class="font-bold text-white uppercase tracking-widest text-xs">Waiting</h3>
                </div>
                <span id="count-waiting" class="text-[10px] font-black text-orange-400 bg-orange-500/10 px-2 py-0.5 rounded-full border border-orange-500/20">
                    {{ $tickets->where('status', \App\Enums\TicketStatus::WAITING)->count() }}
                </span>
            </div>
            <div class="p-3 space-y-3 min-h-[600px] transition-all" id="waiting">
                @foreach($tickets->where('status', \App\Enums\TicketStatus::WAITING) as $ticket)
                    <x-kanban-card :ticket="$ticket" :team="$team" />
                @endforeach
            </div>
        </div>

        <!-- Solved Column -->
        <div class="flex flex-col bg-slate-900/40 border border-slate-800 rounded-3xl overflow-hidden shadow-inner">
            <div class="p-5 border-b border-slate-800 flex items-center justify-between relative">
                <div class="absolute top-0 left-0 right-0 h-1 bg-green-500/50"></div>
                <div class="flex items-center gap-2.5">
                    <div class="w-2 h-2 rounded-full bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.5)]"></div>
                    <h3 class="font-bold text-white uppercase tracking-widest text-xs">Solved</h3>
                </div>
                <span id="count-closed" class="text-[10px] font-black text-green-400 bg-green-500/10 px-2 py-0.5 rounded-full border border-green-500/20">
                    {{ $tickets->where('status', \App\Enums\TicketStatus::CLOSED)->count() }}
                </span>
            </div>
            <div class="p-3 space-y-3 min-h-[600px] transition-all" id="closed">
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
                        col.parentElement.classList.remove('border-blue-500/50', 'bg-blue-500/5');
                    });
                });
            });

            columns.forEach(column => {
                column.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    e.dataTransfer.dropEffect = 'move';
                    column.parentElement.classList.add('border-blue-500/50', 'bg-blue-500/5');
                });

                column.addEventListener('dragleave', () => {
                    column.parentElement.classList.remove('border-blue-500/50', 'bg-blue-500/5');
                });

                column.addEventListener('drop', (e) => {
                    e.preventDefault();
                    column.parentElement.classList.remove('border-blue-500/50', 'bg-blue-500/5');

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