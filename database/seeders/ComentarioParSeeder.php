<?php

namespace Database\Seeders;

use App\Models\ComentarioPar;
use Illuminate\Database\Seeder;

class ComentarioParSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // TODO: Agregar datos de ejemplo específicos para comentarios_pares
        ];

        foreach ($data as $item) {
            ComentarioPar::create($item);
        }
    }
}
