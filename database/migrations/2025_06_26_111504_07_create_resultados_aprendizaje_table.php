<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resultados_aprendizaje', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('modulo_formativo_id');
            $table->string('codigo');
            $table->text('descripcion');
            $table->decimal('peso_porcentaje', 8, 2);
            $table->integer('orden');
            $table->timestamps();
            $table->foreign('modulo_formativo_id')->references('id')->on('modulos_formativos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resultados_aprendizaje');
    }
};
