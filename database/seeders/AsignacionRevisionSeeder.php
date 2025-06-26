<?php

namespace Database\Seeders;

use App\Models\AsignacionRevision;
use Illuminate\Database\Seeder;

class AsignacionRevisionSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // TODO: Agregar datos de ejemplo específicos para asignaciones_revision
        ];

        foreach ($data as $item) {
            AsignacionRevision::create($item);
        }
    }
}
