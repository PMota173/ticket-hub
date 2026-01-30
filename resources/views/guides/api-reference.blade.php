@extends('layouts.docs')

@section('content')
    <h1 class="text-3xl md:text-4xl font-black text-white mb-6">API Reference</h1>
    <p class="text-slate-400 text-lg mb-12 leading-relaxed">
        Reference for the Ticket Hub API v1. All requests must be JSON and include a Robot token.
    </p>

    <!-- Base URL -->
    <div class="mb-12">
        <h2 class="text-xl font-bold text-white mb-4">Base URL</h2>
        <div class="bg-slate-950 border border-slate-800 rounded-xl p-4 font-mono text-sm text-blue-300">
            {{ url('/api/v1') }}
        </div>
    </div>

    <h2 class="text-2xl font-bold text-white mb-4 mt-12">Endpoints</h2>
    <p class="text-slate-400 mb-8">Each request has its own page with request examples and sample responses.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('guides.api', 'tickets-list') }}" class="block bg-slate-900/50 border border-slate-800 rounded-3xl p-6 hover:border-blue-500/50 hover:bg-slate-900 transition-all">
            <div class="flex items-center gap-3 mb-2">
                <span class="bg-blue-500/10 text-blue-400 border border-blue-500/20 px-2.5 py-1 rounded text-xs font-bold font-mono">GET</span>
                <h3 class="text-lg font-bold text-white">/tickets</h3>
            </div>
            <p class="text-slate-400 text-sm">List all tickets for the robot's team.</p>
        </a>
        <a href="{{ route('guides.api', 'tickets-show') }}" class="block bg-slate-900/50 border border-slate-800 rounded-3xl p-6 hover:border-blue-500/50 hover:bg-slate-900 transition-all">
            <div class="flex items-center gap-3 mb-2">
                <span class="bg-blue-500/10 text-blue-400 border border-blue-500/20 px-2.5 py-1 rounded text-xs font-bold font-mono">GET</span>
                <h3 class="text-lg font-bold text-white">/tickets/{id}</h3>
            </div>
            <p class="text-slate-400 text-sm">Fetch a single ticket by ID.</p>
        </a>
        <a href="{{ route('guides.api', 'tickets-create') }}" class="block bg-slate-900/50 border border-slate-800 rounded-3xl p-6 hover:border-green-500/50 hover:bg-slate-900 transition-all">
            <div class="flex items-center gap-3 mb-2">
                <span class="bg-green-500/10 text-green-400 border border-green-500/20 px-2.5 py-1 rounded text-xs font-bold font-mono">POST</span>
                <h3 class="text-lg font-bold text-white">/tickets</h3>
            </div>
            <p class="text-slate-400 text-sm">Create a new ticket.</p>
        </a>
        <a href="{{ route('guides.api', 'tickets-update') }}" class="block bg-slate-900/50 border border-slate-800 rounded-3xl p-6 hover:border-purple-500/50 hover:bg-slate-900 transition-all">
            <div class="flex items-center gap-3 mb-2">
                <span class="bg-purple-500/10 text-purple-400 border border-purple-500/20 px-2.5 py-1 rounded text-xs font-bold font-mono">PATCH</span>
                <h3 class="text-lg font-bold text-white">/tickets/{id}</h3>
            </div>
            <p class="text-slate-400 text-sm">Update ticket fields.</p>
        </a>
        <a href="{{ route('guides.api', 'tickets-comments-create') }}" class="block bg-slate-900/50 border border-slate-800 rounded-3xl p-6 hover:border-green-500/50 hover:bg-slate-900 transition-all">
            <div class="flex items-center gap-3 mb-2">
                <span class="bg-green-500/10 text-green-400 border border-green-500/20 px-2.5 py-1 rounded text-xs font-bold font-mono">POST</span>
                <h3 class="text-lg font-bold text-white">/tickets/{id}/comments</h3>
            </div>
            <p class="text-slate-400 text-sm">Create a comment for a ticket.</p>
        </a>
        <a href="{{ route('guides.api', 'team-members') }}" class="block bg-slate-900/50 border border-slate-800 rounded-3xl p-6 hover:border-blue-500/50 hover:bg-slate-900 transition-all">
            <div class="flex items-center gap-3 mb-2">
                <span class="bg-blue-500/10 text-blue-400 border border-blue-500/20 px-2.5 py-1 rounded text-xs font-bold font-mono">GET</span>
                <h3 class="text-lg font-bold text-white">/team/members</h3>
            </div>
            <p class="text-slate-400 text-sm">List members for assignment lookups.</p>
        </a>
    </div>

@endsection

@section('pagination')
    <a href="{{ route('guides.show', 'robots') }}" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-white transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        Previous: Robots & Tokens
    </a>
    <div></div>
@endsection
