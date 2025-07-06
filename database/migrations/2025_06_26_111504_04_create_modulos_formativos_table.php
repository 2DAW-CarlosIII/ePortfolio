<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modulos_formativos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ciclo_formativo_id');
            $table->string('nombre');
            $table->string('codigo');
            $table->integer('horas_totales');
            $table->string('curso_escolar')->nullable();
            $table->string('centro')->nullable();
            $table->unsignedBigInteger('docente_id')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->foreign('ciclo_formativo_id')->references('id')->on('ciclos_formativos')->onDelete('cascade');
            $table->foreign('docente_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modulos_formativos');
    }
};
