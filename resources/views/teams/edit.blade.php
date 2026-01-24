<x-layouts.app title="Edit Team - {{ config('app.name', 'Ticket Hub') }}" sidebar="global">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">Edit Team</h1>
            <p class="text-slate-400 mt-2">Update your workspace settings and information.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-slate-900/50 border border-slate-700 rounded-xl shadow-sm p-8">
            <form action="{{ route('teams.update', $team) }}" method="POST" class="space-y-8">
                @csrf
                @method('PATCH')

                <!-- Name & Description -->
                <div class="space-y-6">
                    <x-form-input name="name" label="Team Name" :value="$team->name" placeholder="Acme Corp Support" required />

                    <div class="space-y-2">
                        <label for="description" class="text-sm font-medium text-slate-300">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="w-full bg-slate-950/50 border border-slate-700 text-white rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 placeholder:text-slate-500 resize-none"
                            placeholder="Briefly describe what this team is for..."
                        >{{ old('description', $team->description) }}</textarea>
                    </div>

                    <x-form-input name="logo" label="Logo URL" :value="$team->logo" placeholder="https://example.com/logo.png" />

                    <!-- Private Toggle -->
                    <div class="flex items-center justify-between p-4 bg-slate-950/30 rounded-lg border border-slate-700/50">
                        <div>
                            <label for="is_private" class="font-medium text-slate-300">Private Team</label>
                            <p class="text-sm text-slate-500">Only invited members can find and join this team.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_private" id="is_private" value="1" class="sr-only peer" {{ old('is_private', $team->is_private) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-slate-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-800">
                    <a href="{{ route('teams.show', $team) }}" class="px-5 py-2.5 text-sm font-medium text-slate-300 hover:text-white transition-colors">
                        Cancel
                    </a>
                    <x-blue-button type="submit" class="px-6 py-2.5">
                        Update Team
                    </x-blue-button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>