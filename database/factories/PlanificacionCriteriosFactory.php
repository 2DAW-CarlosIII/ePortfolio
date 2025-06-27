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
            'criterio_evaluacion_id' => \App\Models\CriteriosEvaluacion::factory(),
            'modulo_formativo_id' => \App\Models\ModuloFormativo::factory(),
            'fecha_apertura' => fake()->date(),
            'fecha_cierre' => fake()->date(),
            'activo' => fake()->boolean(),
            'observaciones' => fake()->paragraph()
        ];
    }
}
