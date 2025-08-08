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
            'evidencia_id' => $this->evidencia_id ?? \App\Models\Evidencia::factory(),
            'revisor_id' => \App\Models\User::factory(),
            'asignado_por_id' => \App\Models\User::factory(),
            'fecha_limite' => fake()->date(),
            'estado' => $this->estado ?? fake()->randomElement(['pendiente', 'completada', 'expirada'])
        ];
    }
}
