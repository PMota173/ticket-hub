<x-layouts.app title="Edit Ticket #{{ $ticket->id }} - {{ config('app.name', 'Ticket Hub') }}">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-white">Edit Ticket #{{ $ticket->id }}</h1>
                <p class="text-slate-400 mt-2">Update the details of your support request.</p>
            </div>
            <x-back-button href="/tickets/{{ $ticket->id }}">Cancel</x-back-button>
        </div>

        <!-- Form Card -->
        <div class="bg-slate-900/50 border border-slate-700 rounded-xl shadow-sm p-8">
            <form action="/tickets/{{ $ticket->id }}" method="POST" class="space-y-8">
                @csrf
                @method('PATCH')

                <!-- Title & Description -->
                <div class="space-y-6">
                    <x-form-input 
                        name="title" 
                        label="Ticket Title" 
                        placeholder="Brief summary of the issue" 
                        :value="old('title', $ticket->title)"
                        required 
                    />

                    <div class="space-y-2">
                        <label for="description" class="text-sm font-medium text-slate-300">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="5"
                            required
                            class="w-full bg-slate-950/50 border border-slate-700 text-white rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 placeholder:text-slate-500 resize-none @error('description') border-red-500 @enderror"
                            placeholder="Please describe the issue in detail..."
                        >{{ old('description', $ticket->description) }}</textarea>
                        @error('description')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Status Selector -->
                <div class="space-y-2">
                    <label for="status" class="text-sm font-medium text-slate-300">Status</label>
                    <div class="relative">
                        <select name="status" id="status" class="w-full bg-slate-950/50 border border-slate-700 text-white rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 appearance-none cursor-pointer">
                            <option value="open" {{ old('status', $ticket->status) === 'open' ? 'selected' : '' }}>Open</option>
                            <option value="in_progress" {{ old('status', $ticket->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="waiting" {{ old('status', $ticket->status) === 'waiting' ? 'selected' : '' }}>Waiting</option>
                            <option value="closed" {{ old('status', $ticket->status) === 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Priority Selector -->
                <div class="space-y-3">
                    <label class="text-sm font-medium text-slate-300">Priority Level</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Low Priority -->
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="priority" value="low" class="peer sr-only" {{ old('priority', $ticket->priority) === 'low' ? 'checked' : '' }}>
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
                            <input type="radio" name="priority" value="medium" class="peer sr-only" {{ old('priority', $ticket->priority) === 'medium' ? 'checked' : '' }}>
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
                            <input type="radio" name="priority" value="high" class="peer sr-only" {{ old('priority', $ticket->priority) === 'high' ? 'checked' : '' }}>
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

                <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-800">
                    <x-blue-button type="submit" class="px-6 py-2.5">
                        Update Ticket
                    </x-blue-button>
                </div>
            </form>

            <div class="mt-8 pt-8 border-t border-slate-800 flex items-center justify-between">
                <div class="text-sm">
                    <h4 class="text-white font-semibold">Danger Zone</h4>
                    <p class="text-slate-400">Once you delete a ticket, there is no going back. Please be certain.</p>
                </div>
                <button 
                    type="button" 
                    onclick="openModal('delete-ticket-modal', '/tickets/{{ $ticket->id }}')" 
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
