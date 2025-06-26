<?php

namespace Tests\Feature\Api;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class RolApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected User $user;
    

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
        
    }

    /** @test */
    public function can_list_rols()
    {
        // Arrange
        Rol::factory()->count(3)->create();

        // Act
        $response = $this->getJson('/api/v1/roles');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'name', 'description', 'created_at', 'updated_at']
                     ],
                     'links',
                     'meta'
                 ]);
        
        $this->assertCount(3, $response->json('data'));
    }

    /** @test */
    public function can_create_rol()
    {
        // Arrange
        $data = [
            'name' => \$this->faker->words(3, true),
            'description' => \$this->faker->paragraph()
        ];

        // Act
        $response = $this->postJson('/api/v1/roles', $data);

        // Assert
        $response->assertCreated()
                 ->assertJsonStructure([
                     'data' => ['id', 'name', 'description', 'created_at', 'updated_at']
                 ]);

        $this->assertDatabaseHas('roles', [
            'name' => $data['name'],
            'description' => $data['description']
        ]);
    }

    /** @test */
    public function can_show_rol()
    {
        // Arrange
        $rol = Rol::factory()->create();

        // Act
        $response = $this->getJson('/api/v1/roles/{$rol->id}');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'name', 'description', 'created_at', 'updated_at']
                 ]);
    }

    /** @test */
    public function can_update_rol()
    {
        // Arrange
        $rol = Rol::factory()->create();
        $updateData = [
            'name' => \$this->faker->words(3, true),
            'description' => \$this->faker->paragraph()
        ];

        // Act
        $response = $this->putJson('/api/v1/roles/{$rol->id}', $updateData);

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'name', 'description', 'created_at', 'updated_at']
                 ]);

        $rol->refresh();
        $this->assertEquals($updateData['name'], $rol->$field['name']));
        $this->assertEquals($updateData['description'], $rol->$field['name']));
    }

    /** @test */
    public function can_delete_rol()
    {
        // Arrange
        $rol = Rol::factory()->create();

        // Act
        $response = $this->deleteJson('/api/v1/roles/{$rol->id}');

        // Assert
        $response->assertOk()
                 ->assertJson([
                     'message' => 'Rol eliminado correctamente'
                 ]);

        $this->assertSoftDeleted('roles', [
            'id' => $rol->id
        ]);
    }

    /** @test */
    public function can_search_rols()
    {
        // Arrange
        $searchTerm = 'test search';
        $rol1 = Rol::factory()->create([
            'nombre' => 'Contains test search term',
            
        ]);
        $rol2 = Rol::factory()->create([
            'nombre' => 'Different content',
            
        ]);

        // Act
        $response = $this->getJson('/api/v1/roles?search=' . urlencode($searchTerm));

        // Assert
        $response->assertOk();
        $data = $response->json('data');
        
        $this->assertCount(1, $data);
        $this->assertEquals($rol1->id, $data[0]['id']);
    }

    /** @test */
    public function can_paginate_rols()
    {
        // Arrange
        Rol::factory()->count(25)->create();

        // Act
        $response = $this->getJson('/api/v1/roles?per_page=10');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data',
                     'links' => ['first', 'last', 'prev', 'next'],
                     'meta' => ['current_page', 'total', 'per_page']
                 ]);
        
        $this->assertCount(10, $response->json('data'));
        $this->assertEquals(25, $response->json('meta.total'));
    }


    /** @test */
    public function test_requires_name_field()
    {
        // Arrange
        $data = [
            'name' => \$this->faker->words(3, true),
            'description' => \$this->faker->paragraph()
        ];
        unset($data['name']);

        // Act
        $response = $this->postJson('/api/v1roles', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('name');
    }
    /** @test */
    public function test_requires_description_field()
    {
        // Arrange
        $data = [
            'name' => \$this->faker->words(3, true),
            'description' => \$this->faker->paragraph()
        ];
        unset($data['description']);

        // Act
        $response = $this->postJson('/api/v1roles', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('description');
    }
    /** @test */
    public function test_name_must_be_unique()
    {
        // Arrange
        $existing = Rol::factory()->create();
        $data = [
            'name' => \$this->faker->words(3, true),
            'description' => \$this->faker->paragraph()
        ];
        $data['name'] = $existing->name;

        // Act
        $response = $this->postJson('/api/v1roles', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('name');
    }

    /** @test */
    public function requires_authentication()
    {
        // Arrange
        Sanctum::actingAs(null);

        // Act
        $response = $this->getJson('/api/v1/roles');

        // Assert
        $response->assertUnauthorized();
    }


}
