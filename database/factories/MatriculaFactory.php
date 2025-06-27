<?php

namespace Database\Factories;

use App\Models\Matricula;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matricula>
 */
class MatriculaFactory extends Factory
{
    protected $model = Matricula::class;

    public function definition(): array
    {
        return [
            'estudiante_id' => \App\Models\User::factory(),
            'modulo_formativo_id' => \App\Models\ModuloFormativo::factory(),
            'fecha_matricula' => fake()->date(),
            'estado' => fake()->randomElement(['activa', 'suspendida', 'finalizada'])
        ];
    }
}
