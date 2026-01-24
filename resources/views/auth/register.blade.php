<x-layouts.auth title="Register - {{ config('app.name', 'Ticket Hub') }}">
    <x-back-button />

    <x-auth-header title="Create Account" subtitle="Join the Ticket Hub team">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus w-8 h-8 text-blue-500">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <line x1="19" x2="19" y1="8" y2="14"></line>
            <line x1="22" x2="16" y1="11" y2="11"></line>
        </svg>
    </x-auth-header>

    <x-auth-card>
        <form action="/register" method="POST" class="space-y-6">
            @csrf
            
            <x-form-input name="name" label="Full Name" placeholder="John Doe" required />
            <x-form-input name="email" label="Email" type="email" placeholder="name@company.com" required :value="request('email')" />
            <x-form-input name="password" label="Password" type="password" placeholder="••••••••" required />
            <x-form-input name="password_confirmation" label="Confirm Password" type="password" placeholder="••••••••" required />

            <x-blue-button class="w-full justify-center">
                Create Account
            </x-blue-button>
        </form>

        <div class="mt-6 text-center text-sm text-slate-400">
            Already have an account? 
            <a href="/login" class="text-blue-400 hover:text-blue-300 font-medium transition-colors">Sign in</a>
        </div>
    </x-auth-card>
</x-layouts.auth>