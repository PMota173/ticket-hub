<x-layouts.app title="Create Ticket - {{ config('app.name', 'Ticket Hub') }}">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">Create New Ticket</h1>
            <p class="text-slate-400 mt-2">Fill out the form below to submit a new support request.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-slate-900/50 border border-slate-700 rounded-xl shadow-sm p-8">
            <form action="{{ route('tickets.store', $team) }}" method="POST" class="space-y-8">
                @csrf

                <!-- Title & Description -->
                <div class="space-y-6">
                    <x-form-input name="title" label="Ticket Title" placeholder="Brief summary of the issue" required />

                    @if($team->users->contains(auth()->user()))
                        <div class="space-y-2">
                            <label for="assignee_id" class="text-sm font-medium text-slate-300">Assignee</label>
                            <select
                                name="assigned_id"
                                id="assignee_id"
                                class="w-full bg-slate-950/50 border border-slate-700 text-white rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 cursor-pointer appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%20fill%3D%22none%22%20stroke%3D%22%2394a3b8%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E')] bg-[length:1.25rem] bg-[right_1rem_center] bg-no-repeat"
                            >
                                <option value="">Unassigned</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="space-y-2">
                        <label for="description" class="text-sm font-medium text-slate-300">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="5"
                            required
                            class="w-full bg-slate-950/50 border border-slate-700 text-white rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 placeholder:text-slate-500 resize-none"
                            placeholder="Please describe the issue in detail..."
                        ></textarea>
                    </div>
                </div>

                <!-- Priority Selector -->
                <div class="space-y-3">
                    <label class="text-sm font-medium text-slate-300">Priority Level</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Low Priority -->
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="priority" value="low" class="peer sr-only" checked>
                            <div class="p-4 rounded-xl border border-slate-700 bg-slate-950/30 peer-checked:border-green-500/50 peer-checked:bg-green-500/10 transition-all duration-200 hover:border-slate-600">
                                <div class="flex flex-col items-center text-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-green-500/20 text-green-400 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-down"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg>
                                    </div>
                                    <span class="font-semibold text-white">Low</span>
                                    <span class="text-xs text-slate-400">Minor issues</span>
                                </div>
                            </div>
                        </label>

                        <!-- Medium Priority -->
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="priority" value="medium" class="peer sr-only">
                            <div class="p-4 rounded-xl border border-slate-700 bg-slate-950/30 peer-checked:border-yellow-500/50 peer-checked:bg-yellow-500/10 transition-all duration-200 hover:border-slate-600">
                                <div class="flex flex-col items-center text-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-yellow-500/20 text-yellow-400 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus"><path d="M5 12h14"/></svg>
                                    </div>
                                    <span class="font-semibold text-white">Medium</span>
                                    <span class="text-xs text-slate-400">Standard support</span>
                                </div>
                            </div>
                        </label>

                        <!-- High Priority -->
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="priority" value="high" class="peer sr-only">
                            <div class="p-4 rounded-xl border border-slate-700 bg-slate-950/30 peer-checked:border-red-500/50 peer-checked:bg-red-500/10 transition-all duration-200 hover:border-slate-600">
                                <div class="flex flex-col items-center text-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-red-500/20 text-red-400 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg>
                                    </div>
                                    <span class="font-semibold text-white">High</span>
                                    <span class="text-xs text-slate-400">Urgent problems</span>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-800">
                    <a href="{{ route('teams.show', $team) }}" class="px-5 py-2.5 text-sm font-medium text-slate-300 hover:text-white transition-colors">
                        Cancel
                    </a>
                    <x-blue-button type="submit" class="px-6 py-2.5">
                        Create Ticket
                    </x-blue-button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
