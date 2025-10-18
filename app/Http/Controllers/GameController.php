<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{

    /**
     * Listado (por ahora sin filtros; se añaden en el paso 12)
     */
    public function index(Request $request)
    {
        $filters = $request->validate([
            'q'      => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ]);

        $games = Game::query()
            ->where('user_id', $request->user()->id)
            ->when($filters['q'] ?? null, function ($q, $qstr) {
                $q->where(function ($w) use ($qstr) {
                    $w->where('title', 'like', "%{$qstr}%")
                        ->orWhere('platform', 'like', "%{$qstr}%")
                        ->orWhere('notes', 'like', "%{$qstr}%");
                });
            })
            ->when(in_array($filters['status'] ?? '', Game::STATUSES), fn($q) => $q->where('status', $filters['status']))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('games.index', [
            'games'    => $games,
            'filters'  => $filters,
            'statuses' => Game::STATUSES,
        ]);
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        return view('games.create', [
            'statuses' => Game::STATUSES,
        ]);
    }


    /**
     * Guardar nuevo juego
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'    => ['required', 'string', 'max:255'],
            'platform' => ['nullable', 'string', 'max:255'],
            'status'   => ['required', 'in:backlog,playing,done'],
            'notes'    => ['nullable', 'string'],
        ]);

        $request->user()->games()->create($data);

        return redirect()->route('games.index')
            ->with('status', 'Juego creado correctamente');
    }

    /**
     * Formulario de edición
     */
    public function edit(Request $request, Game $game)
    {
        abort_unless($game->user_id === $request->user()->id, 403);

        return view('games.edit', [
            'game'     => $game,
            'statuses' => Game::STATUSES,
        ]);
    }

    /**
     * Actualizar juego
     */
    public function update(Request $request, Game $game)
    {
        abort_unless($game->user_id === $request->user()->id, 403);

        $data = $request->validate([
            'title'    => ['required', 'string', 'max:255'],
            'platform' => ['nullable', 'string', 'max:255'],
            'status'   => ['required', 'in:backlog,playing,done'],
            'notes'    => ['nullable', 'string'],
        ]);

        $game->update($data);

        return redirect()->route('games.index')
            ->with('status', 'Juego actualizado');
    }

    /**
     * Borrar juego
     */
    public function destroy(Request $request, Game $game)
    {
        abort_unless($game->user_id === $request->user()->id, 403);

        $game->delete();

        return redirect()->route('games.index')
            ->with('status', 'Juego eliminado');
    }
}
