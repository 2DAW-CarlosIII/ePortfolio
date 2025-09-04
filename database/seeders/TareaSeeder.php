<?php

namespace Database\Seeders;

use App\Models\Tarea;
use Illuminate\Database\Seeder;

class TareaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // TODO: Agregar datos de ejemplo específicos para tareas
        ];

        foreach ($data as $item) {
            Tarea::create($item);
        }
    }
}
