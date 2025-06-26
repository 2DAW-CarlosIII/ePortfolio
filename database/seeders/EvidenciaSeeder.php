<?php

namespace Database\Seeders;

use App\Models\Evidencia;
use Illuminate\Database\Seeder;

class EvidenciaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // TODO: Agregar datos de ejemplo específicos para evidencias
        ];

        foreach ($data as $item) {
            Evidencia::create($item);
        }
    }
}
