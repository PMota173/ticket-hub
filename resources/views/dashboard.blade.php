<x-layouts.app title="Dashboard - {{ config('app.name', 'Ticket Hub') }}">
    <div class="mb-8">
        <h2 class="text-3xl font-bold tracking-tight text-white">Dashboard</h2>
        <p class="text-slate-400 mt-2">Overview of your support tickets.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Open Tickets -->
        <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-6 flex items-center justify-between hover:border-slate-600 transition-colors">
            <div>
                <p class="text-sm font-medium text-slate-400 mb-1">Open Tickets</p>
                <p class="text-3xl font-bold text-white">{{ $stats['open'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-blue-500/10 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="lucide lucide-ticket w-6 h-6 text-blue-500">
                    <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path>
                    <path d="M13 5v2"></path>
                    <path d="M13 17v2"></path>
                    <path d="M13 11v2"></path>
                </svg>
            </div>
        </div>

        <!-- In Progress -->
        <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-6 flex items-center justify-between hover:border-slate-600 transition-colors">
            <div>
                <p class="text-sm font-medium text-slate-400 mb-1">In Progress</p>
                <p class="text-3xl font-bold text-white">{{ $stats['in_progress'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-purple-500/10 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-6 h-6 text-purple-400">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
            </div>
        </div>

        <!-- Waiting -->
        <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-6 flex items-center justify-between hover:border-slate-600 transition-colors">
            <div>
                <p class="text-sm font-medium text-slate-400 mb-1">Waiting</p>
                <p class="text-3xl font-bold text-white">{{ $stats['waiting'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-orange-500/10 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert w-6 h-6 text-orange-400">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" x2="12" y1="8" y2="12"></line>
                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                </svg>
            </div>
        </div>

        <!-- Solved -->
        <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-6 flex items-center justify-between hover:border-slate-600 transition-colors">
            <div>
                <p class="text-sm font-medium text-slate-400 mb-1">Solved</p>
                <p class="text-3xl font-bold text-white">{{ $stats['closed'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-green-500/10 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check w-6 h-6 text-green-400">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="m9 12 2 2 4-4"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Recent Tickets List -->
    <div class="bg-slate-900/50 border border-slate-700 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-700">
            <h3 class="text-lg font-semibold text-white">Recent Tickets</h3>
        </div>
        
        @if($recentTickets->isEmpty())
            <div class="p-12 text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-slate-800 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-inbox w-6 h-6 text-slate-400">
                        <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                        <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-white mb-2">No tickets found</h3>
                <p class="text-slate-400 max-w-sm mx-auto mb-6">You haven't created any tickets yet. Create your first ticket to get started.</p>
                <x-blue-button href="/tickets/create">
                    Create Ticket
                </x-blue-button>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-950/50 text-slate-400 uppercase tracking-wider text-xs">
                        <tr>
                            <th class="px-6 py-4 font-medium">Title</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium">Priority</th>
                            <th class="px-6 py-4 font-medium">Created</th>
                            <th class="px-6 py-4 font-medium text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @foreach($recentTickets as $ticket)
                            <tr class="hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-white">{{ $ticket->title }}</div>
                                    <div class="text-xs text-slate-500 truncate max-w-xs">{{ Str::limit($ticket->description, 50) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($ticket->status === 'open') bg-blue-500/10 text-blue-400
                                        @elseif($ticket->status === 'in_progress') bg-purple-500/10 text-purple-400
                                        @elseif($ticket->status === 'waiting') bg-orange-500/10 text-orange-400
                                        @elseif($ticket->status === 'closed') bg-green-500/10 text-green-400
                                        @endif
                                    ">
                                        {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 text-xs font-medium
                                        @if($ticket->priority === 'high') text-red-400
                                        @elseif($ticket->priority === 'medium') text-yellow-400
                                        @else text-green-400
                                        @endif
                                    ">
                                        @if($ticket->priority === 'high')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg>
                                        @elseif($ticket->priority === 'medium')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus"><path d="M5 12h14"/></svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-down"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg>
                                        @endif
                                        {{ ucfirst($ticket->priority) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-400">
                                    {{ $ticket->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-slate-400 hover:text-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ellipsis-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layouts.app>