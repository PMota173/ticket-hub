<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>
<body class="text-white flex min-h-screen flex-col">
    <x-header />

    <main class="flex-1 flex flex-col items-center py-10 px-6 lg:px-8">
        <div class="flex flex-col items-center space-y-15 mt-10">
            <div class="text-center space-y-10">
        <h1 class="text-6xl font-bold tracking-tight">Support Made Simple</h1>
        <p class="text-slate-400 text-lg max-w-xl leading-relaxed">Manage customer support tickets efficiently with our modern,
            intuitive help desk system. Built for teams that value simplicity and productivity.</p>
    </div>

    <div class="flex space-x-4">
        <x-blue-button href="/register">
            Get Started Free
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="lucide lucide-arrow-right w-4 h-4"
                 data-fg-dlp228="13.10:13.8386:/components/Welcome.tsx:60:15:2514:34:e:ArrowRight::::::D6KF">
                <path d="M5 12h14"></path>
                <path d="m12 5 7 7-7 7"></path>
            </svg>
        </x-blue-button>

        <x-gray-button href="/login">
            Sign in
        </x-gray-button>
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-20 w-full max-w-5xl mx-auto">
    <x-welcome-card>
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="lucide lucide-ticket w-10 h-10 text-blue-400 bg-blue-400/10 p-2 rounded-xl"
             data-fg-dlp236="13.10:13.8386:/components/Welcome.tsx:76:15:3180:44:e:Ticket::::::Bohk">
            <path
                d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path>
            <path d="M13 5v2"></path>
            <path d="M13 17v2"></path>
            <path d="M13 11v2"></path>
        </svg>
        <h3>Ticket Management</h3>
        <p>Create, track, and manage support tickets with ease. Keep everything organized in one central location.</p>
    </x-welcome-card>

    <x-welcome-card>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="lucide lucide-circle-check w-10 h-10 text-purple-400 bg-purple-400/10 p-2 rounded-xl"
             data-fg-dlp244="13.10:13.8386:/components/Welcome.tsx:87:15:3754:52:e:CheckCircle2::::::CGcY">
            <circle cx="12" cy="12" r="10"></circle>
            <path d="m9 12 2 2 4-4"></path>
        </svg>
        <h3>Kanban Board</h3>
        <p>Visualize your workflow with an intuitive drag-and-drop Kanban board. Update ticket statuses instantly.</p>
    </x-welcome-card>

    <x-welcome-card>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="lucide lucide-users w-10 h-10 text-green-400 bg-green-400/10 p-2 rounded-xl"
             data-fg-dlp252="13.10:13.8386:/components/Welcome.tsx:98:15:4330:44:e:Users::::::CM90">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
        </svg>
        <h3>Team Collaboration</h3>
        <p>Work together seamlessly with your support team. Assign tickets and track conversations in real-time.</p>
    </x-welcome-card>
</div>

<div class="bg-slate-700 max-w-6xl h-px w-full mx-auto my-20"></div>

<div
    class="flex flex-col items-center text-center space-y-6 border border-slate-700 bg-slate-400/5 p-10 rounded-lg max-w-4xl mx-auto">
    <h2 class="text-4xl font-bold tracking-tight">Ready to streamline your support?</h2>
    <p class="text-slate-400 text-lg leading-relaxed">Join teams that trust Help Desk to manage their customer support efficiently. Get started in minutes with no
        credit card required.</p>
    <x-blue-button href="/register">
        Create Your Account
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="lucide lucide-arrow-right w-4 h-4"
             data-fg-dlp228="13.10:13.8386:/components/Welcome.tsx:60:15:2514:34:e:ArrowRight::::::D6KF">
            <path d="M5 12h14"></path>
            <path d="m12 5 7 7-7 7"></path>
        </svg>
    </x-blue-button>
</div>
    </main>
</body>
</html>
