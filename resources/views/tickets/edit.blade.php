<x-layouts.app title="Edit Ticket #{{ $ticket->id }} - {{ config('app.name', 'Ticket Hub') }}">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-white">Edit Ticket #{{ $ticket->id }}</h1>
                <p class="text-slate-400 mt-2">Update the details of your support request.</p>
            </div>
            <x-back-button href="{{ route('tickets.show', [$team, $ticket]) }}">Cancel</x-back-button>
        </div>

        <!-- Form Card -->
        <div class="bg-slate-900/50 border border-slate-700 rounded-xl shadow-sm p-8">
            <form action="{{ route('tickets.update', [$team, $ticket]) }}" method="POST" class="space-y-8">
                @csrf
                @method('PATCH')
...
            <div class="mt-8 pt-8 border-t border-slate-800 flex items-center justify-between">
                <div class="text-sm">
                    <h4 class="text-white font-semibold">Danger Zone</h4>
                    <p class="text-slate-400">Once you delete a ticket, there is no going back. Please be certain.</p>
                </div>
                <button 
                    type="button" 
                    onclick="openModal('delete-ticket-modal', '{{ route('tickets.destroy', [$team, $ticket]) }}')" 
                    class="px-4 py-2 text-sm font-semibold text-red-500 border border-red-500/30 rounded-lg hover:bg-red-500/10 transition-all duration-200"
                >
                    Delete Ticket
                </button>
            </div>
        </div>
    </div>

    <x-confirm-modal 
        id="delete-ticket-modal" 
        title="Delete Ticket" 
        message="Are you sure you want to delete this ticket? This action cannot be undone." 
        confirmText="Delete Ticket" 
    />
</x-layouts.app>
