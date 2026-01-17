<x-layouts.app title="Ticket #{{ $ticket->id }} - {{ config('app.name', 'Ticket Hub') }}">
    <div class="mb-8">
        <x-back-button href="{{ route('tickets.index', $team) }}">Back to Board</x-back-button>
    </div>

    <div class="max-w-4xl">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold border
                        @if($ticket->status === 'open') text-blue-500 bg-blue-500/10 border-blue-500/20
                        @elseif($ticket->status === 'in_progress') text-purple-400 bg-purple-500/10 border-purple-500/20
                        @elseif($ticket->status === 'waiting') text-orange-400 bg-orange-500/10 border-orange-500/20
                        @elseif($ticket->status === 'closed') text-green-400 bg-green-500/10 border-green-500/20
                        @endif">
                        {{ str_replace('_', ' ', ucfirst($ticket->status)) }}
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border
                        @if($ticket->priority === 'high') bg-red-500/10 text-red-400 border-red-500/20
                        @elseif($ticket->priority === 'medium') bg-yellow-500/10 text-yellow-400 border-yellow-500/20
                        @else bg-green-500/10 text-green-400 border-green-500/20
                        @endif">
                        {{ ucfirst($ticket->priority) }} Priority
                    </span>
                </div>
                <h2 class="text-3xl font-bold tracking-tight text-white">{{ $ticket->title }}</h2>
                <div class="flex items-center gap-4 mt-2 text-sm text-slate-400">
                    <div class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-4 h-4"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <a href="{{ route('members.show', [$team, $ticket->user]) }}" class="hover:text-blue-400 transition-colors">
                            <span>{{ $ticket->user->name }}</span>
                        </a>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                        <span>Opened on {{ $ticket->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <x-gray-button href="{{ route('tickets.edit', [$team, $ticket]) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil w-4 h-4"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                    Edit
                </x-gray-button>
                
                <div class="h-8 w-px bg-slate-800 hidden md:block"></div>

                <form action="{{ route('tickets.update', [$team, $ticket]) }}" method="POST" class="flex items-center gap-3">
                    @csrf
                    @method('PATCH')
                    <label for="status" class="text-sm font-medium text-slate-400">Status:</label>
                    <select name="status" id="status" onchange="this.form.submit()" 
                        class="bg-slate-950/50 border border-slate-700 text-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 cursor-pointer appearance-none pr-8 relative bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%20fill%3D%22none%22%20stroke%3D%22%2394a3b8%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E')] bg-[length:1.25rem] bg-[right_0.5rem_center] bg-no-repeat">
                        <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="waiting" {{ $ticket->status === 'waiting' ? 'selected' : '' }}>Waiting</option>
                        <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="bg-slate-900/30 rounded-xl border border-slate-800 p-8">
            <h3 class="text-lg font-semibold text-slate-200 mb-4">Description</h3>
            <div class="prose prose-invert max-w-none text-slate-300 leading-relaxed">
                {!! nl2br(e($ticket->description)) !!}
            </div>
        </div>
    </div>
</x-layouts.app>
