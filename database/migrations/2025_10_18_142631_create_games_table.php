<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();

            // Dueño del juego
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Datos del juego
            $table->string('title');
            $table->string('platform')->nullable();

            // backlog | playing | done
            $table->string('status')->default('backlog');

            $table->text('notes')->nullable();

            $table->timestamps();

            // Índices útiles para listados/filtros
            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
