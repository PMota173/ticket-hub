<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Ticket Hub') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500|inter:400,500|jetbrains-mono:400,500,600&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>
<body class="bg-bg text-text-primary flex min-h-screen flex-col antialiased font-sans selection:bg-accent selection:text-white relative overflow-hidden">
    
    <!-- Content -->
    <main class="flex-1 flex flex-col items-center justify-center py-12 px-6 lg:px-8 relative z-10">
        <div class="mb-8 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <a href="/" class="flex items-center gap-3 group transition-colors duration-150">
                <div class="w-10 h-10 bg-accent rounded-[6px] flex items-center justify-center transition-transform duration-150 group-hover:-translate-y-[1px]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                </div>
                <span class="text-2xl font-bold tracking-tight text-text-primary group-hover:text-accent transition-colors duration-150 font-display">Ticket Hub</span>
            </a>
        </div>

        <div class="w-full max-w-md opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            {{ $slot }}
        </div>

        <div class="mt-8 text-center text-sm text-text-muted opacity-0 animate-[fadeIn_0.3s_ease-out_100ms_forwards]">
            &copy; {{ date('Y') }} {{ config('app.name') }}. Crafted with precision.
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