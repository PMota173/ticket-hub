<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Documentation - {{ config('app.name', 'Ticket Hub') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|jetbrains-mono:400" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>
<body class="bg-slate-950 text-white min-h-screen font-sans antialiased selection:bg-blue-500">
    <x-header />

    <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-24 pb-12">
        <div class="flex flex-col lg:flex-row gap-12">
            
            <!-- Sidebar Navigation -->
            <aside class="w-full lg:w-64 flex-shrink-0 lg:sticky lg:top-32 self-start">
                <nav class="space-y-8">
                    <div>
                        <h5 class="text-xs font-black text-slate-500 uppercase tracking-widest mb-4">Getting Started</h5>
                        <ul class="space-y-3">
                            <li>
                                <a href="{{ route('guides.index') }}" 
                                   class="block text-sm font-bold transition-colors {{ request()->routeIs('guides.index') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">
                                    Introduction
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('guides.show', 'teams') }}" 
                                   class="block text-sm font-bold transition-colors {{ request()->is('guides/teams') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">
                                    Teams & Members
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('guides.show', 'tickets') }}" 
                                   class="block text-sm font-bold transition-colors {{ request()->is('guides/tickets') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">
                                    Tickets & Kanban
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('guides.show', 'portal') }}" 
                                   class="block text-sm font-bold transition-colors {{ request()->is('guides/portal') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">
                                    Public Portal
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h5 class="text-xs font-black text-slate-500 uppercase tracking-widest mb-4">Automation</h5>
                        <ul class="space-y-3">
                            <li>
                                <a href="{{ route('guides.show', 'robots') }}" 
                                   class="block text-sm font-bold transition-colors {{ request()->is('guides/robots') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">
                                    Robots & Tokens
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('guides.show', 'api-reference') }}" 
                                   class="block text-sm font-bold transition-colors {{ request()->is('guides/api-reference') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">
                                    Full API Reference
                                </a>
                                <ul class="mt-3 space-y-2 pl-3 border-l border-slate-800">
                                    <li>
                                        <a href="{{ route('guides.api', 'tickets-list') }}"
                                           class="block text-xs font-bold transition-colors {{ request()->is('guides/api/tickets-list') ? 'text-blue-400' : 'text-slate-500 hover:text-white' }}">
                                            GET /tickets
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('guides.api', 'tickets-show') }}"
                                           class="block text-xs font-bold transition-colors {{ request()->is('guides/api/tickets-show') ? 'text-blue-400' : 'text-slate-500 hover:text-white' }}">
                                            GET /tickets/{id}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('guides.api', 'tickets-create') }}"
                                           class="block text-xs font-bold transition-colors {{ request()->is('guides/api/tickets-create') ? 'text-blue-400' : 'text-slate-500 hover:text-white' }}">
                                            POST /tickets
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('guides.api', 'tickets-update') }}"
                                           class="block text-xs font-bold transition-colors {{ request()->is('guides/api/tickets-update') ? 'text-blue-400' : 'text-slate-500 hover:text-white' }}">
                                            PATCH /tickets/{id}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('guides.api', 'tickets-comments-create') }}"
                                           class="block text-xs font-bold transition-colors {{ request()->is('guides/api/tickets-comments-create') ? 'text-blue-400' : 'text-slate-500 hover:text-white' }}">
                                            POST /tickets/{id}/comments
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('guides.api', 'team-members') }}"
                                           class="block text-xs font-bold transition-colors {{ request()->is('guides/api/team-members') ? 'text-blue-400' : 'text-slate-500 hover:text-white' }}">
                                            GET /team/members
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 min-w-0">
                <article class="text-slate-300 leading-relaxed">
                    @yield('content')
                </article>

                <!-- Page Navigation -->
                <div class="mt-16 pt-8 border-t border-slate-800 flex justify-between items-center">
                    @yield('pagination')
                </div>
            </main>

        </div>
    </div>
    
    <x-footer />

    <script>
        function switchTab(blockId, lang) {
            // 1. Deselect all buttons in this block
            const buttons = document.querySelectorAll(`#${blockId} .tab-btn`);
            buttons.forEach(btn => {
                btn.classList.remove('text-blue-400', 'border-blue-500', 'bg-blue-500/10');
                btn.classList.add('text-slate-400', 'border-transparent', 'hover:text-white');
            });

            // 2. Select clicked button
            const activeBtn = document.querySelector(`#${blockId} .btn-${lang}`);
            if(activeBtn) {
                activeBtn.classList.remove('text-slate-400', 'border-transparent', 'hover:text-white');
                activeBtn.classList.add('text-blue-400', 'border-blue-500', 'bg-blue-500/10');
            }

            // 3. Hide all code blocks
            const panels = document.querySelectorAll(`#${blockId} .code-panel`);
            panels.forEach(panel => panel.classList.add('hidden'));

            // 4. Show active code block
            const activePanel = document.querySelector(`#${blockId} .panel-${lang}`);
            if(activePanel) {
                activePanel.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>
