<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Ticket Hub') }} - Precision Support</title>
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
<body class="bg-bg text-text-primary font-sans antialiased selection:bg-accent selection:text-white relative">

    <div class="absolute inset-0 grid-bg pointer-events-none z-0"></div>

    <div class="relative z-10">
        <x-header />

        <main>
            <!-- Hero Section -->
            <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
                <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center relative z-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-[4px] bg-accent/10 border border-accent/20 text-accent text-xs font-mono uppercase tracking-[0.08em] mb-8 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
                        <span class="w-1.5 h-1.5 rounded-full bg-accent"></span>
                        Ticket Hub v2.0
                    </div>

                    <h1 class="text-5xl md:text-7xl font-[Syne] font-extrabold tracking-tight text-text-primary mb-6 leading-tight max-w-4xl mx-auto opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
                        Control the chaos. <br>
                        <span class="text-accent">Engineer your support.</span>
                    </h1>

                    <p class="text-lg md:text-xl text-text-secondary mb-10 max-w-2xl mx-auto leading-relaxed font-sans opacity-0 animate-[fadeIn_0.3s_ease-out_100ms_forwards]">
                        The technical help desk for teams that value precision. Lightning-fast workflows, deep automation, and an interface built for speed.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 opacity-0 animate-[fadeIn_0.3s_ease-out_150ms_forwards]">
                        <a href="{{ route('register') }}" class="w-full sm:w-auto bg-accent hover:bg-accent-hover text-white text-sm font-medium px-8 py-3 rounded-[6px] transition-all duration-200 hover:shadow-[0_0_12px_var(--color-accent-glow)]">
                            Start Free Trial
                        </a>
                        <a href="{{ route('portal.index') }}" class="w-full sm:w-auto bg-transparent hover:bg-surface-2 text-text-secondary hover:text-text-primary text-sm font-medium px-8 py-3 rounded-[6px] border border-border hover:border-border-light transition-all duration-200 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><line x1="9" x2="15" y1="9" y2="9"/><line x1="9" x2="15" y1="15" y2="15"/></svg>
                            View Live Portal
                        </a>
                    </div>
                </div>

                <!-- Abstract Technical Preview -->
                <div class="mt-20 relative max-w-5xl mx-auto px-6 lg:px-8 opacity-0 animate-[fadeIn_0.5s_ease-out_250ms_forwards]">
                    <div class="relative rounded-[8px] bg-surface-1 border border-border overflow-hidden aspect-[16/9] md:aspect-[2/1] group shadow-[0_20px_40px_-15px_rgba(0,0,0,0.5)]">
                        <!-- Top Bar -->
                        <div class="h-10 border-b border-border bg-surface-2 flex items-center px-4 gap-2">
                            <div class="w-3 h-3 rounded-full bg-border-light"></div>
                            <div class="w-3 h-3 rounded-full bg-border-light"></div>
                            <div class="w-3 h-3 rounded-full bg-border-light"></div>
                            <div class="ml-4 font-mono text-xs text-text-muted">tickethub.dev.br / dashboard</div>
                        </div>
                        
                        <!-- Sidebar and Content -->
                        <div class="flex h-[calc(100%-2.5rem)]">
                            <div class="w-48 border-r border-border bg-surface-1 hidden md:block p-4">
                                <div class="space-y-2">
                                    <div class="h-4 w-24 bg-surface-3 rounded-[4px]"></div>
                                    <div class="h-4 w-32 bg-surface-2 rounded-[4px]"></div>
                                    <div class="h-4 w-20 bg-surface-2 rounded-[4px]"></div>
                                </div>
                            </div>
                            <div class="flex-1 p-6 space-y-4">
                                <!-- Code Snippet Mock -->
                                <div class="p-4 rounded-[6px] bg-surface-2 border border-border font-mono text-sm">
                                    <span class="text-text-muted">// Ticket processing automation</span><br>
                                    <span class="text-accent">const</span> <span class="text-text-primary">ticket</span> = <span class="text-accent">await</span> <span class="text-text-primary">Ticket</span>.<span class="text-success">create</span>({<br>
                                    &nbsp;&nbsp;title: <span class="text-warning">'Connection timeout'</span>,<br>
                                    &nbsp;&nbsp;priority: <span class="text-danger">'high'</span><br>
                                    });
                                </div>
                                <div class="h-10 w-full bg-surface-2 rounded-[6px] border border-border"></div>
                                <div class="h-10 w-3/4 bg-surface-2 rounded-[6px] border border-border"></div>
                            </div>
                        </div>
                        
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-bg/80 backdrop-blur-sm flex items-center justify-center z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <a href="{{ route('register') }}" class="bg-accent text-white font-medium px-6 py-2.5 rounded-[6px] transform translate-y-2 group-hover:translate-y-0 transition-all duration-200">Enter Dashboard</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features Grid -->
            <section id="features" class="py-24 border-t border-border bg-bg relative">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-text-muted font-mono tracking-[0.08em] uppercase text-xs mb-3">Architecture</h2>
                        <h3 class="text-2xl md:text-3xl font-display text-text-primary">Built for scale and precision.</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Feature 1 -->
                        <div class="p-8 rounded-[8px] bg-surface-1 border border-border hover:border-border-light transition-colors duration-150">
                            <div class="mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                            </div>
                            <h4 class="text-lg font-medium text-text-primary mb-2">Technical Workflows</h4>
                            <p class="text-text-secondary text-sm leading-relaxed">
                                Triage with keyboard shortcuts, powerful filters, and precise state management. No fluff, just speed.
                            </p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="p-8 rounded-[8px] bg-surface-1 border border-border hover:border-border-light transition-colors duration-150">
                            <div class="mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>
                            </div>
                            <h4 class="text-lg font-medium text-text-primary mb-2">Public API & Portals</h4>
                            <p class="text-text-secondary text-sm leading-relaxed">
                                Expose your support hub seamlessly. Headless architecture allows full integration with your existing stack.
                            </p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="p-8 rounded-[8px] bg-surface-1 border border-border hover:border-border-light transition-colors duration-150">
                            <div class="mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
                            </div>
                            <h4 class="text-lg font-medium text-text-primary mb-2">Webhooks & Robots</h4>
                            <p class="text-text-secondary text-sm leading-relaxed">
                                Programmatic support. React to events instantly and automate routing via powerful API integrations.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Pricing Section -->
            <section id="pricing" class="py-24 border-t border-border bg-surface-1">
                <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
                    <h2 class="text-2xl md:text-3xl font-display text-text-primary mb-4">
                        Open source foundation.
                    </h2>
                    <p class="text-text-secondary mb-10 max-w-xl mx-auto">
                        Host it yourself for full data sovereignty, or sponsor the project to steer development.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                        <div class="p-6 rounded-[8px] bg-bg border border-border hover:border-border-light transition-colors">
                            <h3 class="font-mono text-sm text-text-primary mb-2">> Self Hosted</h3>
                            <p class="text-text-secondary text-sm mb-6">Full control over your infrastructure. MIT Licensed.</p>
                            <a href="https://github.com/PMota173/ticket-hub" target="_blank" class="block w-full py-2.5 rounded-[6px] bg-surface-2 border border-border text-text-primary text-center text-sm font-medium hover:bg-surface-3 transition-colors">
                                View GitHub Repo
                            </a>
                        </div>
                        <div class="p-6 rounded-[8px] bg-bg border border-accent/30 hover:border-accent/50 transition-colors">
                            <h3 class="font-mono text-sm text-accent mb-2">> Sponsor</h3>
                            <p class="text-text-secondary text-sm mb-6">Directly fund development and prioritize feature requests.</p>
                            <a href="https://github.com/sponsors/PMota173" target="_blank" class="block w-full py-2.5 rounded-[6px] bg-accent/10 border border-accent/20 text-accent text-center text-sm font-medium hover:bg-accent/20 transition-colors">
                                Sponsor Project
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="bg-bg border-t border-border py-8">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 bg-accent rounded-[4px] flex items-center justify-center"></div>
                    <span class="font-display font-medium text-text-primary text-sm">Ticket Hub</span>
                </div>
                <p class="text-xs text-text-muted font-mono">
                    &copy; {{ date('Y') }} MIT License.
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