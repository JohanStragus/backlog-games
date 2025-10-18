<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Editar: {{ $game->title }}</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('games.update', $game) }}">
            @method('PUT')
            @include('games._form')
        </form>
    </div>
</x-app-layout>
