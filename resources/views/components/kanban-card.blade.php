@props(['ticket', 'team'])

<div 
    id="ticket-{{ $ticket->id }}"
    data-id="{{ $ticket->id }}"
    draggable="true" 
    class="bg-surface-1 border border-border rounded-[6px] p-4 hover:border-border-light hover:bg-surface-2 cursor-grab active:cursor-grabbing transition-all duration-150 hover:-translate-y-[1px] group draggable-card"
>
    <div class="flex justify-between items-start mb-3">
        <div class="flex items-center gap-2">
            <div class="flex-shrink-0">
                @if($ticket->priority->value === 'high' || $ticket->priority->value === 'urgent')
                    <div class="w-1.5 h-3.5 bg-danger rounded-full"></div>
                @elseif($ticket->priority->value === 'medium')
                    <div class="w-1.5 h-3.5 bg-warning rounded-full"></div>
                @else
                    <div class="w-1.5 h-3.5 bg-success rounded-full"></div>
                @endif
            </div>
            <span class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">#{{ $ticket->id }}</span>
        </div>

        <div class="relative">
            <button onclick="toggleDropdown('dropdown-{{ $ticket->id }}')" class="text-text-secondary hover:text-text-primary transition-colors p-1 rounded-[4px] hover:bg-surface-3 opacity-0 group-hover:opacity-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
            </button>
            
            <!-- Dropdown Menu -->
            <div id="dropdown-{{ $ticket->id }}" class="hidden absolute right-0 mt-1 w-40 bg-surface-3 border border-border rounded-[6px] shadow-lg z-50 overflow-hidden">
                <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="flex items-center gap-2 px-3 py-2 text-[11px] font-mono uppercase tracking-[0.08em] text-text-primary hover:bg-surface-2 hover:text-accent transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                    Details
                </a>
                <a href="{{ route('tickets.edit', [$team, $ticket]) }}" class="flex items-center gap-2 px-3 py-2 text-[11px] font-mono uppercase tracking-[0.08em] text-text-primary hover:bg-surface-2 transition-colors border-t border-border">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                    Edit
                </a>
                <button 
                    onclick="openModal('delete-ticket-modal', '{{ route('tickets.destroy', [$team, $ticket]) }}')" 
                    class="flex items-center gap-2 w-full text-left px-3 py-2 text-[11px] font-mono uppercase tracking-[0.08em] text-danger hover:bg-danger/10 transition-colors border-t border-border"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Archive
                </button>
            </div>
        </div>
    </div>

    <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="block group/content">
        <h4 class="text-text-primary font-medium text-[13px] mb-2 leading-snug group-hover/content:text-accent transition-colors">{{ $ticket->title }}</h4>
        <p class="text-text-secondary text-[12px] line-clamp-2 mb-4 leading-relaxed">{{ $ticket->description }}</p>
    </a>

    <div class="flex items-center justify-between pt-3 border-t border-border">
        <div class="flex items-center gap-1.5">
            <div class="w-5 h-5 rounded-[4px] bg-surface-2 border border-border flex items-center justify-center overflow-hidden">
                @if($ticket->author?->avatar_path)
                    <img src="{{ asset('storage/' . $ticket->author->avatar_path) }}" alt="{{ $ticket->author->name }}" class="w-full h-full object-cover">
                @else
                    <span class="text-[9px] font-mono text-text-secondary uppercase">{{ substr($ticket->author?->name ?? '?', 0, 1) }}</span>
                @endif
            </div>
            <span class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em] truncate max-w-[80px]">
                {{ $ticket->author?->name ?? 'Unknown' }}
            </span>
        </div>
        
        <div class="flex items-center gap-2">
            @if($ticket->assignee)
                <div class="w-5 h-5 rounded-[4px] bg-surface-2 border border-border flex items-center justify-center" title="Assigned to {{ $ticket->assignee->name }}">
                    @if($ticket->assignee->avatar_path)
                        <img src="{{ asset('storage/' . $ticket->assignee->avatar_path) }}" alt="{{ $ticket->assignee->name }}" class="w-full h-full rounded-[4px] object-cover">
                    @else
                        <span class="text-[9px] font-mono text-text-secondary uppercase">{{ substr($ticket->assignee->name, 0, 1) }}</span>
                    @endif
                </div>
            @endif
            <div class="flex items-center gap-1 px-1.5 py-0.5 bg-bg rounded-[4px] border border-border">
                <span class="text-[9px] font-mono text-text-secondary uppercase tracking-[0.08em]">{{ $ticket->created_at->format('M d') }}</span>
            </div>
        </div>
    </div>
</div>
