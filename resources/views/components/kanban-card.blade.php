@props(['ticket', 'team'])

<div 
    id="ticket-{{ $ticket->id }}"
    data-id="{{ $ticket->id }}"
    draggable="true" 
    class="bg-surface-1 border border-border rounded-none p-4 hover:border-text-primary hover:bg-bg cursor-grab active:cursor-grabbing transition-colors duration-150 group draggable-card relative"
>
    <!-- Priority Border Indicator -->
    @if($ticket->priority->value === 'high' || $ticket->priority->value === 'urgent')
        <div class="absolute left-0 top-0 bottom-0 w-1 bg-danger"></div>
    @elseif($ticket->priority->value === 'medium')
        <div class="absolute left-0 top-0 bottom-0 w-1 bg-warning"></div>
    @else
        <div class="absolute left-0 top-0 bottom-0 w-1 bg-success"></div>
    @endif

    <div class="flex justify-between items-start mb-3 pl-2">
        <div class="flex items-center gap-2">
            <span class="text-xs font-mono text-text-muted uppercase tracking-widest">tkt-{{ $ticket->id }}</span>
        </div>

        <div class="relative">
            <button onclick="toggleDropdown('dropdown-{{ $ticket->id }}')" class="text-text-muted hover:text-text-primary transition-colors p-1 rounded-none hover:bg-surface-2 opacity-0 group-hover:opacity-100 border border-transparent hover:border-border">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
            </button>
            
            <!-- Dropdown Menu -->
            <div id="dropdown-{{ $ticket->id }}" class="hidden absolute right-0 mt-1 w-40 bg-surface-2 border border-border rounded-none shadow-none z-50 overflow-hidden font-mono">
                <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="flex items-center gap-2 px-4 py-2 text-[10px] uppercase tracking-widest text-text-primary hover:bg-surface-3 transition-colors">
                    view_
                </a>
                <a href="{{ route('tickets.edit', [$team, $ticket]) }}" class="flex items-center gap-2 px-4 py-2 text-[10px] uppercase tracking-widest text-text-primary hover:bg-surface-3 transition-colors border-t border-border">
                    edit_
                </a>
                <button 
                    onclick="openModal('delete-ticket-modal', '{{ route('tickets.destroy', [$team, $ticket]) }}')" 
                    class="flex items-center gap-2 w-full text-left px-4 py-2 text-[10px] uppercase tracking-widest text-danger hover:bg-danger/10 transition-colors border-t border-border"
                >
                    archive_
                </button>
            </div>
        </div>
    </div>

    <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="block group/content pl-2">
        <h4 class="text-text-primary font-semibold text-sm mb-2 leading-snug group-hover/content:text-accent transition-colors font-sans">{{ $ticket->title }}</h4>
        <p class="text-text-secondary text-xs line-clamp-2 mb-4 leading-relaxed font-sans">{{ $ticket->description }}</p>
    </a>

    <div class="flex items-center justify-between pt-3 border-t border-border mt-2 pl-2">
        <div class="flex items-center gap-2">
            <div class="w-5 h-5 rounded-none bg-surface-2 border border-border flex items-center justify-center overflow-hidden">
                @if($ticket->author?->avatar_path)
                    <img src="{{ asset('storage/' . $ticket->author->avatar_path) }}" alt="{{ $ticket->author->name }}" class="w-full h-full object-cover">
                @else
                    <span class="text-[9px] font-mono text-text-secondary uppercase">{{ substr($ticket->author?->name ?? '?', 0, 1) }}</span>
                @endif
            </div>
            <span class="text-[10px] font-mono text-text-muted uppercase tracking-widest truncate max-w-[80px]">
                {{ $ticket->author?->name ?? 'Unknown' }}
            </span>
        </div>
        
        <div class="flex items-center gap-2">
            @if($ticket->assignee)
                <div class="w-5 h-5 rounded-none bg-surface-2 border border-border flex items-center justify-center" title="Assigned to {{ $ticket->assignee->name }}">
                    @if($ticket->assignee->avatar_path)
                        <img src="{{ asset('storage/' . $ticket->assignee->avatar_path) }}" alt="{{ $ticket->assignee->name }}" class="w-full h-full rounded-none object-cover">
                    @else
                        <span class="text-[9px] font-mono text-text-secondary uppercase">{{ substr($ticket->assignee->name, 0, 1) }}</span>
                    @endif
                </div>
            @endif
            <div class="flex items-center gap-1 px-2 py-1 bg-surface-1 rounded-none border border-border">
                <span class="text-[9px] font-mono text-text-secondary uppercase tracking-widest">{{ $ticket->created_at->format('M d') }}</span>
            </div>
        </div>
    </div>
</div>