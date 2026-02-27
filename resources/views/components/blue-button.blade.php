@props(['href' => null])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-2 px-5 py-2.5 text-[13px] font-medium text-white transition-all duration-150 bg-accent rounded-[6px] hover:bg-accent-hover hover:shadow-[0_0_12px_var(--color-accent-glow)] focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-bg disabled:opacity-50 disabled:cursor-not-allowed';
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
