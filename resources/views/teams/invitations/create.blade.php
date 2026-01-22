<x-layouts.app title="Invite Member - {{ $team->name }} - {{ config('app.name', 'Ticket Hub') }}">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold tracking-tight text-white">Invite Member</h2>
            <p class="text-slate-400 mt-2">Send an invitation to join {{ $team->name }}.</p>
        </div>
        <x-gray-button href="{{ route('invitations.index', $team) }}">
            Back to Invitations
        </x-gray-button>
    </div>

    <div class="max-w-2xl bg-slate-900/50 border border-slate-700 rounded-xl shadow-sm overflow-hidden">
        <form action="{{ route('invitations.store', $team) }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div>
                <x-form-input 
                    name="email" 
                    label="Email Address" 
                    type="email" 
                    placeholder="colleague@example.com" 
                    required 
                    autofocus
                />
                <p class="mt-2 text-sm text-slate-500">
                    An invitation link will be sent to this email address. The user will need to create an account if they don't have one.
                </p>
            </div>

            <div class="pt-4 flex justify-end">
                <x-blue-button type="submit">
                    Send Invitation
                </x-blue-button>
            </div>
        </form>
    </div>
</x-layouts.app>
