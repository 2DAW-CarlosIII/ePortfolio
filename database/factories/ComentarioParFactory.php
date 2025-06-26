<?php

namespace Database\Factories;

use App\Models\ComentarioPar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ComentarioPar>
 */
class ComentarioParFactory extends Factory
{
    protected $model = ComentarioPar::class;

    public function definition(): array
    {
        return [
            'asignacion_revision_id' => 1,
            'revisor_id' => 1,
            'contenido' => fake()->paragraph(),
            'tipo_comentario' => fake()->randomElement(['positivo', 'mejora', 'critico'])
        ];
    }
}
