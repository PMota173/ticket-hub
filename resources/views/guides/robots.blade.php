@extends('layouts.docs')

@section('content')
    <h1 class="text-3xl md:text-4xl font-black text-white mb-6">Robots & Tokens</h1>
    
    <p class="text-slate-400 text-lg mb-8 leading-relaxed">
        Robots are API clients scoped to a single team. Use them to create and update tickets from external systems.
    </p>

    <!-- LIMITS -->
    <div class="bg-slate-900 border-l-4 border-purple-500 p-6 rounded-r-xl mb-12">
        <h3 class="font-bold text-white mb-2">🤖 Limit: 3 Robots per Team</h3>
        <p class="text-slate-400 text-sm">
            Each team can have up to 3 robots. Delete an existing robot to free a slot.
        </p>
    </div>

    <h2 class="text-2xl font-bold text-white mb-4 mt-12 flex items-center gap-3">
        <span class="w-8 h-1 bg-purple-500 rounded-full"></span>
        Managing Robots
    </h2>
    
    <div class="space-y-8">
        <div>
            <h3 class="text-lg font-bold text-white mb-2">Creating a Robot</h3>
            <p class="text-slate-400 text-sm mb-4">
                Only <strong>Team Admins</strong> can create robots. Go to <code>Team Settings > Robots</code> and create a new integration.
            </p>
            <div class="bg-red-500/10 border border-red-500/20 p-4 rounded-xl">
                <p class="text-red-300 text-xs font-bold">
                    ⚠️ IMPORTANT: The access token is shown ONLY once upon creation. If you lose it, you must delete and recreate the robot.
                </p>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-bold text-white mb-2">Revoking Access</h3>
            <p class="text-slate-400 text-sm">
                Deleting a robot immediately invalidates its token. Any external scripts using that token will start receiving <code>401 Unauthorized</code> errors.
            </p>
        </div>
    </div>

    <h2 class="text-2xl font-bold text-white mb-4 mt-12 flex items-center gap-3">
        <span class="w-8 h-1 bg-purple-500 rounded-full"></span>
        Token Usage
    </h2>

    <div class="bg-slate-900/50 p-6 rounded-2xl border border-slate-800 mb-8">
        <p class="text-slate-400 text-sm leading-relaxed">
            Use the robot token as a <code>Bearer</code> token in the <code>Authorization</code> header when calling the API. Each token is tied to the robot's team.
        </p>
    </div>

    <div class="mt-12 p-8 bg-blue-500/10 border border-blue-500/20 rounded-3xl text-center">
        <h3 class="text-xl font-bold text-white mb-2">Ready to start coding?</h3>
        <p class="text-slate-400 mb-6">Check out the full API reference for endpoints and parameters.</p>
        <a href="{{ route('guides.show', 'api-reference') }}" class="inline-flex bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-8 rounded-full transition-all shadow-lg hover:scale-105">
            View API Reference
        </a>
    </div>

@endsection

@section('pagination')
    <a href="{{ route('guides.show', 'portal') }}" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-white transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        Previous: Public Portal
    </a>
    <a href="{{ route('guides.show', 'api-reference') }}" class="flex items-center gap-2 text-sm font-bold text-blue-400 hover:text-white transition-colors">
        Next: API Reference
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
@endsection
