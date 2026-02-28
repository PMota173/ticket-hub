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
<body class="bg-bg text-text-primary flex min-h-screen flex-col antialiased font-mono selection:bg-accent selection:text-white relative overflow-hidden">
    
    <!-- Content -->
    <main class="flex-1 flex flex-col items-center justify-center py-12 px-6 lg:px-8 relative z-10">
        <div class="mb-10 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <a href="/" class="flex items-center gap-4 group transition-colors duration-150">
                <div class="flex items-center justify-center w-6 h-6 bg-text-primary border border-text-primary transition-transform duration-150 group-hover:scale-90"></div>
                <span class="text-3xl font-bold tracking-tight text-text-primary group-hover:text-text-secondary transition-colors duration-150">tickethub_</span>
            </a>
        </div>

        <div class="w-full max-w-md opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            {{ $slot }}
        </div>

        <div class="mt-8 text-center text-xs text-text-muted opacity-0 animate-[fadeIn_0.3s_ease-out_100ms_forwards]">
            // &copy; {{ date('Y') }} {{ config('app.name') }}. Auth Module.
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