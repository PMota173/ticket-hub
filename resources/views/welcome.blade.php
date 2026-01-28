<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Ticket Hub') }} - Customer Support Reimagined</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
    <style>
        .glass {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .hero-glow {
            background: radial-gradient(circle at 50% 50%, rgba(59, 130, 246, 0.15), transparent 50%);
        }
    </style>
</head>
<body class="bg-slate-950 text-white font-sans antialiased selection:bg-blue-500 selection:text-white">

    <x-header />

    <main>
        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
            <!-- Background Glow -->
            <div class="absolute inset-0 hero-glow pointer-events-none"></div>

            <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-medium mb-8 animate-fade-in-up">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    Now with AI-Powered Team Robots
                </div>

                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-white mb-6 leading-tight max-w-4xl mx-auto">
                    Support your customers <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-400">without the chaos.</span>
                </h1>

                <p class="text-lg md:text-xl text-slate-400 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Ticket Hub is the modern help desk for teams that care. Delight your customers with a lightning-fast portal, powerful automation, and a design you'll actually enjoy using.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-500 text-white text-base font-semibold px-8 py-3.5 rounded-full transition-all shadow-xl shadow-blue-600/20 hover:scale-105">
                        Start Free Trial
                    </a>
                    <a href="{{ route('portal.index') }}" class="w-full sm:w-auto bg-slate-800/50 hover:bg-slate-800 text-white text-base font-semibold px-8 py-3.5 rounded-full border border-slate-700 transition-all hover:scale-105 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>
                        Explore Live Portals
                    </a>
                </div>
            </div>

            <!-- Abstract Dashboard Preview -->
            <div class="mt-20 relative max-w-6xl mx-auto px-6 lg:px-8">
                <div class="relative rounded-xl bg-slate-900 border border-slate-800 shadow-2xl shadow-blue-900/20 overflow-hidden aspect-[16/9] md:aspect-[2/1] group">
                    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <a href="{{ route('register') }}" class="bg-white text-slate-900 font-bold px-6 py-3 rounded-full shadow-xl transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">See the Dashboard</a>
                    </div>

                    <!-- Fake UI Elements -->
                    <div class="absolute top-0 left-0 w-64 h-full border-r border-slate-800 bg-slate-950/50 hidden md:block p-6">
                        <div class="space-y-4 opacity-40">
                            <div class="h-3 w-32 bg-slate-700 rounded"></div>
                            <div class="h-3 w-24 bg-slate-800 rounded"></div>
                            <div class="h-3 w-28 bg-slate-800 rounded"></div>
                            <div class="pt-8 h-3 w-20 bg-slate-700 rounded"></div>
                            <div class="h-3 w-32 bg-slate-800 rounded"></div>
                            <div class="h-3 w-24 bg-slate-800 rounded"></div>
                        </div>
                    </div>
                    <div class="absolute top-0 left-0 md:left-64 right-0 h-16 border-b border-slate-800 bg-slate-900/80 px-8 flex items-center">
                        <div class="h-4 w-32 bg-slate-800 rounded opacity-50"></div>
                    </div>
                    <div class="absolute top-24 left-8 md:left-72 right-8 space-y-4">
                        <!-- Mock Ticket 1 -->
                        <div class="p-4 rounded-xl bg-slate-800/50 border border-slate-700 flex items-center justify-between opacity-80">
                            <div class="flex items-center gap-4">
                                <div class="w-8 h-8 rounded-lg bg-blue-500/20 border border-blue-500/30 flex items-center justify-center text-blue-400 text-xs font-bold">#1</div>
                                <div class="space-y-2">
                                    <div class="h-3 w-48 bg-slate-600 rounded"></div>
                                    <div class="h-2 w-32 bg-slate-700 rounded"></div>
                                </div>
                            </div>
                            <div class="h-6 w-16 bg-blue-500/20 rounded-full border border-blue-500/30"></div>
                        </div>
                        <!-- Mock Ticket 2 -->
                        <div class="p-4 rounded-xl bg-slate-800/50 border border-slate-700 flex items-center justify-between opacity-60">
                            <div class="flex items-center gap-4">
                                <div class="w-8 h-8 rounded-lg bg-slate-700 border border-slate-600 flex items-center justify-center text-slate-400 text-xs font-bold">#2</div>
                                <div class="space-y-2">
                                    <div class="h-3 w-56 bg-slate-600 rounded"></div>
                                    <div class="h-2 w-40 bg-slate-700 rounded"></div>
                                </div>
                            </div>
                            <div class="h-6 w-16 bg-slate-700 rounded-full border border-slate-600"></div>
                        </div>
                        <!-- Mock Ticket 3 -->
                        <div class="p-4 rounded-xl bg-slate-800/50 border border-slate-700 flex items-center justify-between opacity-40">
                            <div class="flex items-center gap-4">
                                <div class="w-8 h-8 rounded-lg bg-slate-700 border border-slate-600 flex items-center justify-center text-slate-400 text-xs font-bold">#3</div>
                                <div class="space-y-2">
                                    <div class="h-3 w-40 bg-slate-600 rounded"></div>
                                    <div class="h-2 w-24 bg-slate-700 rounded"></div>
                                </div>
                            </div>
                            <div class="h-6 w-16 bg-slate-700 rounded-full border border-slate-600"></div>
                        </div>
                    </div>
                </div>
                <!-- Reflection -->
                <div class="absolute -bottom-20 inset-x-0 h-40 bg-gradient-to-t from-slate-950 to-transparent z-10"></div>
            </div>
        </section>

        <!-- Features Grid -->
        <section id="features" class="py-24 bg-slate-950 relative">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-blue-500 font-bold tracking-wide uppercase text-sm mb-3">Features</h2>
                    <h3 class="text-3xl md:text-4xl font-bold text-white tracking-tight">Everything you need to scale support.</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="p-8 rounded-3xl bg-slate-900/50 border border-slate-800 hover:border-blue-500/30 transition-colors group">
                        <div class="w-12 h-12 bg-blue-500/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-400"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3">Ticket Management</h4>
                        <p class="text-slate-400 leading-relaxed">
                            Triage with precision. Custom workflows, tags, and priorities ensure no customer request ever slips through the cracks.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-8 rounded-3xl bg-slate-900/50 border border-slate-800 hover:border-purple-500/30 transition-colors group">
                        <div class="w-12 h-12 bg-purple-500/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-purple-400"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3">Public Portals</h4>
                        <p class="text-slate-400 leading-relaxed">
                            Your brand, front and center. Provide a seamless, SEO-optimized support hub that builds trust with every interaction.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-8 rounded-3xl bg-slate-900/50 border border-slate-800 hover:border-green-500/30 transition-colors group">
                        <div class="w-12 h-12 bg-green-500/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-400"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3">Team Robots</h4>
                        <p class="text-slate-400 leading-relaxed">
                            Automate the mundane. API-first architecture lets you build custom bots to route, tag, and close tickets automatically.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Open Source / Pricing Section -->
        <section id="pricing" class="py-24 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-800 border border-slate-700 text-slate-400 text-xs font-bold uppercase tracking-widest mb-8">
                    Fair & Transparent
                </div>
                
                <h2 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-6">
                    Professional support tools. <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">Zero cost. Open Source.</span>
                </h2>
                
                <p class="text-lg text-slate-400 max-w-2xl mx-auto mb-12 leading-relaxed">
                    Ticket Hub is built for the community. Use it for free, host it yourself, or contribute to its development. No hidden fees, no per-seat pricing.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                    <!-- Card 1 -->
                    <div class="p-8 rounded-3xl bg-slate-900/50 border border-slate-800 hover:border-slate-700 transition-all text-left">
                        <div class="w-12 h-12 bg-white text-slate-900 rounded-xl flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/><path d="M9 18c-4.51 2-5-2-7-2"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Community Edition</h3>
                        <p class="text-slate-400 text-sm mb-6">Unrestricted access. Perfect for startups, indie hackers, and teams who want full control.</p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center gap-3 text-sm text-slate-300">
                                <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Unlimited Teams & Tickets
                            </li>
                            <li class="flex items-center gap-3 text-sm text-slate-300">
                                <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Public Portals
                            </li>
                            <li class="flex items-center gap-3 text-sm text-slate-300">
                                <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                API & Robot Access
                            </li>
                        </ul>
                        <a href="https://github.com/PMota173/ticket-hub" target="_blank" class="block w-full py-3 rounded-xl bg-slate-800 text-white text-center text-sm font-bold hover:bg-slate-700 transition-colors">
                            Star on GitHub
                        </a>
                    </div>

                    <!-- Card 2 -->
                    <div class="p-8 rounded-3xl bg-gradient-to-b from-blue-600/10 to-slate-900/50 border border-blue-500/30 hover:border-blue-500/50 transition-all text-left relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/20 blur-3xl rounded-full -mr-16 -mt-16"></div>
                        <div class="w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Sponsor the Project</h3>
                        <p class="text-slate-400 text-sm mb-6">Accelerate innovation. Your sponsorship directly funds new features, security audits, and the future of open-source support.</p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center gap-3 text-sm text-slate-300">
                                <svg class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                Priority Bug Fixes
                            </li>
                            <li class="flex items-center gap-3 text-sm text-slate-300">
                                <svg class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                Feature Requests
                            </li>
                            <li class="flex items-center gap-3 text-sm text-slate-300">
                                <svg class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                Badges on Profile
                            </li>
                        </ul>
                        <a href="https://github.com/PMota173" target="_blank" class="block w-full py-3 rounded-xl bg-blue-600 text-white text-center text-sm font-bold hover:bg-blue-500 transition-colors shadow-lg shadow-blue-500/20">
                            Become a Sponsor
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20">
            <div class="max-w-5xl mx-auto px-6 lg:px-8">
                <div class="relative rounded-3xl overflow-hidden bg-blue-600 px-6 py-16 md:px-16 text-center">
                    <!-- Decor -->
                    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
                    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>

                    <h2 class="relative text-3xl md:text-4xl font-bold text-white mb-6 tracking-tight">
                        Ready to upgrade your workflow?
                    </h2>
                    <p class="relative text-blue-100 text-lg mb-10 max-w-2xl mx-auto">
                        Deliver world-class support with a tool built for speed and transparency. Get started in less than 2 minutes.
                    </p>
                    <div class="relative flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('register') }}" class="bg-white text-blue-600 font-bold px-8 py-3.5 rounded-full hover:bg-blue-50 transition-colors shadow-xl">
                            Get Started for Free
                        </a>
                        <a href="{{ route('portal.index') }}" class="bg-blue-700 text-white font-bold px-8 py-3.5 rounded-full hover:bg-blue-800 transition-colors border border-blue-500">
                            Explore Teams
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-slate-950 border-t border-slate-900 py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-2 opacity-50 hover:opacity-100 transition-opacity">
                <div class="w-6 h-6 bg-slate-800 rounded flex items-center justify-center text-xs font-bold text-white">T</div>
                <span class="font-semibold text-white tracking-tight">Ticket Hub</span>
            </div>
            <p class="text-sm text-slate-500">
                &copy; {{ date('Y') }} Ticket Hub. Crafted with precision.
            </p>
        </div>
    </footer>

</body>
</html>
