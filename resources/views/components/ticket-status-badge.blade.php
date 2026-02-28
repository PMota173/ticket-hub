@props(['status'])

@php
    $status = $status instanceof \App\Enums\TicketStatus ? $status : \App\Enums\TicketStatus::tryFrom($status);
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-0.5 rounded-none text-[12px] font-medium border ' . match($status) {
    \App\Enums\TicketStatus::TRIAGE => 'bg-surface-3 text-text-secondary border-border border-dashed',
    \App\Enums\TicketStatus::OPEN => 'bg-surface-2 text-text-primary border-border',
    \App\Enums\TicketStatus::IN_PROGRESS => 'bg-accent/15 text-accent border-accent/20',
    \App\Enums\TicketStatus::WAITING => 'bg-warning/15 text-warning border-warning/20',
    \App\Enums\TicketStatus::CLOSED => 'bg-success/15 text-success border-success/20',
    default => 'bg-surface-2 text-text-secondary border-border',
}]) }}>
    {{ ucfirst(str_replace('_', ' ', $status->value ?? $status)) }}
</span>
