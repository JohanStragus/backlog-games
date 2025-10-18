<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Backlog</h2>
    </x-slot>

    <div class="p-6 space-y-4">
        @if(session('status'))
            <div class="rounded bg-green-50 text-green-700 px-4 py-2">
                {{ session('status') }}
            </div>
        @endif

        <form method="GET" class="flex flex-wrap gap-2 items-center">
            <input name="q" value="{{ $filters['q'] ?? '' }}" placeholder="Buscar título/plataforma/notas..."
                   class="border rounded px-3 py-2 w-72" />
            <select name="status" class="border rounded px-3 py-2">
                <option value="">Todos</option>
                @foreach($statuses as $s)
                    <option value="{{ $s }}" @selected(($filters['status'] ?? '') === $s)>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Filtrar</button>
            <a href="{{ route('games.create') }}" class="ml-auto bg-green-600 text-white px-4 py-2 rounded">
                Añadir juego
            </a>
        </form>

        <div class="bg-white dark:bg-gray-900 shadow rounded divide-y">
            @forelse($games as $g)
                <div class="p-4 flex items-start gap-4">
                    <div class="text-xs uppercase tracking-wide text-gray-500 w-24">{{ ucfirst($g->status) }}</div>
                    <div class="flex-1">
                        <div class="font-semibold">{{ $g->title }}</div>
                        <div class="text-sm text-gray-500">{{ $g->platform ?: '—' }}</div>
                        @if($g->notes)
                            <div class="text-sm mt-1 text-gray-700 line-clamp-2">{{ $g->notes }}</div>
                        @endif
                    </div>
                    <div class="flex gap-3">
                        <a class="text-blue-600 hover:underline" href="{{ route('games.edit',$g) }}">Editar</a>
                        <form method="POST" action="{{ route('games.destroy',$g) }}" onsubmit="return confirm('¿Eliminar este juego?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-6 text-gray-600">Sin juegos todavía.</div>
            @endforelse
        </div>

        <div>{{ $games->links() }}</div>
    </div>
</x-app-layout>
