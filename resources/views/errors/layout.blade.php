<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
    <style>
        .error-glow {
            background: radial-gradient(circle at 50% 50%, rgba(59, 130, 246, 0.1), transparent 50%);
        }
    </style>
</head>
<body class="bg-slate-950 text-white font-sans antialiased selection:bg-blue-500 relative overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0 error-glow pointer-events-none"></div>
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-blue-600/10 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 bg-indigo-600/10 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>

    <main class="flex min-h-screen flex-col items-center justify-center p-6 text-center relative z-10">
        <div class="mb-12">
            <a href="/" class="flex items-center gap-3 group justify-center">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20 group-hover:scale-105 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                </div>
                <span class="text-2xl font-bold tracking-tight text-white group-hover:text-blue-400 transition-colors">Ticket Hub</span>
            </a>
        </div>

        <div class="max-w-md w-full bg-slate-900/50 backdrop-blur-xl border border-slate-800 rounded-[2.5rem] p-10 shadow-2xl">
            <div class="text-blue-500 font-black text-6xl md:text-8xl tracking-tighter mb-6 opacity-50">
                @yield('code')
            </div>
            
            <h1 class="text-3xl font-black text-white mb-4 tracking-tight">@yield('heading')</h1>
            <p class="text-slate-400 text-lg mb-10 leading-relaxed font-medium">@yield('message')</p>

            <div class="flex flex-col gap-4">
                <a href="{{ url()->previous() == url()->current() ? '/' : url()->previous() }}" class="w-full bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black uppercase tracking-[0.2em] py-4 rounded-2xl transition-all shadow-xl shadow-blue-900/40">
                    Return to Mission Control
                </a>
                <a href="/" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 hover:text-white transition-colors">
                    Back to Home Base
                </a>
            </div>
        </div>

        <div class="mt-12 text-slate-600 text-[10px] font-black uppercase tracking-widest">
            ERROR_LOG_REF: {{ strtoupper(Str::random(8)) }}
        </div>
    </main>
</body>
</html>
