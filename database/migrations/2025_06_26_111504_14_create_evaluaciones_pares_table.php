<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluaciones_pares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asignacion_revision_id');
            $table->unsignedBigInteger('revisor_id');
            $table->decimal('puntuacion_sugerida', 8, 2);
            $table->enum('recomendacion', ['aprobar', 'mejorar', 'rechazar']);
            $table->text('justificacion');
            $table->timestamp('fecha_evaluacion');
            $table->timestamps();
            $table->foreign('asignacion_revision_id')->references('id')->on('asignaciones_revision')->onDelete('cascade');
            $table->foreign('revisor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluaciones_pares');
    }
};
