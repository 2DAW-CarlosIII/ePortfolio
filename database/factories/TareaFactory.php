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
            'fecha_apertura' => fake()->date('Y-m-d H:i:s'),
            'fecha_cierre' => fake()->date('Y-m-d H:i:s', '+1 month'),
            'activo' => fake()->boolean(),
            'observaciones' => fake()->paragraph()
        ];
    }
}
