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
            'user_id' => 1,
            'role_id' => 1,
            'modulo_formativo_id' => 1
        ];
    }
}
