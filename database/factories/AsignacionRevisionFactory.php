<?php

namespace Database\Factories;

use App\Models\AsignacionRevision;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AsignacionRevision>
 */
class AsignacionRevisionFactory extends Factory
{
    protected $model = AsignacionRevision::class;

    public function definition(): array
    {
        return [
            'evidencia_id' => 1,
            'revisor_id' => 1,
            'asignado_por_id' => 1,
            'fecha_asignacion' => fake()->date(),
            'fecha_limite' => fake()->date(),
            'estado' => fake()->randomElement(['pendiente', 'completada', 'expirada'])
        ];
    }
}
