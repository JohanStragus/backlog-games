<nav class="bg-[#0f1017] border-b border-gray-800 text-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            {{-- Left side: Brand + links --}}
            <div class="flex items-center gap-8">
                {{-- Brand --}}
                <a href="{{ route('games.index') }}" class="flex items-center text-white font-semibold tracking-tight">
                    <span class="text-indigo-400 mr-2">🎮</span>
                    <span>Backlog Games</span>
                </a>
                {{-- Nav links --}}
                <div class="flex items-center gap-6 text-sm">
                    {{-- Juegos (activo en games.*) --}}
                    <a href="{{ route('games.index') }}"
                       class="pb-1 border-b-2 text-gray-200 hover:text-white
                              {{ request()->routeIs('games.*') ? 'border-indigo-500 text-white' : 'border-transparent' }}">
                        Juegos
                    </a>
                </div>
            </div>

            {{-- Right side: User dropdown --}}
            <div class="flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center text-sm font-medium text-gray-200 hover:text-white focus:outline-none transition">
                            <div class="mr-1">{{ Auth::user()->name }}</div>
                            <svg class="h-4 w-4 text-gray-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 011.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content" class="bg-[#1b1e2a] text-gray-100">
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
