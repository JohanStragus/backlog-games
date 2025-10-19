<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gray-300" />
            <x-text-input id="name"
                class="block mt-1 w-full bg-[#232635] border-[#2f3345] text-gray-100 placeholder-gray-500 px-4 py-3 rounded-lg focus:outline-none focus:border-[#6366f1] focus:ring-2 focus:ring-[#6366f1]/40 transition"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                placeholder="Your name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
            <x-text-input id="email"
                class="block mt-1 w-full bg-[#232635] border-[#2f3345] text-gray-100 placeholder-gray-500 px-4 py-3 rounded-lg focus:outline-none focus:border-[#6366f1] focus:ring-2 focus:ring-[#6366f1]/40 transition"
                type="email" name="email" :value="old('email')" required autocomplete="email"
                placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-300" />
            <x-text-input id="password"
                class="block mt-1 w-full bg-[#232635] border-[#2f3345] text-gray-100 placeholder-gray-500 px-4 py-3 rounded-lg focus:outline-none focus:border-[#6366f1] focus:ring-2 focus:ring-[#6366f1]/40 transition"
                type="password" name="password" required autocomplete="new-password"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
            <p class="text-xs text-gray-500">Min. 8 characters. Use letters and numbers.</p>
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-300" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full bg-[#232635] border-[#2f3345] text-gray-100 placeholder-gray-500 px-4 py-3 rounded-lg focus:outline-none focus:border-[#6366f1] focus:ring-2 focus:ring-[#6366f1]/40 transition"
                type="password" name="password_confirmation" required autocomplete="new-password"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Actions -->
        <div class="pt-1 space-y-3">
            <button type="submit" class="btn-primary">Create account</button>

            <p class="text-center text-sm text-gray-400">
                {{ __('Already registered?') }}
                <a href="{{ route('login') }}" class="link-accent">{{ __('Log in') }}</a>
            </p>
        </div>
    </form>
</x-guest-layout>
