@props(['status'])

@php
    $status = $status instanceof \App\Enums\TicketStatus ? $status : \App\Enums\TicketStatus::tryFrom($status);
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border ' . match($status) {
    \App\Enums\TicketStatus::OPEN => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
    \App\Enums\TicketStatus::IN_PROGRESS => 'bg-purple-500/10 text-purple-400 border-purple-500/20',
    \App\Enums\TicketStatus::WAITING => 'bg-orange-500/10 text-orange-400 border-orange-500/20',
    \App\Enums\TicketStatus::CLOSED => 'bg-green-500/10 text-green-400 border-green-500/20',
    default => 'bg-slate-500/10 text-slate-400 border-slate-500/20',
}]) }}>
    {{ ucfirst(str_replace('_', ' ', $status->value ?? $status)) }}
</span>
