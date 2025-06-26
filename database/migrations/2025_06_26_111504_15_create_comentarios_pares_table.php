<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comentarios_pares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asignacion_revision_id');
            $table->unsignedBigInteger('revisor_id');
            $table->text('contenido');
            $table->enum('tipo_comentario', ['positivo', 'mejora', 'critico']);
            $table->timestamps();
            $table->foreign('asignacion_revision_id')->references('id')->on('asignaciones_revision')->onDelete('cascade');
            $table->foreign('revisor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comentarios_pares');
    }
};
