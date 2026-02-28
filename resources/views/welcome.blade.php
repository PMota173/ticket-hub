<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Ticket Hub') }} - Open Source Help Desk</title>
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
<body class="bg-bg text-text-primary font-sans antialiased selection:bg-accent selection:text-white relative min-h-screen flex flex-col">

    <div class="absolute inset-0 grid-bg pointer-events-none z-0"></div>

    <div class="relative z-10 flex flex-col flex-1">
        <x-header />

        <main class="flex-1">
            <!-- Hero Section (Terminal/Log Style) -->
            <section class="relative pt-24 pb-16 lg:pt-32 lg:pb-24 border-b border-border">
                <div class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                    
                    <div class="lg:col-span-7 space-y-8 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
                        <div class="inline-flex items-center gap-3">
                            <span class="w-2 h-2 bg-success animate-pulse"></span>
                            <span class="text-text-muted font-mono text-sm tracking-tight">[status: online]</span>
                            <span class="text-text-muted font-mono text-sm tracking-tight border-l border-border pl-3">v2.0</span>
                        </div>

                        <h1 class="text-5xl md:text-6xl font-display font-semibold tracking-tight text-text-primary leading-[1.1]">
                            Beautiful support.<br>
                            <span class="text-text-secondary">Zero friction.</span>
                        </h1>

                        <p class="text-lg text-text-secondary max-w-xl leading-relaxed font-sans">
                            The open-source help desk built for teams that value speed. A lightning-fast Kanban board for your team, and a transparent portal for your customers.
                        </p>

                        <div class="flex flex-col sm:flex-row items-start gap-4 pt-4">
                            <a href="{{ route('register') }}" class="group relative inline-flex items-center justify-center bg-text-primary text-bg font-mono text-sm font-semibold px-6 py-3 transition-transform hover:-translate-y-0.5 active:translate-y-0">
                                <span class="absolute inset-0 border border-text-primary"></span>
                                <span class="relative flex items-center gap-2">
                                    [ Create Workspace ]
                                </span>
                            </a>
                            <a href="{{ route('portal.index') }}" class="inline-flex items-center justify-center bg-transparent text-text-secondary hover:text-text-primary border border-border hover:border-text-secondary font-mono text-sm font-medium px-6 py-3 transition-colors">
                                <span class="flex items-center gap-2">
                                    >_ view_live_portal
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- Abstract Terminal Preview -->
                    <div class="lg:col-span-5 relative opacity-0 animate-[fadeIn_0.5s_ease-out_200ms_forwards]">
                        <div class="rounded-none bg-surface-1 border border-border font-mono text-xs md:text-sm shadow-2xl">
                            <!-- Terminal Header -->
                            <div class="h-9 border-b border-border bg-surface-2 flex items-center px-4 justify-between">
                                <div class="flex gap-2">
                                    <div class="w-2.5 h-2.5 rounded-full bg-border-light"></div>
                                    <div class="w-2.5 h-2.5 rounded-full bg-border-light"></div>
                                    <div class="w-2.5 h-2.5 rounded-full bg-border-light"></div>
                                </div>
                                <div class="text-text-muted">triage_log</div>
                            </div>
                            <!-- Terminal Body -->
                            <div class="p-4 space-y-3 text-text-secondary">
                                <div class="flex items-start gap-3">
                                    <span class="text-text-muted shrink-0">14:02:11</span>
                                    <span><span class="text-accent">GET</span> /api/tickets/recent <span class="text-success">200 OK</span></span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="text-text-muted shrink-0">14:02:15</span>
                                    <span>User 'pmota' <span class="text-warning">triaged</span> ticket #402 to [High Priority]</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="text-text-muted shrink-0">14:02:22</span>
                                    <span><span class="text-accent">POST</span> /api/comments <span class="text-success">201 Created</span></span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="text-text-muted shrink-0">14:02:23</span>
                                    <span>Notification dispatched -> mail_queue</span>
                                </div>
                                <div class="flex items-start gap-3 mt-4 pt-4 border-t border-border/50">
                                    <span class="text-success shrink-0">❯</span>
                                    <span class="text-text-primary animate-pulse">_</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>

            <!-- Workflow Log Section -->
            <section id="workflow" class="py-24 border-b border-border bg-bg">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="mb-16">
                        <h2 class="text-text-muted font-mono tracking-widest uppercase text-xs mb-3 flex items-center gap-2">
                            <span class="w-4 h-[1px] bg-text-muted"></span> Workflow
                        </h2>
                        <h3 class="text-2xl md:text-3xl font-display text-text-primary">Built for productivity and transparency.</h3>
                    </div>

                    <div class="flex flex-col border-l border-border ml-2 md:ml-4 space-y-12 pl-6 md:pl-10">
                        
                        <!-- Item 1 -->
                        <div class="relative group">
                            <!-- Timeline Dot -->
                            <div class="absolute -left-[29px] md:-left-[45px] top-1 w-3 h-3 bg-bg border-2 border-text-muted group-hover:border-accent transition-colors"></div>
                            
                            <div class="flex flex-col md:flex-row gap-6 items-start">
                                <div class="md:w-1/3">
                                    <h4 class="font-mono text-lg text-text-primary mb-2">Reactive Kanban</h4>
                                    <p class="text-text-secondary text-sm leading-relaxed font-sans">
                                        Drag and drop tickets seamlessly. Triage with custom tags and priorities to ensure no issue ever slips through the cracks.
                                    </p>
                                </div>
                                <div class="md:w-2/3 w-full border border-border bg-surface-1 p-4 text-xs font-mono text-text-muted">
                                    // Status update payload<br>
                                    {<br>
                                    &nbsp;&nbsp;"ticket_id": "TKT-802",<br>
                                    &nbsp;&nbsp;"status": "<span class="text-warning">in_progress</span>",<br>
                                    &nbsp;&nbsp;"assignee": "system"<br>
                                    }
                                </div>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="relative group">
                            <div class="absolute -left-[29px] md:-left-[45px] top-1 w-3 h-3 bg-bg border-2 border-text-muted group-hover:border-accent transition-colors"></div>
                            
                            <div class="flex flex-col md:flex-row gap-6 items-start">
                                <div class="md:w-1/3">
                                    <h4 class="font-mono text-lg text-text-primary mb-2">Transparent Portals</h4>
                                    <p class="text-text-secondary text-sm leading-relaxed font-sans">
                                        Give your customers a branded, lightning-fast home to submit requests and track their progress in real-time.
                                    </p>
                                </div>
                                <div class="md:w-2/3 w-full border border-border bg-surface-1 p-4 text-xs font-mono text-text-muted">
                                    > Loading customer portal...<br>
                                    > Authenticated as: guest_user<br>
                                    > Rendering ticket history [■■■■■■■■■■] 100%<br>
                                    <span class="text-success">Portal ready.</span>
                                </div>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="relative group">
                            <div class="absolute -left-[29px] md:-left-[45px] top-1 w-3 h-3 bg-bg border-2 border-text-muted group-hover:border-accent transition-colors"></div>
                            
                            <div class="flex flex-col md:flex-row gap-6 items-start">
                                <div class="md:w-1/3">
                                    <h4 class="font-mono text-lg text-text-primary mb-2">Automation Robots</h4>
                                    <p class="text-text-secondary text-sm leading-relaxed font-sans">
                                        Programmatic support. Create API keys to automatically ingest tickets from external forms, apps, or services.
                                    </p>
                                </div>
                                <div class="md:w-2/3 w-full border border-border bg-surface-1 p-4 text-xs font-mono text-text-muted">
                                    $ curl -X POST https://tickethub.dev.br/api/tickets \<br>
                                    &nbsp;&nbsp;-H "Authorization: Bearer th_robot_***" \<br>
                                    &nbsp;&nbsp;-d '{"title":"Deployment failed","priority":"urgent"}'
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- Open Source Section -->
            <section id="pricing" class="py-24 bg-surface-1">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row gap-12 items-center">
                        <div class="md:w-1/2">
                            <h2 class="text-3xl md:text-4xl font-display font-medium text-text-primary mb-4">
                                Own your data.<br>
                                <span class="text-text-secondary">Escape per-agent pricing.</span>
                            </h2>
                            <p class="text-text-secondary mb-8 font-sans leading-relaxed">
                                100% open-source and self-hostable. Maintain full control over your infrastructure, or sponsor the project to steer its future.
                            </p>
                            <div class="flex items-center gap-4">
                                <a href="https://github.com/PMota173/ticket-hub" target="_blank" class="inline-flex items-center gap-2 font-mono text-sm text-text-primary border-b border-text-primary pb-0.5 hover:text-accent hover:border-accent transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/><path d="M9 18c-4.51 2-5-2-7-2"/></svg>
                                    View Repository
                                </a>
                                <span class="text-text-muted">|</span>
                                <a href="https://github.com/sponsors/PMota173" target="_blank" class="inline-flex items-center gap-2 font-mono text-sm text-text-secondary hover:text-text-primary transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                                    Sponsor Project
                                </a>
                            </div>
                        </div>

                        <div class="md:w-1/2 w-full">
                            <div class="bg-bg border border-border p-6 font-mono text-sm">
                                <div class="text-text-muted mb-4">// System requirements check</div>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-text-secondary">PHP</span>
                                        <span class="text-success">>= 8.2 [OK]</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-text-secondary">Laravel</span>
                                        <span class="text-success">12.x [OK]</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-text-secondary">Database</span>
                                        <span class="text-success">SQLite / MySQL / PgSQL [OK]</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-text-secondary">License</span>
                                        <span class="text-text-primary">MIT</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="bg-bg border-t border-border py-6">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2 text-text-primary font-mono text-sm">
                    <span class="w-3 h-3 bg-text-primary border border-text-primary"></span>
                    tickethub_
                </div>
                <p class="text-xs text-text-muted font-mono">
                    &copy; {{ date('Y') }} MIT License. Run your own support.
                </p>
            </div>
        </footer>
    </div>
    
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>