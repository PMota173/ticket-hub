@extends('layouts.docs')

@section('content')
    <h1 class="text-3xl md:text-4xl font-black text-white mb-6">POST /tickets</h1>
    <p class="text-slate-400 text-lg mb-8 leading-relaxed">Create a new ticket for the robot's team.</p>

    <h2 class="text-xl font-bold text-white mb-4">Body Parameters</h2>
    <div class="overflow-hidden rounded-xl border border-slate-800 mb-8 shadow-lg">
        <table class="w-full text-left text-sm text-slate-400">
            <thead class="bg-slate-950 text-slate-200 uppercase tracking-widest font-bold text-xs">
                <tr>
                    <th class="px-6 py-3">Field</th>
                    <th class="px-6 py-3">Rules</th>
                    <th class="px-6 py-3">Description</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800 bg-slate-900/50">
                <tr>
                    <td class="px-6 py-4 font-mono text-white">title</td>
                    <td class="px-6 py-4 text-purple-400">required, string, max:255</td>
                    <td class="px-6 py-4">The headline of the issue.</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-mono text-white">description</td>
                    <td class="px-6 py-4 text-purple-400">required, string</td>
                    <td class="px-6 py-4">Full details of the issue. The database requires a value.</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-mono text-white">priority</td>
                    <td class="px-6 py-4 text-purple-400">string</td>
                    <td class="px-6 py-4">Defaults to <code>low</code> when omitted. Recommended: <code>low</code>, <code>medium</code>, <code>high</code>, <code>urgent</code>.</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-mono text-white">assigned_id</td>
                    <td class="px-6 py-4 text-purple-400">nullable, exists:users,id</td>
                    <td class="px-6 py-4">User ID to assign the ticket to. Must belong to the same team.</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="text-slate-400 text-sm mb-8">Status is not set via this endpoint and defaults to <code>open</code>.</p>

    <h2 class="text-xl font-bold text-white mb-4">Request Examples</h2>
    <div id="block-create" class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden shadow-xl mb-10">
        <div class="flex border-b border-slate-800 bg-slate-950">
            <button onclick="switchTab('block-create', 'curl')" class="btn-curl tab-btn px-6 py-3 text-xs font-bold uppercase tracking-widest text-blue-400 border-b-2 border-blue-500 bg-blue-500/10">cURL</button>
            <button onclick="switchTab('block-create', 'js')" class="btn-js tab-btn px-6 py-3 text-xs font-bold uppercase tracking-widest text-slate-400 border-b-2 border-transparent hover:text-white">JavaScript</button>
            <button onclick="switchTab('block-create', 'py')" class="btn-py tab-btn px-6 py-3 text-xs font-bold uppercase tracking-widest text-slate-400 border-b-2 border-transparent hover:text-white">Python</button>
        </div>
        <div class="panel-curl code-panel p-6 overflow-x-auto">
<pre class="text-sm font-mono text-slate-300">curl -X POST "{{ url('/api/v1/tickets') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{ 
    "title": "Critical Bug",
    "description": "System is down.",
    "priority": "urgent"
  }'</pre>
        </div>
        <div class="panel-js code-panel hidden p-6 overflow-x-auto">
<pre class="text-sm font-mono text-slate-300">fetch('{{ url('/api/v1/tickets') }}', {
    method: 'POST',
    headers: {
        'Authorization': 'Bearer YOUR_TOKEN',
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    },
    body: JSON.stringify({
        title: 'Critical Bug',
        description: 'System is down.',
        priority: 'urgent'
    })
}).then(res => res.json());</pre>
        </div>
        <div class="panel-py code-panel hidden p-6 overflow-x-auto">
<pre class="text-sm font-mono text-slate-300">requests.post(
    "{{ url('/api/v1/tickets') }}",
    headers={
        "Authorization": "Bearer YOUR_TOKEN",
        "Content-Type": "application/json",
        "Accept": "application/json"
    },
    json={
        "title": "Critical Bug",
        "description": "System is down.",
        "priority": "urgent"
    }
)</pre>
        </div>
    </div>

    <h2 class="text-xl font-bold text-white mb-4">Sample Response</h2>
    <div class="bg-slate-950 p-6 rounded-xl border border-slate-800 font-mono text-sm overflow-x-auto">
<pre class="text-blue-300">
{
  <span class="text-green-400">"id"</span>: <span class="text-orange-300">12</span>,
  <span class="text-green-400">"title"</span>: <span class="text-orange-300">"Critical Bug"</span>,
  <span class="text-green-400">"description"</span>: <span class="text-orange-300">"System is down."</span>,
  <span class="text-green-400">"status"</span>: <span class="text-orange-300">"open"</span>,
  <span class="text-green-400">"priority"</span>: <span class="text-orange-300">"urgent"</span>,
  <span class="text-green-400">"author_id"</span>: <span class="text-orange-300">3</span>,
  <span class="text-green-400">"author_type"</span>: <span class="text-orange-300">"App\\Models\\TeamRobot"</span>,
  <span class="text-green-400">"assigned_id"</span>: <span class="text-orange-300">null</span>,
  <span class="text-green-400">"team_id"</span>: <span class="text-orange-300">2</span>,
  <span class="text-green-400">"created_at"</span>: <span class="text-orange-300">"2026-01-29T12:34:56.000Z"</span>,
  <span class="text-green-400">"updated_at"</span>: <span class="text-orange-300">"2026-01-29T12:34:56.000Z"</span>
}</pre>
    </div>
@endsection

@section('pagination')
    <a href="{{ route('guides.api', 'tickets-show') }}" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-white transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        Previous: GET /tickets/{id}
    </a>
    <a href="{{ route('guides.api', 'tickets-update') }}" class="flex items-center gap-2 text-sm font-bold text-blue-400 hover:text-white transition-colors">
        Next: PATCH /tickets/{id}
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
@endsection
