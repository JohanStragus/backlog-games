<section>
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-100 mb-2">
            Cambiar contraseña
        </h2>
        <p class="text-sm text-gray-500">
            Usa una contraseña segura que no utilices en otros servicios.
        </p>
    </div>

    @if (session('status') === 'password-updated')
        <div class="mb-4 text-sm text-green-400">
            Contraseña actualizada correctamente.
        </div>
    @endif

    <form method="post" action="{{ route('password.update') }}" class="space-y-6 max-w-full">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="space-y-2">
            <label class="block text-sm text-gray-300">Contraseña actual</label>
            <input
                class="w-full rounded-lg bg-[#0f1117] border border-gray-600/40 text-gray-100 px-4 py-2.5
                       focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500/40 transition"
                name="current_password"
                type="password"
                autocomplete="current-password"
            />
            @error('current_password')
                <p class="text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Password -->
        <div class="space-y-2">
            <label class="block text-sm text-gray-300">Nueva contraseña</label>
            <input
                class="w-full rounded-lg bg-[#0f1117] border border-gray-600/40 text-gray-100 px-4 py-2.5
                       focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500/40 transition"
                name="password"
                type="password"
                autocomplete="new-password"
            />
            @error('password')
                <p class="text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <label class="block text-sm text-gray-300">Repite la nueva contraseña</label>
            <input
                class="w-full rounded-lg bg-[#0f1117] border border-gray-600/40 text-gray-100 px-4 py-2.5
                       focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500/40 transition"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
            />
            @error('password_confirmation')
                <p class="text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <button
            class="inline-flex items-center rounded-lg bg-indigo-600 hover:bg-indigo-500
                   border border-indigo-700/50 text-white font-medium text-sm px-5 py-2.5 transition">
            Actualizar contraseña
        </button>
    </form>
</section>
