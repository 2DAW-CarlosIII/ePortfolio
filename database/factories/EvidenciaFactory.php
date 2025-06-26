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
            'estudiante_id' => 1,
            'criterio_evaluacion_id' => 1,
            'url' => fake()->sentence(3),
            'descripcion' => fake()->paragraph(),
            'estado_validacion' => fake()->randomElement(['pendiente', 'validada', 'rechazada']),
            'fecha_creacion' => fake()->dateTime()
        ];
    }
}
