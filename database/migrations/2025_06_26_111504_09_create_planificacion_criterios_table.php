<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('planificacion_criterios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('criterio_evaluacion_id');
            $table->unsignedBigInteger('modulo_formativo_id');
            $table->date('fecha_apertura');
            $table->date('fecha_cierre');
            $table->boolean('activo')->default(false);
            $table->text('observaciones');
            $table->timestamps();
            $table->foreign('criterio_evaluacion_id')->references('id')->on('criterios_evaluacion')->onDelete('cascade');
            $table->foreign('modulo_formativo_id')->references('id')->on('modulos_formativos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('planificacion_criterios');
    }
};
