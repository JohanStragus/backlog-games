<section>
    {{-- Encabezado bonito sin brillo --}}
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-100 mb-2">
            Información de perfil
        </h2>
        <p class="text-sm text-gray-500">
            Actualiza tu nombre y dirección de correo.
        </p>
    </div>

    {{-- Mensaje de éxito opcional --}}
    @if (session('status') === 'profile-updated')
        <div class="mb-4 text-sm text-green-400">
            Datos guardados correctamente.
        </div>
    @endif

    {{-- Formulario --}}
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6 max-w-full">
        @csrf
        @method('patch')

        <!-- Name -->
        <div class="space-y-2">
            <label class="block text-sm text-gray-300">Nombre</label>
            <input
                class="w-full rounded-lg bg-[#0f1117] border border-gray-600/40 text-gray-100 px-4 py-2.5
                       focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500/40 transition"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
            />
            @error('name')
                <p class="text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="space-y-2">
            <label class="block text-sm text-gray-300">Email</label>
            <input
                class="w-full rounded-lg bg-[#0f1117] border border-gray-600/40 text-gray-100 px-4 py-2.5
                       focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500/40 transition"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
            />
            @error('email')
                <p class="text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <button
            class="inline-flex items-center rounded-lg bg-green-600 hover:bg-green-700
                   border border-green-700/50 text-white font-medium text-sm px-5 py-2.5 transition">
            Guardar
        </button>
    </form>
</section>
