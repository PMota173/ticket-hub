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
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-950 text-white font-sans antialiased selection:bg-blue-500 selection:text-white">
    
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @if(isset($sidebar))
            @if($sidebar === 'global')
                <x-global-sidebar />
            @else
                <x-sidebar />
            @endif
        @else
            <x-global-sidebar />
        @endif

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <main class="flex-1 p-6 lg:p-8 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        function openModal(id, actionUrl = null) {
            const modal = document.getElementById(id);
            const backdrop = document.getElementById(id + '-backdrop');
            const panel = document.getElementById(id + '-panel');
            const form = document.getElementById(id + '-form');

            if (actionUrl && form) {
                form.action = actionUrl;
            }

            modal.classList.remove('hidden');
            
            // Small timeout to ensure DOM update before transition
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                panel.classList.remove('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
            }, 10);
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            const backdrop = document.getElementById(id + '-backdrop');
            const panel = document.getElementById(id + '-panel');

            backdrop.classList.add('opacity-0');
            panel.classList.add('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Match transition duration
        }
    </script>
</body>
</html>