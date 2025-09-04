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
            $table->unsignedBigInteger('tarea_id');
            $table->string('url');
            $table->text('descripcion');
            $table->enum('estado_validacion', ['pendiente', 'validada', 'rechazada']);
            $table->timestamps();
            $table->foreign('estudiante_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tarea_id')->references('id')->on('tareas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evidencias');
    }
};
