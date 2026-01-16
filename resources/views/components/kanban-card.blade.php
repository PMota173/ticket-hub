@props(['ticket'])

<div draggable="true" class="bg-slate-900/50 border border-slate-700 rounded-lg p-4 mb-3 hover:border-slate-500 cursor-grab active:cursor-grabbing shadow-sm transition-all group flex gap-3">
    <!-- Move Indicator -->
    <div class="flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-grip-vertical w-4 h-4 text-gray-500 flex-shrink-0"><circle cx="9" cy="12" r="1"></circle><circle cx="9" cy="5" r="1"></circle><circle cx="9" cy="19" r="1"></circle><circle cx="15" cy="12" r="1"></circle><circle cx="15" cy="5" r="1"></circle><circle cx="15" cy="19" r="1"></circle></svg>
    </div>

    <div class="flex-1 min-w-0">
        <div class="flex justify-between items-start mb-2">
            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                @if($ticket->priority === 'high') bg-red-500/10 text-red-400
                @elseif($ticket->priority === 'medium') bg-yellow-500/10 text-yellow-400
                @else bg-green-500/10 text-green-400
                @endif">
                {{ ucfirst($ticket->priority) }}
            </span>
            <button class="text-slate-500 hover:text-white opacity-0 group-hover:opacity-100 transition-opacity">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-more-horizontal"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
            </button>
        </div>
        <h4 class="text-white font-medium text-sm mb-1 leading-tight truncate">{{ $ticket->title }}</h4>
        <p class="text-slate-400 text-xs line-clamp-2 mb-3">{{ $ticket->description }}</p>
        <div class="flex items-center justify-between text-xs text-slate-500">
            <div class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                <span>{{ $ticket->created_at->format('M d') }}</span>
            </div>
        </div>
    </div>
</div>