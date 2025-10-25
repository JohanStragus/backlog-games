<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Editar juego – Backlog Games</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0f1117] text-gray-200 antialiased">

<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-gradient-to-b from-[#1a1d29] to-[#0f1117] border-r border-gray-800/70 flex flex-col shadow-[inset_-1px_0_0_rgba(255,255,255,0.04)]">
        <div class="px-5 py-5 border-b border-gray-800/70">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/marca.png') }}" alt="Backlog Games" class="w-9 h-9 rounded-md">
                <span class="text-gray-100 font-semibold text-lg tracking-tight">Backlog Games</span>
            </div>
        </div>

        {{-- NAV LINKS --}}
        <nav class="flex-1 px-4 py-6 space-y-2 text-sm font-medium">
            <a href="{{ route('games.index') }}"
               class="group flex items-center justify-between rounded-lg px-3 py-2
                      bg-[#10131a]
                      border border-gray-800/50
                      text-gray-300
                      hover:bg-[#1a1f2c]
                      hover:border-gray-700
                      hover:text-gray-100
                      transition">
                <span class="flex items-center gap-2">
                    <span class="text-indigo-400 text-base leading-none">🎲</span>
                    <span class="leading-none">Juegos</span>
                </span>
            </a>

            {{-- Stats (coming soon) --}}
            <div class="group flex items-start justify-between rounded-lg px-3 py-2
                        bg-[#10131a]
                        border border-gray-800/50
                        text-gray-500
                        hover:bg-[#1a1f2c]
                        hover:border-gray-700
                        hover:text-gray-300
                        transition">
                <span class="flex items-center gap-2">
                    <span class="text-yellow-400/60 text-base leading-none">📊</span>
                    <span class="leading-none">Stats</span>
                </span>
                <span class="text-[10px] text-gray-600 italic leading-none">(coming soon)</span>
            </div>

            {{-- Wishlist (coming soon) --}}
            <div class="group flex items-start justify-between rounded-lg px-3 py-2
                        bg-[#10131a]
                        border border-gray-800/50
                        text-gray-500
                        hover:bg-[#1a1f2c]
                        hover:border-gray-700
                        hover:text-gray-300
                        transition">
                <span class="flex items-center gap-2">
                    <span class="text-yellow-400/70 text-base leading-none drop-shadow-[0_0_6px_rgba(250,204,21,.4)]">⭐</span>
                    <span class="leading-none">Wishlist</span>
                </span>
                <span class="text-[10px] text-gray-600 italic leading-none">(coming soon)</span>
            </div>
        </nav>

        {{-- USER FOOTER --}}
        <div class="px-4 py-5 border-t border-gray-800/70 text-sm text-gray-300 bg-[#10131a]/40">
            <div class="mb-3">
                <div class="font-semibold text-gray-100 leading-tight">{{ Auth::user()->name }}</div>
                <div class="text-[11px] text-gray-500 leading-tight truncate max-w-[10rem]">{{ Auth::user()->email }}</div>
            </div>

            <div class="grid grid-cols-2 gap-2">
                <a href="{{ route('profile.edit') }}"
                   class="text-[12px] text-gray-300 hover:text-white
                          bg-[#1f2534] hover:bg-[#2a3042]
                          border border-gray-700/60 rounded-md px-3 py-2 text-center transition">
                    Perfil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="w-full text-[12px] text-red-400 hover:text-red-300
                               bg-[#1f1a1a] hover:bg-[#2a1f1f]
                               border border-red-700/40 rounded-md px-3 py-2 text-center transition"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Salir
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 flex items-center justify-center p-10">

        <div class="w-full max-w-4xl bg-[#1a1f2c]/90 border border-gray-700/60 rounded-2xl shadow-[0_0_25px_rgba(0,0,0,0.4)] backdrop-blur-sm p-8">

            {{-- HEADER --}}
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-100 tracking-tight">Editar juego</h1>
                    <p class="text-gray-500 text-sm mt-1">
                        Modifica la información de <span class="text-indigo-400 font-medium">{{ $game->title }}</span>.
                    </p>
                </div>
                <a href="{{ route('games.index') }}"
                   class="text-sm text-gray-400 hover:text-gray-200 transition">← Volver</a>
            </div>

            {{-- FORM --}}
            <form method="POST" action="{{ route('games.update', $game) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm text-gray-300 mb-1">Título</label>
                        <input type="text" name="title" value="{{ old('title', $game->title) }}"
                               class="w-full rounded-lg bg-[#0f1117] border border-gray-600/40 text-gray-100 px-4 py-2.5
                                      focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500/40 transition">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-300 mb-1">Plataforma</label>
                        <input type="text" name="platform" value="{{ old('platform', $game->platform) }}"
                               class="w-full rounded-lg bg-[#0f1117] border border-gray-600/40 text-gray-100 px-4 py-2.5
                                      focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500/40 transition">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-300 mb-1">Estado</label>
                        <select name="status"
                                class="w-full rounded-lg bg-[#0f1117] border border-gray-600/40 text-gray-100 px-4 py-2.5
                                       focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500/40 transition">
                            <option value="backlog" @selected($game->status === 'backlog')>Backlog</option>
                            <option value="playing" @selected($game->status === 'playing')>Playing</option>
                            <option value="done" @selected($game->status === 'done')>Done</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-300 mb-1">Notas</label>
                        <textarea name="notes" rows="4"
                                  class="w-full rounded-lg bg-[#0f1117] border border-gray-600/40 text-gray-100 px-4 py-2.5
                                         focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500/40 transition">{{ old('notes', $game->notes) }}</textarea>
                    </div>
                </div>

                {{-- BUTTONS --}}
                <div class="flex items-center justify-between pt-6 border-t border-gray-700/60">
                    <a href="{{ route('games.index') }}"
                       class="px-5 py-2.5 rounded-lg text-sm text-gray-300 bg-[#1f2534] hover:bg-[#2a3042] border border-gray-700/60 transition">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-green-600 hover:bg-green-700 border border-green-700/50 transition">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

</body>
</html>
