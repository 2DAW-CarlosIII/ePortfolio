<?php

namespace Database\Factories;

use App\Models\CicloFormativo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CicloFormativo>
 */
class CicloFormativoFactory extends Factory
{
    protected $model = CicloFormativo::class;

    public function definition(): array
    {
        return [
            'familia_profesional_id' => $this->familia_profesional_id ?? \App\Models\FamiliaProfesional::factory(),
            'nombre' => fake()->words(3, true),
            'codigo' => fake()->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'grado' => fake()->randomElement(['basico', 'medio', 'superior']),
            'descripcion' => fake()->paragraph()
        ];
    }
}
