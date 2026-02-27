@extends('layouts.docs')

@section('content')
    <h1 class="opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] text-3xl font-display font-medium text-text-primary mb-6">GET /team/members</h1>
    <p class="text-text-secondary text-base mb-8 leading-relaxed">Get a list of all members in the robot's team. Useful for retrieving <code>assigned_id</code> values.</p>

    <h2 class="text-base font-display font-medium text-text-primary mb-4">Request Examples</h2>
    <div id="block-members" class="bg-surface-2 border border-border rounded-[6px] overflow-hidden shadow-xl mb-10">
        <div class="flex border-b border-border bg-bg">
            <button onclick="switchTab('block-members', 'curl')" class="btn-curl tab-btn px-6 py-3 text-[11px] font-mono uppercase tracking-[0.08em] text-accent border-b-2 border-accent bg-surface-2">cURL</button>
            <button onclick="switchTab('block-members', 'js')" class="btn-js tab-btn px-6 py-3 text-[11px] font-mono uppercase tracking-[0.08em] text-text-secondary border-b-2 border-transparent hover:text-accent-hover">JavaScript</button>
            <button onclick="switchTab('block-members', 'py')" class="btn-py tab-btn px-6 py-3 text-[11px] font-mono uppercase tracking-[0.08em] text-text-secondary border-b-2 border-transparent hover:text-accent-hover">Python</button>
        </div>
        <div class="panel-curl code-panel p-6 overflow-x-auto">
            <pre class="text-[13px] font-mono text-text-primary">curl -X GET "{{ url('/api/v1/team/members') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"</pre>
        </div>
        <div class="panel-js code-panel hidden p-6 overflow-x-auto">
            <pre class="text-[13px] font-mono text-text-primary">fetch('{{ url('/api/v1/team/members') }}', {
    headers: {
        'Authorization': 'Bearer YOUR_TOKEN',
        'Accept': 'application/json'
    }
}).then(res => res.json());</pre>
        </div>
        <div class="panel-py code-panel hidden p-6 overflow-x-auto">
            <pre class="text-[13px] font-mono text-text-primary">requests.get(
    "{{ url('/api/v1/team/members') }}",
    headers={"Authorization": "Bearer YOUR_TOKEN", "Accept": "application/json"}
)</pre>
        </div>
    </div>

    <h2 class="text-base font-display font-medium text-text-primary mb-4">Sample Response</h2>
    <div class="bg-bg p-6 rounded-[6px] border border-border font-mono text-[13px] overflow-x-auto">
<pre class="text-accent">
[
  { <span class="text-success">"id"</span>: <span class="text-warning">1</span>, <span class="text-success">"name"</span>: <span class="text-warning">"Admin User"</span>, <span class="text-success">"email"</span>: <span class="text-warning">"admin@example.com"</span> },
  { <span class="text-success">"id"</span>: <span class="text-warning">5</span>, <span class="text-success">"name"</span>: <span class="text-warning">"Support Agent"</span>, <span class="text-success">"email"</span>: <span class="text-warning">"agent@example.com"</span> }
]</pre>
    </div>
@endsection

@section('pagination')
    <a href="{{ route('guides.api', 'tickets-comments-create') }}" class="flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.08em] text-text-muted hover:text-accent-hover transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        Previous: POST /tickets/{id}/comments
    </a>
    <a href="{{ route('guides.show', 'api-reference') }}" class="flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.08em] text-accent hover:text-accent-hover transition-colors">
        Back to API Index
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
@endsection
