<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ciclos_formativos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('familia_profesional_id');
            $table->string('nombre');
            $table->string('codigo')->unique();
            $table->enum('grado', ['basico', 'medio', 'superior']);
            $table->text('descripcion');
            $table->timestamps();
            $table->foreign('familia_profesional_id')->references('id')->on('familias_profesionales')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ciclos_formativos');
    }
};
