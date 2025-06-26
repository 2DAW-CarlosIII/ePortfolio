<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'administrador',
                'description' => 'Administrador del sistema con todos los permisos'
            ],
            [
                'name' => 'docente',
                'description' => 'Profesor que imparte módulos formativos'
            ],
            [
                'name' => 'estudiante',
                'description' => 'Estudiante matriculado en módulos formativos'
            ]
        ];

        foreach ($data as $item) {
            Rol::create($item);
        }
    }
}
