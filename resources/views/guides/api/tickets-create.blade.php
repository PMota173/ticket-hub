@extends('layouts.docs')

@section('content')
    <h1 class="opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] text-3xl font-display font-medium text-text-primary mb-6">POST /tickets</h1>
    <p class="text-text-secondary text-base mb-8 leading-relaxed">Create a new ticket for the robot's team.</p>

    <h2 class="text-base font-display font-medium text-text-primary mb-4">Body Parameters</h2>
    <div class="overflow-hidden rounded-[6px] border border-border mb-8 shadow-lg">
        <table class="w-full text-left text-[13px] text-text-secondary">
            <thead class="bg-bg text-text-primary uppercase tracking-[0.08em] font-bold text-xs">
                <tr>
                    <th class="px-6 py-3">Field</th>
                    <th class="px-6 py-3">Rules</th>
                    <th class="px-6 py-3">Description</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border bg-surface-1">
                <tr>
                    <td class="px-6 py-4 font-mono text-text-primary">title</td>
                    <td class="px-6 py-4 text-[#B07BFF]">required, string, max:255</td>
                    <td class="px-6 py-4">The headline of the issue.</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-mono text-text-primary">description</td>
                    <td class="px-6 py-4 text-[#B07BFF]">required, string</td>
                    <td class="px-6 py-4">Full details of the issue. The database requires a value.</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-mono text-text-primary">priority</td>
                    <td class="px-6 py-4 text-[#B07BFF]">string</td>
                    <td class="px-6 py-4">Defaults to <code>low</code> when omitted. Recommended: <code>low</code>, <code>medium</code>, <code>high</code>, <code>urgent</code>.</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-mono text-text-primary">assigned_id</td>
                    <td class="px-6 py-4 text-[#B07BFF]">nullable, exists:users,id</td>
                    <td class="px-6 py-4">User ID to assign the ticket to. Must belong to the same team.</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="text-text-secondary text-[13px] mb-8">Status is not set via this endpoint and defaults to <code>open</code>.</p>

    <h2 class="text-base font-display font-medium text-text-primary mb-4">Request Examples</h2>
    <div id="block-create" class="bg-surface-2 border border-border rounded-[6px] overflow-hidden shadow-xl mb-10">
        <div class="flex border-b border-border bg-bg">
            <button onclick="switchTab('block-create', 'curl')" class="btn-curl tab-btn px-6 py-3 text-[11px] font-mono uppercase tracking-[0.08em] text-accent border-b-2 border-accent bg-surface-2">cURL</button>
            <button onclick="switchTab('block-create', 'js')" class="btn-js tab-btn px-6 py-3 text-[11px] font-mono uppercase tracking-[0.08em] text-text-secondary border-b-2 border-transparent hover:text-accent-hover">JavaScript</button>
            <button onclick="switchTab('block-create', 'py')" class="btn-py tab-btn px-6 py-3 text-[11px] font-mono uppercase tracking-[0.08em] text-text-secondary border-b-2 border-transparent hover:text-accent-hover">Python</button>
        </div>
        <div class="panel-curl code-panel p-6 overflow-x-auto">
<pre class="text-[13px] font-mono text-text-primary">curl -X POST "{{ url('/api/v1/tickets') }}" \
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
<pre class="text-[13px] font-mono text-text-primary">fetch('{{ url('/api/v1/tickets') }}', {
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
<pre class="text-[13px] font-mono text-text-primary">requests.post(
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

    <h2 class="text-base font-display font-medium text-text-primary mb-4">Sample Response</h2>
    <div class="bg-bg p-6 rounded-[6px] border border-border font-mono text-[13px] overflow-x-auto">
<pre class="text-accent">
{
  <span class="text-success">"id"</span>: <span class="text-warning">12</span>,
  <span class="text-success">"title"</span>: <span class="text-warning">"Critical Bug"</span>,
  <span class="text-success">"description"</span>: <span class="text-warning">"System is down."</span>,
  <span class="text-success">"status"</span>: <span class="text-warning">"open"</span>,
  <span class="text-success">"priority"</span>: <span class="text-warning">"urgent"</span>,
  <span class="text-success">"author_id"</span>: <span class="text-warning">3</span>,
  <span class="text-success">"author_type"</span>: <span class="text-warning">"App\\Models\\TeamRobot"</span>,
  <span class="text-success">"assigned_id"</span>: <span class="text-warning">null</span>,
  <span class="text-success">"team_id"</span>: <span class="text-warning">2</span>,
  <span class="text-success">"created_at"</span>: <span class="text-warning">"2026-01-29T12:34:56.000Z"</span>,
  <span class="text-success">"updated_at"</span>: <span class="text-warning">"2026-01-29T12:34:56.000Z"</span>
}</pre>
    </div>
@endsection

@section('pagination')
    <a href="{{ route('guides.api', 'tickets-show') }}" class="flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.08em] text-text-muted hover:text-accent-hover transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        Previous: GET /tickets/{id}
    </a>
    <a href="{{ route('guides.api', 'tickets-update') }}" class="flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.08em] text-accent hover:text-accent-hover transition-colors">
        Next: PATCH /tickets/{id}
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
@endsection
