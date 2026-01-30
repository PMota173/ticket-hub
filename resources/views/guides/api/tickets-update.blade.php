@extends('layouts.docs')

@section('content')
    <h1 class="text-3xl md:text-4xl font-black text-white mb-6">PATCH /tickets/{id}</h1>
    <p class="text-slate-400 text-lg mb-8 leading-relaxed">Update a ticket's fields. Status and priority are strings.</p>

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
                    <td class="px-6 py-4 text-purple-400">string, max:255</td>
                    <td class="px-6 py-4">Update the ticket title.</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-mono text-white">description</td>
                    <td class="px-6 py-4 text-purple-400">string</td>
                    <td class="px-6 py-4">Update the ticket description.</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-mono text-white">priority</td>
                    <td class="px-6 py-4 text-purple-400">string</td>
                    <td class="px-6 py-4">Recommended: <code>low</code>, <code>medium</code>, <code>high</code>, <code>urgent</code>.</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-mono text-white">status</td>
                    <td class="px-6 py-4 text-purple-400">string</td>
                    <td class="px-6 py-4">Recommended: <code>open</code>, <code>in_progress</code>, <code>waiting</code>, <code>closed</code>.</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-mono text-white">assigned_id</td>
                    <td class="px-6 py-4 text-purple-400">nullable, exists:users,id</td>
                    <td class="px-6 py-4">User ID to assign the ticket to. Must belong to the same team.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2 class="text-xl font-bold text-white mb-4">Request Examples</h2>
    <div id="block-update" class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden shadow-xl mb-10">
        <div class="flex border-b border-slate-800 bg-slate-950">
            <button onclick="switchTab('block-update', 'curl')" class="btn-curl tab-btn px-6 py-3 text-xs font-bold uppercase tracking-widest text-blue-400 border-b-2 border-blue-500 bg-blue-500/10">cURL</button>
            <button onclick="switchTab('block-update', 'js')" class="btn-js tab-btn px-6 py-3 text-xs font-bold uppercase tracking-widest text-slate-400 border-b-2 border-transparent hover:text-white">JavaScript</button>
            <button onclick="switchTab('block-update', 'py')" class="btn-py tab-btn px-6 py-3 text-xs font-bold uppercase tracking-widest text-slate-400 border-b-2 border-transparent hover:text-white">Python</button>
        </div>
        <div class="panel-curl code-panel p-6 overflow-x-auto">
<pre class="text-sm font-mono text-slate-300">curl -X PATCH "{{ url('/api/v1/tickets/1') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{ "status": "in_progress", "assigned_id": 5 }'</pre>
        </div>
        <div class="panel-js code-panel hidden p-6 overflow-x-auto">
<pre class="text-sm font-mono text-slate-300">fetch('{{ url('/api/v1/tickets/1') }}', {
    method: 'PATCH',
    headers: {
        'Authorization': 'Bearer YOUR_TOKEN',
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    },
    body: JSON.stringify({ status: 'in_progress', assigned_id: 5 })
}).then(res => res.json());</pre>
        </div>
        <div class="panel-py code-panel hidden p-6 overflow-x-auto">
<pre class="text-sm font-mono text-slate-300">requests.patch(
    "{{ url('/api/v1/tickets/1') }}",
    headers={
        "Authorization": "Bearer YOUR_TOKEN",
        "Content-Type": "application/json",
        "Accept": "application/json"
    },
    json={"status": "in_progress", "assigned_id": 5}
)</pre>
        </div>
    </div>

    <h2 class="text-xl font-bold text-white mb-4">Sample Response</h2>
    <div class="bg-slate-950 p-6 rounded-xl border border-slate-800 font-mono text-sm overflow-x-auto">
<pre class="text-blue-300">
{
  <span class="text-green-400">"id"</span>: <span class="text-orange-300">1</span>,
  <span class="text-green-400">"title"</span>: <span class="text-orange-300">"Fix Login Bug"</span>,
  <span class="text-green-400">"description"</span>: <span class="text-orange-300">"Login fails for admin accounts."</span>,
  <span class="text-green-400">"status"</span>: <span class="text-orange-300">"in_progress"</span>,
  <span class="text-green-400">"priority"</span>: <span class="text-orange-300">"high"</span>,
  <span class="text-green-400">"author_id"</span>: <span class="text-orange-300">3</span>,
  <span class="text-green-400">"author_type"</span>: <span class="text-orange-300">"App\\Models\\TeamRobot"</span>,
  <span class="text-green-400">"assigned_id"</span>: <span class="text-orange-300">5</span>,
  <span class="text-green-400">"team_id"</span>: <span class="text-orange-300">2</span>,
  <span class="text-green-400">"created_at"</span>: <span class="text-orange-300">"2026-01-29T12:00:00.000Z"</span>,
  <span class="text-green-400">"updated_at"</span>: <span class="text-orange-300">"2026-01-29T12:40:00.000Z"</span>
}</pre>
    </div>
@endsection

@section('pagination')
    <a href="{{ route('guides.api', 'tickets-create') }}" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-white transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        Previous: POST /tickets
    </a>
    <a href="{{ route('guides.api', 'tickets-comments-create') }}" class="flex items-center gap-2 text-sm font-bold text-blue-400 hover:text-white transition-colors">
        Next: POST /tickets/{id}/comments
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
@endsection
