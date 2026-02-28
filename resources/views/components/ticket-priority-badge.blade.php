@props(['priority'])

@php
    $priority = $priority instanceof \App\Enums\TicketPriority ? $priority : \App\Enums\TicketPriority::tryFrom($priority);
@endphp

@if($priority === \App\Enums\TicketPriority::HIGH)
    <span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-0.5 rounded-none text-[12px] font-medium bg-danger/15 text-danger border border-danger/20']) }}>
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg>
        High
    </span>
@elseif($priority === \App\Enums\TicketPriority::MEDIUM)
    <span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-0.5 rounded-none text-[12px] font-medium bg-warning/15 text-warning border border-warning/20']) }}>
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="M5 12h14"/></svg>
        Medium
    </span>
@elseif($priority === \App\Enums\TicketPriority::LOW)
    <span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-0.5 rounded-none text-[12px] font-medium bg-success/15 text-success border border-success/20']) }}>
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg>
        Low
    </span>
@else
    <span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-0.5 rounded-none text-[12px] font-medium bg-surface-2 text-text-secondary border border-border']) }}>
        {{ ucfirst($priority->value ?? $priority) }}
    </span>
@endif
