<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Backlog Games') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0f1117] text-gray-200 antialiased">
    <div class="min-h-screen flex flex-col">

        {{-- NAVBAR --}}
        <nav class="bg-[#1a1d29] border-b border-gray-800 shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">

                    {{-- LOGO --}}
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/marca.png') }}" alt="Backlog Games" class="w-9 h-9 rounded-md">
                        <span class="text-lg font-semibold text-gray-100">Backlog Games</span>
                    </div>

                    {{-- RIGHT MENU --}}
                    <div class="flex items-center gap-6">
                        <a href="{{ route('games.index') }}" class="text-gray-300 hover:text-white transition">
                            Juegos
                        </a>

                        {{-- Profile Dropdown --}}
                        <div class="relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center gap-2 text-gray-300 hover:text-white transition">
                                        <span>{{ Auth::user()->name }}</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        Perfil
                                    </x-dropdown-link>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            Cerrar sesión
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        {{-- MAIN CONTENT --}}
        <main class="flex-1">
            {{ $slot }}
        </main>

    </div>
</body>
</html>
