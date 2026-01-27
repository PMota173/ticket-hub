@props(['ticket', 'team'])

<div 
    id="ticket-{{ $ticket->id }}"
    data-id="{{ $ticket->id }}"
    draggable="true" 
    class="bg-slate-900 border border-slate-800 rounded-2xl p-4 hover:border-blue-500/40 hover:bg-slate-850 cursor-grab active:cursor-grabbing shadow-lg hover:shadow-blue-500/10 transition-all duration-300 group draggable-card"
>
    <div class="flex justify-between items-start mb-3">
        <div class="flex items-center gap-2">
            <div class="flex-shrink-0">
                @if($ticket->priority->value === 'high' || $ticket->priority->value === 'urgent')
                    <div class="w-1.5 h-4 bg-red-500 rounded-full shadow-[0_0_8px_rgba(239,68,68,0.4)]"></div>
                @elseif($ticket->priority->value === 'medium')
                    <div class="w-1.5 h-4 bg-orange-500 rounded-full shadow-[0_0_8px_rgba(249,115,22,0.4)]"></div>
                @else
                    <div class="w-1.5 h-4 bg-green-500 rounded-full shadow-[0_0_8px_rgba(34,197,94,0.4)]"></div>
                @endif
            </div>
            <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">#{{ $ticket->id }}</span>
        </div>

        <div class="relative">
            <button onclick="toggleDropdown('dropdown-{{ $ticket->id }}')" class="text-slate-600 hover:text-white transition-colors p-1.5 rounded-lg hover:bg-slate-800 group-hover:opacity-100 opacity-0 transition-opacity">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-more-horizontal"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
            </button>
            
            <!-- Dropdown Menu -->
            <div id="dropdown-{{ $ticket->id }}" class="hidden absolute right-0 mt-2 w-40 bg-slate-900 border border-slate-800 rounded-xl shadow-2xl z-50 overflow-hidden backdrop-blur-xl bg-slate-900/90">
                <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold text-slate-300 hover:bg-blue-600 hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                    Full Details
                </a>
                <a href="{{ route('tickets.edit', [$team, $ticket]) }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold text-slate-300 hover:bg-slate-800 transition-all border-t border-slate-800">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                    Edit Ticket
                </a>
                <button 
                    onclick="openModal('delete-ticket-modal', '{{ route('tickets.destroy', [$team, $ticket]) }}')" 
                    class="flex items-center gap-2 w-full text-left px-4 py-2.5 text-xs font-bold text-red-400 hover:bg-red-500/10 transition-all border-t border-slate-800"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Archive
                </button>
            </div>
        </div>
    </div>

    <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="block group/content">
        <h4 class="text-white font-bold text-sm mb-2 leading-snug group-hover/content:text-blue-400 transition-colors">{{ $ticket->title }}</h4>
        <p class="text-slate-400 text-xs line-clamp-2 mb-4 leading-relaxed opacity-80 group-hover:opacity-100">{{ $ticket->description }}</p>
    </a>

    <div class="flex items-center justify-between pt-4 border-t border-slate-800/50">
        <div class="flex items-center gap-1.5">
            <div class="w-6 h-6 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center overflow-hidden">
                @if($ticket->author?->avatar_path)
                    <img src="{{ asset('storage/' . $ticket->author->avatar_path) }}" alt="{{ $ticket->author->name }}" class="w-full h-full object-cover">
                @else
                    <span class="text-[8px] font-black text-slate-500 uppercase">{{ substr($ticket->author?->name ?? '?', 0, 1) }}</span>
                @endif
            </div>
            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-tight truncate max-w-[80px]">
                {{ $ticket->author?->name ?? 'Unknown' }}
            </span>
        </div>
        
        <div class="flex items-center gap-2">
            @if($ticket->assignee)
                <div class="w-6 h-6 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center" title="Assigned to {{ $ticket->assignee->name }}">
                    @if($ticket->assignee->avatar_path)
                        <img src="{{ asset('storage/' . $ticket->assignee->avatar_path) }}" alt="{{ $ticket->assignee->name }}" class="w-full h-full rounded-lg object-cover">
                    @else
                        <span class="text-[8px] font-black text-blue-400 uppercase">{{ substr($ticket->assignee->name, 0, 1) }}</span>
                    @endif
                </div>
            @endif
            <div class="flex items-center gap-1 px-2 py-1 bg-slate-950 rounded-full border border-slate-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-slate-600"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                <span class="text-[10px] font-black text-slate-500">{{ $ticket->created_at->format('M d') }}</span>
            </div>
        </div>
    </div>
</div>
