<?php

namespace Database\Factories;

use App\Models\CriteriosEvaluacion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CriteriosEvaluacion>
 */
class CriteriosEvaluacionFactory extends Factory
{
    protected $model = CriteriosEvaluacion::class;

    public function definition(): array
    {
        return [
            'resultado_aprendizaje_id' => \App\Models\ResultadoAprendizaje::factory(),
            'codigo' => fake()->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'descripcion' => fake()->paragraph(),
            'peso_porcentaje' => fake()->randomFloat(2, 0, 100),
            'orden' => fake()->numberBetween(1, 10)
        ];
    }
}
