@props(['ticket', 'team'])

<div 
    id="ticket-{{ $ticket->id }}"
    data-id="{{ $ticket->id }}"
    draggable="true" 
    class="bg-slate-900/50 border border-slate-700 rounded-lg p-4 mb-3 hover:border-slate-500 cursor-grab active:cursor-grabbing shadow-sm transition-all group flex gap-3 draggable-card"
>
    <!-- Move Indicator -->
    <div class="flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-grip-vertical w-4 h-4 text-gray-500 flex-shrink-0"><circle cx="9" cy="12" r="1"></circle><circle cx="9" cy="5" r="1"></circle><circle cx="9" cy="19" r="1"></circle><circle cx="15" cy="12" r="1"></circle><circle cx="15" cy="5" r="1"></circle><circle cx="15" cy="19" r="1"></circle></svg>
    </div>

    <div class="flex-1 min-w-0">
        <div class="flex justify-between items-start mb-2">
            <x-ticket-priority-badge :priority="$ticket->priority" />
        <div class="relative">
            <button onclick="toggleDropdown('dropdown-{{ $ticket->id }}')" class="text-slate-500 hover:text-white opacity-0 group-hover:opacity-100 transition-opacity p-1 rounded hover:bg-slate-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-more-horizontal"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
            </button>
            
            <!-- Dropdown Menu -->
            <div id="dropdown-{{ $ticket->id }}" class="hidden absolute right-0 mt-2 w-32 bg-slate-900 border border-slate-700 rounded-lg shadow-xl z-50 overflow-hidden">
                <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="block px-4 py-2 text-xs text-slate-300 hover:bg-slate-800 hover:text-white transition-colors">
                    View
                </a>
                <a href="{{ route('tickets.edit', [$team, $ticket]) }}" class="block px-4 py-2 text-xs text-slate-300 hover:bg-slate-800 hover:text-white transition-colors">
                    Edit
                </a>
                <button 
                    onclick="openModal('delete-ticket-modal', '{{ route('tickets.destroy', [$team, $ticket]) }}')" 
                    class="block w-full text-left px-4 py-2 text-xs text-red-400 hover:bg-slate-800 hover:text-red-300 transition-colors"
                >
                    Delete
                </button>
            </div>
        </div>
    </div>
    <h4 class="text-white font-medium text-sm mb-1 leading-tight truncate">{{ $ticket->title }}</h4>
        <p class="text-slate-400 text-xs line-clamp-2 mb-3">{{ $ticket->description }}</p>
        <div class="flex items-center justify-between text-xs text-slate-500">
            <div class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                <span>{{ $ticket->created_at->format('M d') }}</span>
            </div>
            
            @if($ticket->assignee)
                <div class="flex items-center gap-1.5" title="Assigned to {{ $ticket->assignee->name }}">
                    <div class="w-5 h-5 rounded-full bg-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-300 border border-slate-600">
                        {{ substr($ticket->assignee->name, 0, 1) }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>