<?php

namespace Database\Seeders;

use App\Models\Comentario;
use Illuminate\Database\Seeder;

class ComentarioSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // TODO: Agregar datos de ejemplo específicos para comentarios
        ];

        foreach ($data as $item) {
            Comentario::create($item);
        }
    }
}
