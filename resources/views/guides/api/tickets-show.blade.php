@extends('layouts.docs')

@section('content')
    <h1 class="opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] text-3xl font-display font-medium text-text-primary mb-6">GET /tickets/{id}</h1>
    <p class="text-text-secondary text-base mb-8 leading-relaxed">Retrieve a specific ticket by ID. The response does not include comments.</p>

    <h2 class="text-base font-display font-medium text-text-primary mb-4">Request Examples</h2>
    <div id="block-show" class="bg-surface-2 border border-border rounded-[6px] overflow-hidden shadow-xl mb-10">
        <div class="flex border-b border-border bg-bg">
            <button onclick="switchTab('block-show', 'curl')" class="btn-curl tab-btn px-6 py-3 text-[11px] font-mono uppercase tracking-[0.08em] text-accent border-b-2 border-accent bg-surface-2">cURL</button>
            <button onclick="switchTab('block-show', 'js')" class="btn-js tab-btn px-6 py-3 text-[11px] font-mono uppercase tracking-[0.08em] text-text-secondary border-b-2 border-transparent hover:text-accent-hover">JavaScript</button>
            <button onclick="switchTab('block-show', 'py')" class="btn-py tab-btn px-6 py-3 text-[11px] font-mono uppercase tracking-[0.08em] text-text-secondary border-b-2 border-transparent hover:text-accent-hover">Python</button>
        </div>
        <div class="panel-curl code-panel p-6 overflow-x-auto">
            <pre class="text-[13px] font-mono text-text-primary">curl -X GET "{{ url('/api/v1/tickets/1') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"</pre>
        </div>
        <div class="panel-js code-panel hidden p-6 overflow-x-auto">
            <pre class="text-[13px] font-mono text-text-primary">fetch('{{ url('/api/v1/tickets/1') }}', {
    headers: {
        'Authorization': 'Bearer YOUR_TOKEN',
        'Accept': 'application/json'
    }
}).then(res => res.json());</pre>
        </div>
        <div class="panel-py code-panel hidden p-6 overflow-x-auto">
            <pre class="text-[13px] font-mono text-text-primary">requests.get(
    "{{ url('/api/v1/tickets/1') }}",
    headers={"Authorization": "Bearer YOUR_TOKEN", "Accept": "application/json"}
)</pre>
        </div>
    </div>

    <h2 class="text-base font-display font-medium text-text-primary mb-4">Sample Response</h2>
    <div class="bg-bg p-6 rounded-[6px] border border-border font-mono text-[13px] overflow-x-auto">
<pre class="text-accent">
{
  <span class="text-success">"id"</span>: <span class="text-warning">1</span>,
  <span class="text-success">"title"</span>: <span class="text-warning">"Fix Login Bug"</span>,
  <span class="text-success">"description"</span>: <span class="text-warning">"Login fails for admin accounts."</span>,
  <span class="text-success">"status"</span>: <span class="text-warning">"open"</span>,
  <span class="text-success">"priority"</span>: <span class="text-warning">"high"</span>,
  <span class="text-success">"author_id"</span>: <span class="text-warning">3</span>,
  <span class="text-success">"author_type"</span>: <span class="text-warning">"App\\Models\\TeamRobot"</span>,
  <span class="text-success">"assigned_id"</span>: <span class="text-warning">5</span>,
  <span class="text-success">"team_id"</span>: <span class="text-warning">2</span>,
  <span class="text-success">"created_at"</span>: <span class="text-warning">"2026-01-29T12:00:00.000Z"</span>,
  <span class="text-success">"updated_at"</span>: <span class="text-warning">"2026-01-29T12:00:00.000Z"</span>
}</pre>
    </div>
@endsection

@section('pagination')
    <a href="{{ route('guides.api', 'tickets-list') }}" class="flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.08em] text-text-muted hover:text-accent-hover transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        Previous: GET /tickets
    </a>
    <a href="{{ route('guides.api', 'tickets-create') }}" class="flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.08em] text-accent hover:text-accent-hover transition-colors">
        Next: POST /tickets
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
@endsection
