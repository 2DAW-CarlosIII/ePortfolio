<?php

namespace Database\Factories;

use App\Models\EvaluacionPar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EvaluacionPar>
 */
class EvaluacionParFactory extends Factory
{
    protected $model = EvaluacionPar::class;

    public function definition(): array
    {
        return [
            'asignacion_revision_id' => 1,
            'revisor_id' => 1,
            'puntuacion_sugerida' => fake()->randomFloat(2, 0, 10),
            'recomendacion' => fake()->randomElement(['aprobar', 'mejorar', 'rechazar']),
            'justificacion' => fake()->paragraph(),
            'fecha_evaluacion' => fake()->dateTime()
        ];
    }
}
