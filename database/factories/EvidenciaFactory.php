<?php

namespace Database\Factories;

use App\Models\Evidencia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evidencia>
 */
class EvidenciaFactory extends Factory
{
    protected $model = Evidencia::class;

    public function definition(): array
    {
        return [
            'estudiante_id' => \App\Models\User::factory(),
            'criterio_evaluacion_id' => \App\Models\CriterioEvaluacion::factory(),
            'url' => fake()->sentence(3),
            'descripcion' => fake()->paragraph(),
            'estado_validacion' => fake()->randomElement(['pendiente', 'validada', 'rechazada']),
            'fecha_creacion' => fake()->dateTime()
        ];
    }
}
