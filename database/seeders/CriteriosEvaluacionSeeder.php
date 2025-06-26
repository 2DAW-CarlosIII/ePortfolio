<?php

namespace Database\Seeders;

use App\Models\CriteriosEvaluacion;
use Illuminate\Database\Seeder;

class CriteriosEvaluacionSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // TODO: Agregar datos de ejemplo específicos para criterios_evaluacion
        ];

        foreach ($data as $item) {
            CriteriosEvaluacion::create($item);
        }
    }
}
