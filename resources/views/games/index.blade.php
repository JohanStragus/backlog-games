<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Backlog Games</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Evitar fondo blanco en autocompletar Chrome */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0px 1000px #2a3042 inset !important;
            -webkit-text-fill-color: #e5e7eb !important;
            caret-color: #e5e7eb !important;
        }
    </style>
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
                    <span class="leading-none">
                        Juegos
                    </span>
                </span>

                <span class="text-[11px] leading-none bg-[#1f2534] text-indigo-200 border border-indigo-600/40 rounded-full px-2 py-[1px]">
                    {{ $games->total() }}
                </span>
            </a>

            {{-- Stats --}}
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

            {{-- Wishlist --}}
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

        {{-- FOOTER --}}
        <div class="px-4 py-5 border-t border-gray-800/70 text-sm text-gray-300 bg-[#10131a]/40">
            <div class="mb-3">
                <div class="font-semibold text-gray-100 leading-tight">
                    {{ Auth::user()->name }}
                </div>
                <div class="text-[11px] text-gray-500 leading-tight truncate max-w-[10rem]">
                    {{ Auth::user()->email }}
                </div>
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
    <main class="flex-1 min-w-0 p-6 md:p-8">

        {{-- FILTER BAR --}}
        <div class="bg-[#1a1f2c] border border-gray-700/60 rounded-xl px-4 py-4 flex flex-col gap-4 md:flex-row md:items-start md:justify-between">

            <form method="GET" class="flex flex-1 flex-wrap gap-3 items-start md:items-center md:max-w-[75%]">
                <div class="flex items-center gap-2 bg-[#0f1117] border border-gray-600/40 text-gray-200/90 rounded-lg px-3 h-10 flex-grow min-w-[220px] ring-1 ring-white/5 focus-within:ring-indigo-500/30 focus-within:border-indigo-500/40 transition">
                    <svg class="h-4 w-4 text-gray-500/70 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <circle cx="11" cy="11" r="6" stroke-width="2"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"
                              stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <input
                        name="q"
                        value="{{ $filters['q'] ?? '' }}"
                        placeholder="Buscar título, plataforma o notas..."
                        class="bg-transparent outline-none w-full placeholder-gray-500/70 text-gray-200 text-[14px] leading-none"
                    />
                </div>

                <select
                    name="status"
                    class="h-10 bg-[#0f1117] border border-gray-600/40 text-gray-200 text-[14px] leading-none rounded-lg px-3 ring-1 ring-white/5 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500/40 transition">
                    <option value="">Todos los estados</option>
                    @foreach($statuses as $s)
                        <option value="{{ $s }}" @selected(($filters['status'] ?? '') === $s)>
                            {{ ucfirst($s) }}
                        </option>
                    @endforeach
                </select>

                <button
                    class="h-10 inline-flex items-center justify-center rounded-lg px-4 text-[14px] font-medium text-white bg-indigo-600 hover:bg-indigo-500 border border-indigo-400/30 ring-1 ring-indigo-300/30 transition">
                    Filtrar
                </button>
            </form>

            <div class="flex md:flex-none">
                <a href="{{ route('games.create') }}"
                   class="h-10 inline-flex items-center justify-center gap-2 rounded-lg px-4 text-[14px] font-medium text-white bg-green-600 hover:bg-green-500 border border-green-400/30 ring-1 ring-green-300/30 transition w-full">
                    <span class="text-lg leading-none font-semibold">＋</span>
                    <span>Añadir juego</span>
                </a>
            </div>
        </div>

        {{-- GAME LIST --}}
        <div class="mt-6 bg-[#141720] border border-gray-700/60 rounded-xl divide-y divide-gray-700/60 shadow">

            @forelse($games as $g)
                <div class="p-4 flex flex-col gap-4 md:flex-row md:items-start md:justify-between">

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">

                        {{-- Status pill con color dinámico --}}
                        @php
                            $colorMap = [
                                'done' => 'bg-green-600/20 text-green-300 border border-green-500/40 ring-1 ring-green-500/20',
                                'playing' => 'bg-yellow-600/20 text-yellow-300 border border-yellow-500/40 ring-1 ring-yellow-500/20',
                                'backlog' => 'bg-red-600/20 text-red-300 border border-red-500/40 ring-1 ring-red-500/20',
                            ];
                        @endphp

                        <div class="flex items-center gap-2 mb-2">
                            <span class="inline-flex items-center uppercase text-[11px] font-medium leading-none tracking-wide
                                         rounded-full px-2 py-[4px]
                                         {{ $colorMap[$g->status] ?? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/40 ring-1 ring-indigo-500/20' }}">
                                {{ $g->status }}
                            </span>
                        </div>

                        <div class="text-base md:text-lg font-semibold text-gray-100 truncate">
                            {{ $g->title }}
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ $g->platform ?: '—' }}
                        </div>

                        @if($g->notes)
                            <div class="text-sm italic mt-2 text-gray-300 leading-relaxed">
                                {{ $g->notes }}
                            </div>
                        @endif
                    </div>

                    {{-- Actions --}}
                    <div class="flex-shrink-0 flex gap-4 text-sm md:pt-1">
                        <a class="text-indigo-400 hover:text-indigo-300 font-medium transition"
                           href="{{ route('games.edit',$g) }}">
                            Editar
                        </a>

                        <form method="POST"
                              action="{{ route('games.destroy',$g) }}"
                              onsubmit="return confirm('¿Eliminar este juego?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-400 hover:text-red-300 font-medium transition">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-6 text-gray-500 text-sm">
                    Sin juegos todavía.
                </div>
            @endforelse
        </div>

        <div class="text-gray-500 text-sm mt-4">
            {{ $games->links() }}
        </div>

    </main>
</div>

</body>
</html>
