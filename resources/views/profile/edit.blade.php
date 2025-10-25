<x-app-layout>
    <div class="max-w-6xl mx-auto py-12 px-6">
        <div class="bg-[#1a1f2c] border border-gray-700/60 rounded-2xl shadow-[0_0_25px_rgba(0,0,0,0.4)] p-10">

            {{-- Título principal --}}
            <h1 class="text-3xl font-bold text-gray-100 mb-2">Tu perfil</h1>
            <p class="text-gray-500 text-sm mb-10">
                Gestiona la información de tu cuenta y cambia tu contraseña.
            </p>

            {{-- Información de perfil --}}
            <div class="mb-12">
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Cambiar contraseña --}}
            <div class="mb-12 border-t border-gray-700/60 pt-12">
                @include('profile.partials.update-password-form')
            </div>

            {{-- Eliminar cuenta --}}
            <div class="border-t border-gray-700/60 pt-12">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
