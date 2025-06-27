<?php

namespace Tests\Unit\Models;

use App\Models\UserRol;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRolTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_fillable_attributes()
    {
        $fillable = (new UserRol())->getFillable();
        
        $expected = [
            'user_id',
            'role_id',
            'modulo_formativo_id'
        ];
        
        $this->assertEquals($expected, $fillable);
    }

    public function test_it_has_correct_table_name()
    {
        $model = new UserRol();
        $this->assertEquals('user_roles', $model->getTable());
    }

    public function test_it_can_be_created_with_factory()
    {
        $userRol = UserRol::factory()->create();
        
        $this->assertInstanceOf(UserRol::class, $userRol);
        $this->assertDatabaseHas('user_roles', [
            'id' => $userRol->id
        ]);
    }


    public function test_it_uses_expected_factory()
    {
        $userRol = UserRol::factory()->make();
        $this->assertInstanceOf(UserRol::class, $userRol);
    }


}
