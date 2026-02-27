<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500|inter:400,500|jetbrains-mono:400,500,600&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
    <style>
        .grid-bg {
            background-image: linear-gradient(to right, var(--color-border) 1px, transparent 1px),
                              linear-gradient(to bottom, var(--color-border) 1px, transparent 1px);
            background-size: 40px 40px;
            background-position: center top;
            mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 80%);
            -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0) 80%);
        }
    </style>
</head>
<body class="bg-bg text-text-primary flex min-h-screen flex-col font-sans antialiased selection:bg-accent selection:text-white relative">
    
    <div class="absolute inset-0 grid-bg pointer-events-none z-0"></div>

    <main class="flex-1 flex flex-col items-center justify-center p-6 text-center relative z-10">
        <div class="mb-12 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <a href="/" class="flex items-center gap-3 group justify-center">
                <div class="w-10 h-10 bg-accent rounded-[6px] flex items-center justify-center transition-transform duration-150 group-hover:-translate-y-[1px]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                </div>
                <span class="text-2xl font-display font-medium tracking-tight text-text-primary group-hover:text-accent transition-colors duration-150">Ticket Hub</span>
            </a>
        </div>

        <div class="max-w-md w-full bg-surface-1 border border-border rounded-[8px] p-10 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards] shadow-[0_20px_40px_-15px_rgba(0,0,0,0.5)]">
            <div class="text-accent font-mono font-medium text-6xl md:text-7xl tracking-tighter mb-6 opacity-50">
                @yield('code')
            </div>
            
            <h1 class="text-2xl font-display font-medium text-text-primary mb-4 tracking-tight">@yield('heading')</h1>
            <p class="text-text-secondary text-[15px] mb-10 leading-relaxed">@yield('message')</p>

            <div class="flex flex-col gap-4">
                <x-blue-button href="{{ url()->previous() == url()->current() ? '/' : url()->previous() }}" class="w-full py-3">
                    Return to Mission Control
                </x-blue-button>
                <a href="/" class="text-[11px] font-mono uppercase tracking-[0.08em] text-text-muted hover:text-text-primary transition-colors duration-150">
                    Back to Home Base
                </a>
            </div>
        </div>

        <div class="mt-12 text-text-muted font-mono text-[10px] uppercase tracking-[0.08em] opacity-0 animate-[fadeIn_0.3s_ease-out_100ms_forwards]">
            ERROR_LOG_REF: {{ strtoupper(Str::random(8)) }}
        </div>
    </main>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>
