<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('criterios_tareas', function (Blueprint $table) {
            $table->unsignedBigInteger('criterio_evaluacion_id');
            $table->unsignedBigInteger('tarea_id');
            $table->foreign('criterio_evaluacion_id')->references('id')->on('criterios_evaluacion')->onDelete('cascade');
            $table->foreign('tarea_id')->references('id')->on('tareas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('criterios_tareas');
    }
};
