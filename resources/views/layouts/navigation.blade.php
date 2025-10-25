<nav class="bg-[#0f1117] border-b border-gray-800 text-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            {{-- LEFT: Logo + Links --}}
            <div class="flex items-center gap-8">

                {{-- Brand con logo real --}}
                <a href="{{ route('games.index') }}" class="flex items-center gap-2 text-white font-semibold tracking-tight">
                    <img src="{{ asset('images/marca.png') }}" alt="Backlog Games" class="w-8 h-8 rounded-md">
                    <span class="text-gray-100 text-lg leading-none">Backlog Games</span>
                </a>

                {{-- Nav links --}}
                <div class="flex items-center gap-6 text-sm">
                    <a href="{{ route('games.index') }}"
                       class="pb-1 border-b-2 transition-all duration-150
                              {{ request()->routeIs('games.*')
                                  ? 'border-indigo-500 text-white'
                                  : 'border-transparent text-gray-400 hover:text-gray-200' }}">
                        Juegos
                    </a>
                </div>
            </div>

            {{-- RIGHT: User dropdown --}}
            <div class="flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center text-sm font-medium text-gray-300 hover:text-white focus:outline-none transition">
                            <div class="mr-1">{{ Auth::user()->name }}</div>
                            <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-3 py-2 text-xs text-gray-400">
                            Sesión iniciada como
                            <span class="text-gray-200 font-medium block">{{ Auth::user()->email }}</span>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="text-gray-200 hover:bg-[#2a2f3f] hover:text-white">
                            Perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                class="text-gray-200 hover:bg-[#2a2f3f] hover:text-white"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Cerrar sesión
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

        </div>
    </div>
</nav>
