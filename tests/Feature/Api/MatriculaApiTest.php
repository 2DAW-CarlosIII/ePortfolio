<?php

namespace Tests\Feature\Api;

use App\Models\Matricula;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\FeatureTestCase;
use Laravel\Sanctum\Sanctum;

class MatriculaApiTest extends FeatureTestCase
{
    use WithFaker;

    protected User $user;
    

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
        
    }

    public function test_can_list_matriculas()
    {
        // Arrange
        Matricula::factory()->count(3)->create();

        // Act
        $response = $this->getJson('/api/v1/matriculas');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'estudiante_id', 'modulo_formativo_id', 'fecha_matricula', 'estado', 'created_at', 'updated_at']
                     ],
                     'links',
                     'meta'
                 ]);
        
        $this->assertCount(3, $response->json('data'));
    }

    public function test_can_create_matricula()
    {
        // Arrange
        $data = [
            'fecha_matricula' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['activa', 'suspendida', 'finalizada'])
        ];

        // Act
        $response = $this->postJson('/api/v1/matriculas', $data);

        // Assert
        $response->assertCreated()
                 ->assertJsonStructure([
                     'data' => ['id', 'estudiante_id', 'modulo_formativo_id', 'fecha_matricula', 'estado', 'created_at', 'updated_at']
                 ]);

        $this->assertDatabaseHas('matriculas', [
            'fecha_matricula' => $data['fecha_matricula'],
            'estado' => $data['estado']
        ]);
    }

    public function test_can_show_matricula()
    {
        // Arrange
        $matricula = Matricula::factory()->create();

        // Act
        $response = $this->getJson('/api/v1/matriculas/{$matricula->id}');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'estudiante_id', 'modulo_formativo_id', 'fecha_matricula', 'estado', 'created_at', 'updated_at']
                 ]);
    }

    public function test_can_update_matricula()
    {
        // Arrange
        $matricula = Matricula::factory()->create();
        $updateData = [
            'fecha_matricula' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['activa', 'suspendida', 'finalizada'])
        ];

        // Act
        $response = $this->putJson('/api/v1/matriculas/{$matricula->id}', $updateData);

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'estudiante_id', 'modulo_formativo_id', 'fecha_matricula', 'estado', 'created_at', 'updated_at']
                 ]);

        $matricula->refresh();
        $this->assertEquals($updateData['fecha_matricula'], $matricula->$field['name']);
        $this->assertEquals($updateData['estado'], $matricula->$field['name']);
    }

    public function test_can_delete_matricula()
    {
        // Arrange
        $matricula = Matricula::factory()->create();

        // Act
        $response = $this->deleteJson('/api/v1/matriculas/{$matricula->id}');

        // Assert
        $response->assertOk()
                 ->assertJson([
                     'message' => 'Matricula eliminado correctamente'
                 ]);

        $this->assertSoftDeleted('matriculas', [
            'id' => $matricula->id
        ]);
    }

    public function test_can_search_matriculas()
    {
        // Arrange
        $searchTerm = 'test search';
        $matricula1 = Matricula::factory()->create([
            'nombre' => 'Contains test search term',
            
        ]);
        $matricula2 = Matricula::factory()->create([
            'nombre' => 'Different content',
            
        ]);

        // Act
        $response = $this->getJson('/api/v1/matriculas?search=' . urlencode($searchTerm));

        // Assert
        $response->assertOk();
        $data = $response->json('data');
        
        $this->assertCount(1, $data);
        $this->assertEquals($matricula1->id, $data[0]['id']);
    }

    public function test_can_paginate_matriculas()
    {
        // Arrange
        Matricula::factory()->count(25)->create();

        // Act
        $response = $this->getJson('/api/v1/matriculas?per_page=10');

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


        public function test_requires_estudiante_id_field()
        {
            // Arrange
            $data = [
            'fecha_matricula' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['activa', 'suspendida', 'finalizada'])
        ];
            unset($data['estudiante_id']);

            // Act
            $response = $this->postJson('/api/v1matriculas', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('estudiante_id');
        }
        public function test_requires_modulo_formativo_id_field()
        {
            // Arrange
            $data = [
            'fecha_matricula' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['activa', 'suspendida', 'finalizada'])
        ];
            unset($data['modulo_formativo_id']);

            // Act
            $response = $this->postJson('/api/v1matriculas', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('modulo_formativo_id');
        }
        public function test_requires_fecha_matricula_field()
        {
            // Arrange
            $data = [
            'fecha_matricula' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['activa', 'suspendida', 'finalizada'])
        ];
            unset($data['fecha_matricula']);

            // Act
            $response = $this->postJson('/api/v1matriculas', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('fecha_matricula');
        }
        public function test_requires_estado_field()
        {
            // Arrange
            $data = [
            'fecha_matricula' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['activa', 'suspendida', 'finalizada'])
        ];
            unset($data['estado']);

            // Act
            $response = $this->postJson('/api/v1matriculas', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('estado');
        }
        public function test_estado_accepts_valid_values()
        {
            foreach (['activa', 'suspendida', 'finalizada'] as $value) {
                $data = [
            'fecha_matricula' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['activa', 'suspendida', 'finalizada'])
        ];
                $data['estado'] = $value;

                $response = $this->postJson('/api/v1matriculas', $data);
                $response->assertCreated();
            }
        }

        public function test_estado_rejects_invalid_values()
        {
            // Arrange
            $data = [
            'fecha_matricula' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['activa', 'suspendida', 'finalizada'])
        ];
            $data['estado'] = 'invalid_value';

            // Act
            $response = $this->postJson('/api/v1matriculas', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('estado');
        }

    public function test_requires_authentication()
    {
        // Arrange
        Sanctum::actingAs(null);

        // Act
        $response = $this->getJson('/api/v1/matriculas');

        // Assert
        $response->assertUnauthorized();
    }


}
