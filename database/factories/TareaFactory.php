<?php

namespace Database\Factories;

use App\Models\Tarea;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tareas>
 */
class TareaFactory extends Factory
{
    protected $model = Tarea::class;

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
