<section>
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-red-400 mb-2">
            Eliminar cuenta
        </h2>
        <p class="text-sm text-gray-500">
            Una vez borres tu cuenta, todos tus datos (incluida tu biblioteca de juegos) se eliminarán permanentemente.
        </p>
    </div>

    <div class="bg-[#2a1f1f]/40 border border-red-800/40 text-red-300 text-sm rounded-lg p-4 mb-6">
        Esta acción es irreversible. Escribe tu contraseña para confirmar.
    </div>

    <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6 max-w-full">
        @csrf
        @method('delete')

        <div class="space-y-2">
            <label class="block text-sm text-gray-300">
                Contraseña
            </label>
            <input
                class="w-full rounded-lg bg-[#0f1117] border border-gray-600/40 text-gray-100 px-4 py-2.5
                       focus:outline-none focus:ring-2 focus:ring-red-500/30 focus:border-red-500/40 transition"
                type="password"
                name="password"
                placeholder="••••••••"
            />
            @error('password')
                <p class="text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <button
            class="inline-flex items-center rounded-lg bg-red-600 hover:bg-red-500
                   border border-red-700/50 text-white font-medium text-sm px-5 py-2.5 transition">
            Borrar cuenta
        </button>
    </form>
</section>
