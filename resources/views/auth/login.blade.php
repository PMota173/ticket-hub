<x-layouts.auth title="Log In - Ticket Hub">
    <div class="bg-slate-900/50 backdrop-blur-xl border border-slate-800 rounded-2xl shadow-2xl p-8">
        <div class="mb-6 text-center">
            <h2 class="text-xl font-bold text-white tracking-tight">Welcome back</h2>
            <p class="text-sm text-slate-400 mt-1">Enter your credentials to access your workspace.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="w-full bg-slate-950/50 border border-slate-700 text-white rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all placeholder:text-slate-600"
                    placeholder="name@company.com">
                @error('email')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs text-blue-400 hover:text-blue-300 transition-colors">Forgot password?</a>
                    @endif
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full bg-slate-950/50 border border-slate-700 text-white rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all placeholder:text-slate-600"
                    placeholder="••••••••">
                @error('password')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded bg-slate-900 border-slate-700 text-blue-600 focus:ring-blue-500/50 focus:ring-offset-slate-900">
                <label for="remember_me" class="ml-2 text-sm text-slate-400">Remember me for 30 days</label>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-2.5 px-4 rounded-lg shadow-lg shadow-blue-600/20 transition-all transform hover:scale-[1.02] active:scale-[0.98]">
                Sign In
            </button>
        </form>
    </div>

    <div class="mt-6 text-center">
        <p class="text-sm text-slate-400">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-medium text-blue-400 hover:text-blue-300 transition-colors">Create free account</a>
        </p>
    </div>
</x-layouts.auth>
