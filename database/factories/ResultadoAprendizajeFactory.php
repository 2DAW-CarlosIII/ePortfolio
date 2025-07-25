<?php

namespace Database\Factories;

use App\Models\ResultadoAprendizaje;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ResultadoAprendizaje>
 */
class ResultadoAprendizajeFactory extends Factory
{
    protected $model = ResultadoAprendizaje::class;

    public function definition(): array
    {
        return [
            'modulo_formativo_id' => \App\Models\ModuloFormativo::factory(),
            'codigo' => fake()->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'descripcion' => fake()->paragraph(),
            'peso_porcentaje' => fake()->randomFloat(2, 0, 100),
            'orden' => fake()->numberBetween(1, 10)
        ];
    }
}
