<?php

namespace Database\Factories;

use App\Models\UserRol;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserRol>
 */
class UserRolFactory extends Factory
{
    protected $model = UserRol::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'role_id' => \App\Models\Role::factory(),
            'modulo_formativo_id' => \App\Models\ModuloFormativo::factory()
        ];
    }
}
