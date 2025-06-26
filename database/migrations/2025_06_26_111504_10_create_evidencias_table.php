<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evidencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudiante_id');
            $table->unsignedBigInteger('criterio_evaluacion_id');
            $table->string('url');
            $table->text('descripcion');
            $table->enum('estado_validacion', ['pendiente', 'validada', 'rechazada']);
            $table->timestamp('fecha_creacion');
            $table->timestamps();
            $table->foreign('estudiante_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('criterio_evaluacion_id')->references('id')->on('criterios_evaluacion')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evidencias');
    }
};
