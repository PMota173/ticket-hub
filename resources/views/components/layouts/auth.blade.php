<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Ticket Hub') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
    <style>
        .auth-glow {
            background: radial-gradient(circle at 50% 50%, rgba(59, 130, 246, 0.15), transparent 50%);
        }
    </style>
</head>
<body class="bg-slate-950 text-white flex min-h-screen flex-col antialiased font-sans selection:bg-blue-500 selection:text-white relative overflow-hidden">
    
    <!-- Background Effects -->
    <div class="absolute inset-0 auth-glow pointer-events-none"></div>
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-blue-600/10 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 bg-indigo-600/10 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

    <!-- Content -->
    <main class="flex-1 flex flex-col items-center justify-center py-12 px-6 lg:px-8 relative z-10">
        <div class="mb-8">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20 group-hover:scale-105 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                </div>
                <span class="text-2xl font-bold tracking-tight text-white group-hover:text-blue-400 transition-colors">Ticket Hub</span>
            </a>
        </div>

        <div class="w-full max-w-md">
            {{ $slot }}
        </div>

        <div class="mt-8 text-center text-sm text-slate-500">
            &copy; {{ date('Y') }} {{ config('app.name') }}. Crafted with precision.
        </div>
    </main>
</body>
</html>