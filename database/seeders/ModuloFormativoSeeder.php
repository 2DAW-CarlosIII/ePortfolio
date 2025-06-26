<?php

namespace Database\Seeders;

use App\Models\ModuloFormativo;
use Illuminate\Database\Seeder;

class ModuloFormativoSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // TODO: Agregar datos de ejemplo específicos para modulos_formativos
        ];

        foreach ($data as $item) {
            ModuloFormativo::create($item);
        }
    }
}
