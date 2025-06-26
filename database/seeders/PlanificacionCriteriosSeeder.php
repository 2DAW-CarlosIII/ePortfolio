<?php

namespace Database\Seeders;

use App\Models\PlanificacionCriterios;
use Illuminate\Database\Seeder;

class PlanificacionCriteriosSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // TODO: Agregar datos de ejemplo específicos para planificacion_criterios
        ];

        foreach ($data as $item) {
            PlanificacionCriterios::create($item);
        }
    }
}
