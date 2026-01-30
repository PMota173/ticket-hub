@extends('layouts.docs')

@section('content')
    <h1 class="text-3xl md:text-4xl font-black text-white mb-6">POST /tickets/{id}/comments</h1>
    <p class="text-slate-400 text-lg mb-8 leading-relaxed">Add a new comment to a ticket thread.</p>

    <h2 class="text-xl font-bold text-white mb-4">Request Examples</h2>
    <div id="block-comment" class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden shadow-xl mb-10">
        <div class="flex border-b border-slate-800 bg-slate-950">
            <button onclick="switchTab('block-comment', 'curl')" class="btn-curl tab-btn px-6 py-3 text-xs font-bold uppercase tracking-widest text-blue-400 border-b-2 border-blue-500 bg-blue-500/10 transition-colors">cURL</button>
            <button onclick="switchTab('block-comment', 'js')" class="btn-js tab-btn px-6 py-3 text-xs font-bold uppercase tracking-widest text-slate-400 border-b-2 border-transparent hover:text-white transition-colors">JavaScript</button>
            <button onclick="switchTab('block-comment', 'py')" class="btn-py tab-btn px-6 py-3 text-xs font-bold uppercase tracking-widest text-slate-400 border-b-2 border-transparent hover:text-white transition-colors">Python</button>
        </div>
        <div class="panel-curl code-panel p-6 overflow-x-auto">
            <pre class="text-sm font-mono text-slate-300">curl -X POST "{{ url('/api/v1/tickets/1/comments') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{ "body": "This issue has been resolved in v1.2" }'</pre>
        </div>
        <div class="panel-js code-panel hidden p-6 overflow-x-auto">
            <pre class="text-sm font-mono text-slate-300">fetch('{{ url('/api/v1/tickets/1/comments') }}', {
    method: 'POST',
    headers: {
        'Authorization': 'Bearer YOUR_TOKEN',
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    },
    body: JSON.stringify({ body: 'This issue has been resolved in v1.2' })
}).then(res => res.json());</pre>
        </div>
        <div class="panel-py code-panel hidden p-6 overflow-x-auto">
            <pre class="text-sm font-mono text-slate-300">requests.post(
    "{{ url('/api/v1/tickets/1/comments') }}",
    headers={
        "Authorization": "Bearer YOUR_TOKEN",
        "Content-Type": "application/json",
        "Accept": "application/json"
    },
    json={"body": "This issue has been resolved in v1.2"}
)</pre>
        </div>
    </div>

    <h2 class="text-xl font-bold text-white mb-4">Sample Response</h2>
    <div class="bg-slate-950 p-6 rounded-xl border border-slate-800 font-mono text-sm overflow-x-auto">
<pre class="text-blue-300">
{
  <span class="text-green-400">"id"</span>: <span class="text-orange-300">9</span>,
  <span class="text-green-400">"body"</span>: <span class="text-orange-300">"This issue has been resolved in v1.2"</span>,
  <span class="text-green-400">"ticket_id"</span>: <span class="text-orange-300">1</span>,
  <span class="text-green-400">"author_id"</span>: <span class="text-orange-300">3</span>,
  <span class="text-green-400">"author_type"</span>: <span class="text-orange-300">"App\\Models\\TeamRobot"</span>,
  <span class="text-green-400">"created_at"</span>: <span class="text-orange-300">"2026-01-29T12:50:00.000Z"</span>,
  <span class="text-green-400">"updated_at"</span>: <span class="text-orange-300">"2026-01-29T12:50:00.000Z"</span>
}</pre>
    </div>
@endsection

@section('pagination')
    <a href="{{ route('guides.api', 'tickets-update') }}" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-white transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        Previous: PATCH /tickets/{id}
    </a>
    <a href="{{ route('guides.api', 'team-members') }}" class="flex items-center gap-2 text-sm font-bold text-blue-400 hover:text-white transition-colors">
        Next: GET /team/members
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
@endsection
