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
    
    <!-- Mobile Top Header -->
    <header class="md:hidden fixed top-0 inset-x-0 h-16 bg-surface-1 border-b border-border z-40 flex items-center justify-between px-4 font-mono">
        <a href="/" class="flex items-center gap-3 group transition-colors duration-150">
            <div class="flex items-center justify-center w-3 h-3 bg-text-primary border border-text-primary"></div>
            <span class="font-bold tracking-tight text-text-primary text-sm">tickethub_</span>
        </a>
        <button onclick="toggleMobileMenu()" class="text-text-muted hover:text-text-primary p-2 border border-border hover:border-text-primary transition-colors focus:outline-none flex items-center justify-center w-10 h-10 rounded-none bg-surface-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
        </button>
    </header>

    <!-- Mobile Backdrop -->
    <div id="mobile-menu-backdrop" onclick="closeMobileMenu()" class="fixed inset-0 bg-bg/80 backdrop-blur-sm z-40 hidden opacity-0 transition-opacity duration-200 md:hidden"></div>

    <div class="flex min-h-screen pt-16 md:pt-0">
        <!-- Sidebar Wrapper (Handles Mobile Slide-over) -->
        <div id="mobile-menu-drawer" class="fixed inset-y-0 left-0 z-50 transform -translate-x-full transition-transform duration-200 ease-in-out md:relative md:translate-x-0 flex flex-col md:flex">
            <!-- Close button for mobile inside drawer -->
            <button onclick="closeMobileMenu()" class="md:hidden absolute top-4 right-4 text-text-muted hover:text-text-primary p-2 bg-surface-2 border border-border z-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
            
            @if(isset($sidebar))
                @if($sidebar === 'global')
                    <x-global-sidebar />
                @else
                    <x-sidebar />
                @endif
            @else
                <x-global-sidebar />
            @endif
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        // Modal functions
        function openModal(id, actionUrl = null) {
            const modal = document.getElementById(id);
            const backdrop = document.getElementById(id + '-backdrop');
            const panel = document.getElementById(id + '-panel');
            const form = document.getElementById(id + '-form');

            if (actionUrl && form) {
                form.action = actionUrl;
            }

            modal.classList.remove('hidden');
            
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
            }, 150);
        }

        // Mobile Menu Functions
        function toggleMobileMenu() {
            const drawer = document.getElementById('mobile-menu-drawer');
            const backdrop = document.getElementById('mobile-menu-backdrop');
            
            if (drawer.classList.contains('-translate-x-full')) {
                // Open
                drawer.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                document.body.classList.add('overflow-hidden'); // Prevent background scrolling
                
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                }, 10);
            } else {
                closeMobileMenu();
            }
        }

        function closeMobileMenu() {
            const drawer = document.getElementById('mobile-menu-drawer');
            const backdrop = document.getElementById('mobile-menu-backdrop');
            
            drawer.classList.add('-translate-x-full');
            backdrop.classList.add('opacity-0');
            document.body.classList.remove('overflow-hidden');
            
            setTimeout(() => {
                backdrop.classList.add('hidden');
            }, 200);
        }
    </script>
</body>
</html>