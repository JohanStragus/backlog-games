<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    // Campos asignables
    protected $fillable = [
        'title', 'platform', 'status', 'notes',
    ];

    // Estados permitidos (los usaremos luego en validación/filtros)
    public const STATUSES = ['backlog', 'playing', 'done'];

    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
