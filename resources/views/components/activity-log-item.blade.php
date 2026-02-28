@props(['log'])

<div class="flex items-start gap-4 relative group">
    <!-- Timeline connection line -->
    <div class="absolute left-4 top-8 bottom-[-16px] w-px bg-border group-last:hidden"></div>
    
    <div class="relative z-10 flex-shrink-0 mt-1">
        @if($log->actor && $log->actor->avatar_path)
            <img src="{{ asset('storage/' . $log->actor->avatar_path) }}" 
                 alt="{{ $log->actor->name }}" 
                 class="w-8 h-8 rounded-none object-cover border border-border bg-surface-2">
        @else
            <div class="w-8 h-8 rounded-none bg-surface-2 flex items-center justify-center text-text-secondary font-mono text-xs border border-border">
                {{ substr($log->actor->name ?? '?', 0, 1) }}
            </div>
        @endif
    </div>

    <div class="flex-grow min-w-0 bg-surface-1/50 border border-border border-dashed p-3 rounded-none text-[13px]">
        <div class="flex items-center gap-2 mb-1">
            <span class="font-medium text-text-primary">{{ $log->actor->name ?? 'System' }}</span>
            <span class="text-[10px] font-mono text-text-muted uppercase tracking-widest">{{ $log->created_at->diffForHumans() }}</span>
        </div>
        
        <div class="text-text-secondary font-sans">
            @if($log->action === 'created')
                created this ticket.
            @elseif($log->action === 'updated')
                @if($log->field === 'status')
                    changed status from 
                    <span class="font-mono text-[11px] bg-surface-2 px-1.5 py-0.5 border border-border">{{ $log->old_value }}</span> 
                    to 
                    <span class="font-mono text-[11px] bg-surface-2 px-1.5 py-0.5 border border-border text-text-primary">{{ $log->new_value }}</span>
                @elseif($log->field === 'priority')
                    changed priority from 
                    <span class="font-mono text-[11px] bg-surface-2 px-1.5 py-0.5 border border-border">{{ $log->old_value }}</span> 
                    to 
                    <span class="font-mono text-[11px] bg-surface-2 px-1.5 py-0.5 border border-border text-text-primary">{{ $log->new_value }}</span>
                @elseif($log->field === 'assigned_id')
                    @if($log->new_value)
                        assigned ticket to <span class="font-medium text-text-primary">{{ \App\Models\User::find($log->new_value)?->name ?? 'Unknown User' }}</span>
                    @else
                        unassigned the ticket
                    @endif
                @else
                    updated {{ str_replace('_', ' ', $log->field) }}
                @endif
            @endif
        </div>
    </div>
</div>
