<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'email_verified_at' => now(),
        ]);

        // Ejecutar seeders de entidades
        $this->call(RolSeeder::class);
        $this->call(FamiliaProfesionalSeeder::class);
        $this->call(CicloFormativoSeeder::class);
        $this->call(ModuloFormativoSeeder::class);
        $this->call(MatriculaSeeder::class);
        $this->call(ResultadoAprendizajeSeeder::class);
        $this->call(CriteriosEvaluacionSeeder::class);
        $this->call(TareaSeeder::class);
        $this->call(EvidenciaSeeder::class);
        $this->call(EvaluacionEvidenciaSeeder::class);
        $this->call(ComentarioSeeder::class);
        $this->call(AsignacionRevisionSeeder::class);
    }
}
