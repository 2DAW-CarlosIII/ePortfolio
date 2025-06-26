<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asignaciones_revision', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evidencia_id');
            $table->unsignedBigInteger('revisor_id');
            $table->unsignedBigInteger('asignado_por_id');
            $table->date('fecha_asignacion');
            $table->date('fecha_limite');
            $table->enum('estado', ['pendiente', 'completada', 'expirada']);
            $table->timestamps();
            $table->foreign('evidencia_id')->references('id')->on('evidencias')->onDelete('cascade');
            $table->foreign('revisor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('asignado_por_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asignaciones_revision');
    }
};
