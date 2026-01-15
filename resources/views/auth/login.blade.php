<x-layouts.auth title="Login - {{ config('app.name', 'Ticket Hub') }}">
    <x-back-button />

    <x-auth-header title="Welcome Back" subtitle="Sign in to your Ticket Hub account">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-in w-8 h-8 text-blue-500">
            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
            <polyline points="10 17 15 12 10 7"></polyline>
            <line x1="15" x2="3" y1="12" y2="12"></line>
        </svg>
    </x-auth-header>

    <x-auth-card>
        <form action="/login" method="POST" class="space-y-6">
            @csrf

            <x-form-input name="email" label="Email" type="email" placeholder="name@company.com" required />
            <x-form-input name="password" label="Password" type="password" placeholder="••••••••" required />

{{--            <div class="flex items-center justify-between">--}}
{{--                <div class="flex items-center">--}}
{{--                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-slate-700 bg-slate-950/50 text-blue-600 focus:ring-blue-500/50 focus:ring-offset-0">--}}
{{--                    <label for="remember-me" class="ml-2 block text-sm text-slate-400">Remember me</label>--}}
{{--                </div>--}}
{{--            </div>--}}

            <x-blue-button class="w-full justify-center">
                Sign In
            </x-blue-button>
        </form>

        <div class="mt-6 text-center text-sm text-slate-400">
            Don't have an account?
            <a href="/register" class="text-blue-400 hover:text-blue-300 font-medium transition-colors">Create account</a>
        </div>
    </x-auth-card>
</x-layouts.auth>
