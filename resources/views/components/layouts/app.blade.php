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
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-bg text-text-primary font-sans antialiased selection:bg-accent selection:text-white">
    
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
                panel.classList.remove('opacity-0', 'scale-95');
                panel.classList.add('scale-100');
            }, 10);
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            const backdrop = document.getElementById(id + '-backdrop');
            const panel = document.getElementById(id + '-panel');

            backdrop.classList.add('opacity-0');
            panel.classList.remove('scale-100');
            panel.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 150); // Fast 150ms transition
        }
    </script>
</body>
</html>