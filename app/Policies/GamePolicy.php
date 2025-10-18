<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\User;

class GamePolicy
{
    /**
     * Cualquiera logueado puede ver su listado (lo filtramos por user en el controlador)
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Ver un juego concreto: solo el dueño
     */
    public function view(User $user, Game $game): bool
    {
        return $game->user_id === $user->id;
    }

    /**
     * Crear: cualquier usuario autenticado
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Actualizar: solo el dueño
     */
    public function update(User $user, Game $game): bool
    {
        return $game->user_id === $user->id;
    }

    /**
     * Eliminar: solo el dueño
     */
    public function delete(User $user, Game $game): bool
    {
        return $game->user_id === $user->id;
    }

    // No usamos restore/forceDelete en este proyecto
    public function restore(User $user, Game $game): bool { return false; }
    public function forceDelete(User $user, Game $game): bool { return false; }
}
