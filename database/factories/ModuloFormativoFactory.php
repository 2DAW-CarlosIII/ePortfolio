<?php

namespace Database\Factories;

use App\Models\ModuloFormativo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ModuloFormativo>
 */
class ModuloFormativoFactory extends Factory
{
    protected $model = ModuloFormativo::class;

    public function definition(): array
    {
        return [
            'ciclo_formativo_id' => 1,
            'nombre' => fake()->words(3, true),
            'codigo' => fake()->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'horas_totales' => fake()->numberBetween(20, 200),
            'curso_escolar' => fake()->sentence(3),
            'centro' => fake()->sentence(3),
            'docente_id' => 1,
            'descripcion' => fake()->paragraph()
        ];
    }
}
