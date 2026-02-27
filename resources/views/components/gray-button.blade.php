@props(['href' => null])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-2 px-5 py-2.5 text-[13px] font-medium text-text-secondary transition-all duration-150 bg-transparent border border-border rounded-[6px] hover:border-border-light hover:text-text-primary focus:outline-none focus:ring-2 focus:ring-border-light focus:ring-offset-2 focus:ring-offset-bg disabled:opacity-50 disabled:cursor-not-allowed';
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
