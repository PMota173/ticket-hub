<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Documentation - {{ config('app.name', 'Ticket Hub') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500|inter:400,500|jetbrains-mono:400,500,600|syne:800&display=swap" rel="stylesheet" />
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
<body class="bg-bg text-text-primary min-h-screen font-sans antialiased selection:bg-accent selection:text-white relative">
    
    <div class="absolute inset-0 grid-bg pointer-events-none z-0"></div>

    <div class="relative z-10 flex flex-col min-h-screen">
        <x-header />

        <div class="flex-1 max-w-7xl mx-auto px-6 lg:px-8 pt-24 pb-20 w-full">
            <div class="flex flex-col lg:flex-row gap-12">
                
                <!-- Sidebar Navigation -->
                <aside class="w-full lg:w-64 flex-shrink-0 lg:sticky lg:top-24 self-start opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
                    <nav class="space-y-8">
                        <div>
                            <h5 class="text-[10px] font-mono font-medium text-text-muted uppercase tracking-[0.08em] mb-4">Getting Started</h5>
                            <ul class="space-y-3">
                                <li>
                                    <a href="{{ route('guides.index') }}" 
                                       class="block text-[13px] font-medium transition-colors duration-150 {{ request()->routeIs('guides.index') ? 'text-accent' : 'text-text-secondary hover:text-text-primary' }}">
                                        Introduction
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('guides.show', 'teams') }}" 
                                       class="block text-[13px] font-medium transition-colors duration-150 {{ request()->is('guides/teams') ? 'text-accent' : 'text-text-secondary hover:text-text-primary' }}">
                                        Teams & Members
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('guides.show', 'tickets') }}" 
                                       class="block text-[13px] font-medium transition-colors duration-150 {{ request()->is('guides/tickets') ? 'text-accent' : 'text-text-secondary hover:text-text-primary' }}">
                                        Tickets & Kanban
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('guides.show', 'portal') }}" 
                                       class="block text-[13px] font-medium transition-colors duration-150 {{ request()->is('guides/portal') ? 'text-accent' : 'text-text-secondary hover:text-text-primary' }}">
                                        Public Portal
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <h5 class="text-[10px] font-mono font-medium text-text-muted uppercase tracking-[0.08em] mb-4">Automation</h5>
                            <ul class="space-y-3">
                                <li>
                                    <a href="{{ route('guides.show', 'robots') }}" 
                                       class="block text-[13px] font-medium transition-colors duration-150 {{ request()->is('guides/robots') ? 'text-accent' : 'text-text-secondary hover:text-text-primary' }}">
                                        Robots & Tokens
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('guides.show', 'api-reference') }}" 
                                       class="block text-[13px] font-medium transition-colors duration-150 {{ request()->is('guides/api-reference') ? 'text-accent' : 'text-text-secondary hover:text-text-primary' }}">
                                        Full API Reference
                                    </a>
                                    <ul class="mt-3 space-y-2.5 pl-3 border-l-[2px] border-surface-2">
                                        <li>
                                            <a href="{{ route('guides.api', 'tickets-list') }}"
                                               class="block text-[11px] font-mono uppercase tracking-[0.08em] transition-colors duration-150 {{ request()->is('guides/api/tickets-list') ? 'text-accent' : 'text-text-muted hover:text-text-primary' }}">
                                                GET /tickets
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('guides.api', 'tickets-show') }}"
                                               class="block text-[11px] font-mono uppercase tracking-[0.08em] transition-colors duration-150 {{ request()->is('guides/api/tickets-show') ? 'text-accent' : 'text-text-muted hover:text-text-primary' }}">
                                                GET /tickets/{id}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('guides.api', 'tickets-create') }}"
                                               class="block text-[11px] font-mono uppercase tracking-[0.08em] transition-colors duration-150 {{ request()->is('guides/api/tickets-create') ? 'text-accent' : 'text-text-muted hover:text-text-primary' }}">
                                                POST /tickets
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('guides.api', 'tickets-update') }}"
                                               class="block text-[11px] font-mono uppercase tracking-[0.08em] transition-colors duration-150 {{ request()->is('guides/api/tickets-update') ? 'text-accent' : 'text-text-muted hover:text-text-primary' }}">
                                                PATCH /tickets/{id}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('guides.api', 'tickets-comments-create') }}"
                                               class="block text-[11px] font-mono uppercase tracking-[0.08em] transition-colors duration-150 {{ request()->is('guides/api/tickets-comments-create') ? 'text-accent' : 'text-text-muted hover:text-text-primary' }}">
                                                POST .../comments
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('guides.api', 'team-members') }}"
                                               class="block text-[11px] font-mono uppercase tracking-[0.08em] transition-colors duration-150 {{ request()->is('guides/api/team-members') ? 'text-accent' : 'text-text-muted hover:text-text-primary' }}">
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
                <main class="flex-1 min-w-0 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
                    <article class="text-text-secondary leading-relaxed text-[15px]">
                        @yield('content')
                    </article>

                    <!-- Page Navigation -->
                    <div class="mt-16 pt-8 border-t border-border flex justify-between items-center">
                        @yield('pagination')
                    </div>
                </main>

            </div>
        </div>
        
        <x-footer />
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Documentation specific styles to override default prose if needed */
        article h1 { @apply text-3xl font-display font-medium text-text-primary mb-6 tracking-tight; }
        article h2 { @apply text-2xl font-display font-medium text-text-primary mt-12 mb-4 tracking-tight; }
        article h3 { @apply text-lg font-display font-medium text-text-primary mt-8 mb-4 tracking-tight; }
        article p { @apply mb-6; }
        article ul { @apply list-disc list-inside mb-6 space-y-2 pl-4; }
        article pre { @apply bg-surface-1 border border-border rounded-[8px] p-4 mb-6 overflow-x-auto font-mono text-[13px]; }
        article code { @apply font-mono text-[13px] bg-surface-2 px-1.5 py-0.5 rounded-[4px] border border-border text-text-primary; }
        article pre code { @apply bg-transparent border-none p-0 text-text-secondary; }
        article a { @apply text-accent hover:text-accent-hover transition-colors; }
        article blockquote { @apply border-l-[2px] border-accent bg-accent/5 py-3 pr-4 pl-5 my-6 rounded-r-[6px] text-text-primary italic; }
    </style>

    <script>
        function switchTab(blockId, lang) {
            // 1. Deselect all buttons in this block
            const buttons = document.querySelectorAll(`#${blockId} .tab-btn`);
            buttons.forEach(btn => {
                btn.classList.remove('text-accent', 'border-accent', 'bg-surface-3');
                btn.classList.add('text-text-secondary', 'border-transparent', 'hover:text-text-primary');
            });

            // 2. Select clicked button
            const activeBtn = document.querySelector(`#${blockId} .btn-${lang}`);
            if(activeBtn) {
                activeBtn.classList.remove('text-text-secondary', 'border-transparent', 'hover:text-text-primary');
                activeBtn.classList.add('text-accent', 'border-accent', 'bg-surface-3');
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