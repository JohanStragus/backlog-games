<x-guest-layout>
    <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
            <input id="email" name="email" type="email" autocomplete="username"
                   value="{{ old('email') }}"
                   class="w-full rounded-lg bg-[#232635] border border-[#2f3345] text-gray-100 placeholder-gray-500 px-4 py-3 focus:outline-none focus:border-[#7c3aed] focus:ring-2 focus:ring-[#7c3aed]/40 transition"
                   placeholder="you@example.com" required autofocus>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password"
                   class="w-full rounded-lg bg-[#232635] border border-[#2f3345] text-gray-100 placeholder-gray-500 px-4 py-3 focus:outline-none focus:border-[#7c3aed] focus:ring-2 focus:ring-[#7c3aed]/40 transition"
                   placeholder="••••••••" required>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Remember + Forgot -->
        <div class="flex items-center justify-between text-sm">
            <label class="inline-flex items-center space-x-2">
                <input type="checkbox" name="remember"
                       class="rounded border-gray-600 text-[#7c3aed] focus:ring-[#7c3aed]/40">
                <span class="text-gray-400">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-[#7c3aed] hover:text-[#9d6bff] transition">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Botón principal -->
        <div class="pt-2">
            <button type="submit"
                    class="w-full py-3 rounded-lg font-semibold text-white bg-gradient-to-r from-[#7c3aed] to-[#6366f1] shadow-lg hover:shadow-xl transition-transform hover:-translate-y-0.5">
                Log In
            </button>
        </div>

        <!-- CTA directo de registro -->
        @if (Route::has('register'))
            <a href="{{ route('register') }}"
            class="block w-full text-center mt-3 py-2.5 rounded-lg font-medium border border-[#2f3345] text-gray-200 hover:bg-[#232635] transition">
                Create an account
            </a>
        @endif
    </form>
</x-guest-layout>
