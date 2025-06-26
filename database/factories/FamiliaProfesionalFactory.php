<?php

namespace Database\Factories;

use App\Models\FamiliaProfesional;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FamiliaProfesional>
 */
class FamiliaProfesionalFactory extends Factory
{
    protected $model = FamiliaProfesional::class;

    public function definition(): array
    {
        return [
            'nombre' => fake()->words(3, true),
            'codigo' => fake()->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'descripcion' => fake()->paragraph()
        ];
    }
}
