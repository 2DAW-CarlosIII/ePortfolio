<?php

namespace Database\Seeders;

use App\Models\ResultadoAprendizaje;
use Illuminate\Database\Seeder;

class ResultadoAprendizajeSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // TODO: Agregar datos de ejemplo específicos para resultados_aprendizaje
        ];

        foreach ($data as $item) {
            ResultadoAprendizaje::create($item);
        }
    }
}
