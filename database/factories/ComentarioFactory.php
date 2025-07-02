<?php

namespace Database\Factories;

use App\Models\Comentario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comentario>
 */
class ComentarioFactory extends Factory
{
    protected $model = Comentario::class;

    public function definition(): array
    {
        return [
            'evidencia_id' => $this->evidencia_id ?? \App\Models\Evidencia::factory(),
            'docente_id' => \App\Models\User::factory(),
            'contenido' => fake()->paragraph(),
            'tipo' => fake()->randomElement(['feedback', 'mejora', 'felicitacion'])
        ];
    }
}
