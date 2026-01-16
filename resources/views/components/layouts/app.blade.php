<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Ticket Hub') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>
@props(['title', 'sidebar' => 'team'])

<body class="text-white bg-slate-950 font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @if($sidebar === 'global')
            <x-global-sidebar />
        @else
            <x-sidebar />
        @endif

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <div class="py-6 px-8">
                {{ $slot }}
            </div>
        </main>
    </div>
    <script>
        function openModal(modalId, actionUrl) {
            const modal = document.getElementById(modalId);
            const backdrop = document.getElementById(modalId + '-backdrop');
            const panel = document.getElementById(modalId + '-panel');
            const form = document.getElementById(modalId + '-form');

            if (form && actionUrl) {
                form.action = actionUrl;
            }

            modal.classList.remove('hidden');
            
            // Trigger reflow
            void modal.offsetWidth;

            // Add transition classes for opening
            backdrop.classList.remove('opacity-0');
            panel.classList.remove('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            const backdrop = document.getElementById(modalId + '-backdrop');
            const panel = document.getElementById(modalId + '-panel');

            // Add transition classes for closing
            backdrop.classList.add('opacity-0');
            panel.classList.add('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');

            // Wait for transition to finish before hiding
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const isHidden = dropdown.classList.contains('hidden');
            
            // Close all other dropdowns
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                if (el.id !== dropdownId) el.classList.add('hidden');
            });

            if (isHidden) {
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.id && event.target.id.endsWith('-backdrop')) {
                const modalId = event.target.id.replace('-backdrop', '');
                closeModal(modalId);
            }
            
            // Close dropdowns when clicking outside
            if (!event.target.closest('button[onclick^="toggleDropdown"]')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                    el.classList.add('hidden');
                });
            }
        }
    </script>
</body>
</html>
