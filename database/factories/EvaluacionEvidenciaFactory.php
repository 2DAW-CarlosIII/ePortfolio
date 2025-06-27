<?php

namespace Database\Factories;

use App\Models\EvaluacionEvidencia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EvaluacionEvidencia>
 */
class EvaluacionEvidenciaFactory extends Factory
{
    protected $model = EvaluacionEvidencia::class;

    public function definition(): array
    {
        return [
            'evidencia_id' => \App\Models\Evidencia::factory(),
            'docente_id' => \App\Models\User::factory(),
            'puntuacion' => fake()->randomFloat(2, 0, 10),
            'estado' => fake()->randomElement(['pendiente', 'aprobada', 'rechazada']),
            'observaciones' => fake()->paragraph(),
            'fecha_evaluacion' => fake()->dateTime()
        ];
    }
}
