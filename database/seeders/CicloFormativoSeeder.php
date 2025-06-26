<?php

namespace Database\Seeders;

use App\Models\CicloFormativo;
use Illuminate\Database\Seeder;

class CicloFormativoSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'familia_profesional_id' => 1,
                'nombre' => 'Desarrollo de Aplicaciones Web',
                'codigo' => 'DAW',
                'grado' => 'superior',
                'descripcion' => 'Ciclo formativo de grado superior en desarrollo web'
            ],
            [
                'familia_profesional_id' => 1,
                'nombre' => 'Desarrollo de Aplicaciones Multiplataforma',
                'codigo' => 'DAM',
                'grado' => 'superior',
                'descripcion' => 'Ciclo formativo de grado superior en desarrollo multiplataforma'
            ]
        ];

        foreach ($data as $item) {
            CicloFormativo::create($item);
        }
    }
}
