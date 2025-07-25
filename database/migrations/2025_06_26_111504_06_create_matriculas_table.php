<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudiante_id');
            $table->unsignedBigInteger('modulo_formativo_id');
            $table->date('fecha_matricula');
            $table->enum('estado', ['activa', 'suspendida', 'finalizada']);
            $table->timestamps();
            $table->foreign('estudiante_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('modulo_formativo_id')->references('id')->on('modulos_formativos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
