<x-guest-layout>

    <h1 class="text-xl font-semibold text-gray-900 mb-1">Welcome back</h1>
    <p class="text-sm text-gray-500 mb-6">Sign in to manage your parking reservations.</p>

    <!-- Session Status (shows "Password reset link sent" etc.) -->
    @if (session('status'))
        <div class="mb-4 p-3 bg-teal-50 text-teal-700 rounded-lg text-sm">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition @error('email') border-red-400 @enderror">
            @error('email')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-teal-600 hover:underline">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input type="password" name="password" required
                   class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition @error('password') border-red-400 @enderror">
            @error('password')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center gap-2">
            <input type="checkbox" name="remember" id="remember"
                   class="rounded border-gray-300 text-teal-600 focus:ring-teal-500">
            <label for="remember" class="text-sm text-gray-600">Remember me</label>
        </div>

        <!-- Submit -->
        <button type="submit"
                class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2.5 rounded-lg transition text-sm">
            Sign in
        </button>

        <!-- Register link -->
        <p class="text-center text-sm text-gray-500">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-teal-600 font-medium hover:underline">Create one</a>
        </p>
    </form>

</x-guest-layout>