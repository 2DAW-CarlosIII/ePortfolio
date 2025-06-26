<?php

namespace Database\Seeders;

use App\Models\EvaluacionPar;
use Illuminate\Database\Seeder;

class EvaluacionParSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // TODO: Agregar datos de ejemplo específicos para evaluaciones_pares
        ];

        foreach ($data as $item) {
            EvaluacionPar::create($item);
        }
    }
}
