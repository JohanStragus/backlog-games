@csrf
<div class="space-y-4">
    <div>
        <x-input-label value="Título" />
        <x-text-input name="title" class="w-full"
            value="{{ old('title', $game->title ?? '') }}" />
        <x-input-error :messages="$errors->get('title')" />
    </div>

    <div>
        <x-input-label value="Plataforma" />
        <x-text-input name="platform" class="w-full"
            value="{{ old('platform', $game->platform ?? '') }}" />
        <x-input-error :messages="$errors->get('platform')" />
    </div>

    <div>
        <x-input-label value="Estado" />
        <select name="status" class="border rounded px-3 py-2 w-full">
            @foreach($statuses as $s)
                <option value="{{ $s }}" @selected(old('status', $game->status ?? 'backlog') === $s)>
                    {{ ucfirst($s) }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('status')" />
    </div>

    <div>
        <x-input-label value="Notas" />
        <textarea name="notes" rows="4" class="border rounded px-3 py-2 w-full">{{ old('notes', $game->notes ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('notes')" />
    </div>

    <div class="flex gap-2">
        <x-primary-button>Guardar</x-primary-button>
        <a href="{{ route('games.index') }}" class="px-4 py-2 border rounded">Cancelar</a>
    </div>
</div>
