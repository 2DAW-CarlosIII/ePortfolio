<?php

namespace Database\Seeders;

use App\Models\FamiliaProfesional;
use Illuminate\Database\Seeder;

class FamiliaProfesionalSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nombre' => 'Informática y Comunicaciones',
                'codigo' => 'IFC',
                'descripcion' => 'Familia profesional relacionada con tecnologías de la información'
            ],
            [
                'nombre' => 'Administración y Gestión',
                'codigo' => 'ADG',
                'descripcion' => 'Familia profesional relacionada con administración y gestión empresarial'
            ]
        ];

        foreach ($data as $item) {
            FamiliaProfesional::create($item);
        }
    }
}
