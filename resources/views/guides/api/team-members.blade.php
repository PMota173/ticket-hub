@extends('layouts.docs')

@section('content')
    <h1 class="text-3xl md:text-4xl font-black text-white mb-6">GET /team/members</h1>
    <p class="text-slate-400 text-lg mb-8 leading-relaxed">Get a list of all members in the robot's team. Useful for retrieving <code>assigned_id</code> values.</p>

    <h2 class="text-xl font-bold text-white mb-4">Request Examples</h2>
    <div id="block-members" class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden shadow-xl mb-10">
        <div class="flex border-b border-slate-800 bg-slate-950">
            <button onclick="switchTab('block-members', 'curl')" class="btn-curl tab-btn px-6 py-3 text-xs font-bold uppercase tracking-widest text-blue-400 border-b-2 border-blue-500 bg-blue-500/10">cURL</button>
            <button onclick="switchTab('block-members', 'js')" class="btn-js tab-btn px-6 py-3 text-xs font-bold uppercase tracking-widest text-slate-400 border-b-2 border-transparent hover:text-white">JavaScript</button>
            <button onclick="switchTab('block-members', 'py')" class="btn-py tab-btn px-6 py-3 text-xs font-bold uppercase tracking-widest text-slate-400 border-b-2 border-transparent hover:text-white">Python</button>
        </div>
        <div class="panel-curl code-panel p-6 overflow-x-auto">
            <pre class="text-sm font-mono text-slate-300">curl -X GET "{{ url('/api/v1/team/members') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"</pre>
        </div>
        <div class="panel-js code-panel hidden p-6 overflow-x-auto">
            <pre class="text-sm font-mono text-slate-300">fetch('{{ url('/api/v1/team/members') }}', {
    headers: {
        'Authorization': 'Bearer YOUR_TOKEN',
        'Accept': 'application/json'
    }
}).then(res => res.json());</pre>
        </div>
        <div class="panel-py code-panel hidden p-6 overflow-x-auto">
            <pre class="text-sm font-mono text-slate-300">requests.get(
    "{{ url('/api/v1/team/members') }}",
    headers={"Authorization": "Bearer YOUR_TOKEN", "Accept": "application/json"}
)</pre>
        </div>
    </div>

    <h2 class="text-xl font-bold text-white mb-4">Sample Response</h2>
    <div class="bg-slate-950 p-6 rounded-xl border border-slate-800 font-mono text-sm overflow-x-auto">
<pre class="text-blue-300">
[
  { <span class="text-green-400">"id"</span>: <span class="text-orange-300">1</span>, <span class="text-green-400">"name"</span>: <span class="text-orange-300">"Admin User"</span>, <span class="text-green-400">"email"</span>: <span class="text-orange-300">"admin@example.com"</span> },
  { <span class="text-green-400">"id"</span>: <span class="text-orange-300">5</span>, <span class="text-green-400">"name"</span>: <span class="text-orange-300">"Support Agent"</span>, <span class="text-green-400">"email"</span>: <span class="text-orange-300">"agent@example.com"</span> }
]</pre>
    </div>
@endsection

@section('pagination')
    <a href="{{ route('guides.api', 'tickets-comments-create') }}" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-white transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        Previous: POST /tickets/{id}/comments
    </a>
    <a href="{{ route('guides.show', 'api-reference') }}" class="flex items-center gap-2 text-sm font-bold text-blue-400 hover:text-white transition-colors">
        Back to API Index
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
@endsection
