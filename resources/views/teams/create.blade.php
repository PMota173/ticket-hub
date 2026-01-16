<x-layouts.app title="Create Team - {{ config('app.name', 'Ticket Hub') }}" sidebar="global">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">Create New Team</h1>
            <p class="text-slate-400 mt-2">Set up a workspace for your support tickets.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-slate-900/50 border border-slate-700 rounded-xl shadow-sm p-8">
            <form action="/teams" method="POST" class="space-y-8">
                @csrf

                <!-- Name & Description -->
                <div class="space-y-6">
                    <x-form-input name="name" label="Team Name" placeholder="Acme Corp Support" required />

                    <div class="space-y-2">
                        <label for="description" class="text-sm font-medium text-slate-300">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="w-full bg-slate-950/50 border border-slate-700 text-white rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 placeholder:text-slate-500 resize-none"
                            placeholder="Briefly describe what this team is for..."
                        ></textarea>
                    </div>

                    <!-- Private Toggle -->
                    <div class="flex items-center justify-between p-4 bg-slate-950/30 rounded-lg border border-slate-700/50">
                        <div>
                            <label for="is_private" class="font-medium text-slate-300">Private Team</label>
                            <p class="text-sm text-slate-500">Only invited members can find and join this team.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_private" id="is_private" value="1" class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>

                    <div class="flex items-start gap-3 p-4 rounded-lg bg-blue-500/10 border border-blue-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                        <div class="text-sm text-blue-300">
                            You will automatically be assigned as the <strong>Admin</strong> of this team. You can invite other members later.
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-800">
                    <a href="/teams" class="px-5 py-2.5 text-sm font-medium text-slate-300 hover:text-white transition-colors">
                        Cancel
                    </a>
                    <x-blue-button type="submit" class="px-6 py-2.5">
                        Create Team
                    </x-blue-button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
