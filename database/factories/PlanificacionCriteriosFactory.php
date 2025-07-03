<?php

namespace Database\Factories;

use App\Models\PlanificacionCriterios;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlanificacionCriterios>
 */
class PlanificacionCriteriosFactory extends Factory
{
    protected $model = PlanificacionCriterios::class;

    public function definition(): array
    {
        return [
            'criterio_evaluacion_id' => \App\Models\CriterioEvaluacion::factory(),
            'fecha_apertura' => fake()->date(),
            'fecha_cierre' => fake()->date(),
            'activo' => fake()->boolean(),
            'observaciones' => fake()->paragraph()
        ];
    }
}
