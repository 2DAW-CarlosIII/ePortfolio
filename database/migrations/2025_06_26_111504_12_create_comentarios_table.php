<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evidencia_id');
            $table->unsignedBigInteger('user_id');
            $table->text('contenido');
            $table->enum('tipo', ['feedback', 'mejora', 'felicitacion']);
            $table->timestamps();
            $table->foreign('evidencia_id')->references('id')->on('evidencias')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
