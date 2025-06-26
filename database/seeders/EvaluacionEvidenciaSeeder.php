<?php

namespace Database\Seeders;

use App\Models\EvaluacionEvidencia;
use Illuminate\Database\Seeder;

class EvaluacionEvidenciaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // TODO: Agregar datos de ejemplo específicos para evaluaciones_evidencias
        ];

        foreach ($data as $item) {
            EvaluacionEvidencia::create($item);
        }
    }
}
