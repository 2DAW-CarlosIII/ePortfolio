<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluaciones_evidencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evidencia_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('puntuacion', 8, 2);
            $table->enum('estado', ['pendiente', 'aprobada', 'rechazada']);
            $table->text('observaciones');
            $table->timestamp('fecha_evaluacion');
            $table->timestamps();
            $table->foreign('evidencia_id')->references('id')->on('evidencias')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluaciones_evidencias');
    }
};
