@props(['href' => null])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-2 px-5 py-2.5 text-xs font-mono font-medium text-text-secondary transition-all duration-150 bg-transparent border border-border hover:border-text-secondary hover:text-text-primary focus:outline-none focus:ring-1 focus:ring-border focus:ring-offset-1 focus:ring-offset-bg disabled:opacity-50 disabled:cursor-not-allowed';
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $baseClasses, 'type' => 'button']) }}>
        {{ $slot }}
    </button>
@endif