<?php

namespace Database\Seeders;

use App\Models\UserRol;
use Illuminate\Database\Seeder;

class UserRolSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // TODO: Agregar datos de ejemplo específicos para user_roles
        ];

        foreach ($data as $item) {
            UserRol::create($item);
        }
    }
}
