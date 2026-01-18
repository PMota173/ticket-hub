@props(['priority'])

@php
    $priority = $priority instanceof \App\Enums\TicketPriority ? $priority : \App\Enums\TicketPriority::tryFrom($priority);
@endphp

@if($priority === \App\Enums\TicketPriority::HIGH)
    <span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-500/10 text-red-400 border border-red-500/20']) }}>
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg>
        High
    </span>
@elseif($priority === \App\Enums\TicketPriority::MEDIUM)
    <span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-500/10 text-yellow-400 border border-yellow-500/20']) }}>
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="M5 12h14"/></svg>
        Medium
    </span>
@elseif($priority === \App\Enums\TicketPriority::LOW)
    <span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-500/10 text-green-400 border border-green-500/20']) }}>
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg>
        Low
    </span>
@else
    <span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-500/10 text-slate-400 border border-slate-500/20']) }}>
        {{ ucfirst($priority->value ?? $priority) }}
    </span>
@endif
