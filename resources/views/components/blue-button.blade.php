@props(['href' => null])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-2 px-5 py-2.5 text-xs font-mono font-semibold text-bg transition-transform duration-150 hover:-translate-y-0.5 active:translate-y-0 bg-accent border border-accent hover:bg-accent-hover focus:outline-none focus:ring-1 focus:ring-accent focus:ring-offset-1 focus:ring-offset-bg disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0';
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $baseClasses, 'type' => 'submit']) }}>
        {{ $slot }}
    </button>
@endif
