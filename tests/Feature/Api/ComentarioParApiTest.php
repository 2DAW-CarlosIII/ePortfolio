<?php

namespace Tests\Feature\Api;

use App\Models\ComentarioPar;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\FeatureTestCase;
use Laravel\Sanctum\Sanctum;

class ComentarioParApiTest extends FeatureTestCase
{
    use WithFaker;

    protected User $user;
    

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
        
    }

    public function test_can_list_comentarioPars()
    {
        // Arrange
        ComentarioPar::factory()->count(3)->create();

        // Act
        $response = $this->getJson('/api/v1/comentarios-pares');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'asignacion_revision_id', 'revisor_id', 'contenido', 'tipo_comentario', 'created_at', 'updated_at']
                     ],
                     'links',
                     'meta'
                 ]);
        
        $this->assertCount(3, $response->json('data'));
    }

    public function test_can_create_comentarioPar()
    {
        // Arrange
        $data = [
            'contenido' => $this->faker->paragraph(),
            'tipo_comentario' => $this->faker->randomElement(['positivo', 'mejora', 'critico'])
        ];

        // Act
        $response = $this->postJson('/api/v1/comentarios-pares', $data);

        // Assert
        $response->assertCreated()
                 ->assertJsonStructure([
                     'data' => ['id', 'asignacion_revision_id', 'revisor_id', 'contenido', 'tipo_comentario', 'created_at', 'updated_at']
                 ]);

        $this->assertDatabaseHas('comentarios_pares', [
            'contenido' => $data['contenido'],
            'tipo_comentario' => $data['tipo_comentario']
        ]);
    }

    public function test_can_show_comentarioPar()
    {
        // Arrange
        $comentarioPar = ComentarioPar::factory()->create();

        // Act
        $response = $this->getJson('/api/v1/comentarios-pares/{$comentarioPar->id}');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'asignacion_revision_id', 'revisor_id', 'contenido', 'tipo_comentario', 'created_at', 'updated_at']
                 ]);
    }

    public function test_can_update_comentarioPar()
    {
        // Arrange
        $comentarioPar = ComentarioPar::factory()->create();
        $updateData = [
            'contenido' => $this->faker->paragraph(),
            'tipo_comentario' => $this->faker->randomElement(['positivo', 'mejora', 'critico'])
        ];

        // Act
        $response = $this->putJson('/api/v1/comentarios-pares/{$comentarioPar->id}', $updateData);

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'asignacion_revision_id', 'revisor_id', 'contenido', 'tipo_comentario', 'created_at', 'updated_at']
                 ]);

        $comentarioPar->refresh();
        $this->assertEquals($updateData['contenido'], $comentarioPar->$field['name']);
        $this->assertEquals($updateData['tipo_comentario'], $comentarioPar->$field['name']);
    }

    public function test_can_delete_comentarioPar()
    {
        // Arrange
        $comentarioPar = ComentarioPar::factory()->create();

        // Act
        $response = $this->deleteJson('/api/v1/comentarios-pares/{$comentarioPar->id}');

        // Assert
        $response->assertOk()
                 ->assertJson([
                     'message' => 'ComentarioPar eliminado correctamente'
                 ]);

        $this->assertSoftDeleted('comentarios_pares', [
            'id' => $comentarioPar->id
        ]);
    }

    public function test_can_search_comentarioPars()
    {
        // Arrange
        $searchTerm = 'test search';
        $comentarioPar1 = ComentarioPar::factory()->create([
            'nombre' => 'Contains test search term',
            
        ]);
        $comentarioPar2 = ComentarioPar::factory()->create([
            'nombre' => 'Different content',
            
        ]);

        // Act
        $response = $this->getJson('/api/v1/comentarios-pares?search=' . urlencode($searchTerm));

        // Assert
        $response->assertOk();
        $data = $response->json('data');
        
        $this->assertCount(1, $data);
        $this->assertEquals($comentarioPar1->id, $data[0]['id']);
    }

    public function test_can_paginate_comentarioPars()
    {
        // Arrange
        ComentarioPar::factory()->count(25)->create();

        // Act
        $response = $this->getJson('/api/v1/comentarios-pares?per_page=10');

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


        public function test_requires_asignacion_revision_id_field()
        {
            // Arrange
            $data = [
            'contenido' => $this->faker->paragraph(),
            'tipo_comentario' => $this->faker->randomElement(['positivo', 'mejora', 'critico'])
        ];
            unset($data['asignacion_revision_id']);

            // Act
            $response = $this->postJson('/api/v1comentarios-pares', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('asignacion_revision_id');
        }
        public function test_requires_revisor_id_field()
        {
            // Arrange
            $data = [
            'contenido' => $this->faker->paragraph(),
            'tipo_comentario' => $this->faker->randomElement(['positivo', 'mejora', 'critico'])
        ];
            unset($data['revisor_id']);

            // Act
            $response = $this->postJson('/api/v1comentarios-pares', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('revisor_id');
        }
        public function test_requires_contenido_field()
        {
            // Arrange
            $data = [
            'contenido' => $this->faker->paragraph(),
            'tipo_comentario' => $this->faker->randomElement(['positivo', 'mejora', 'critico'])
        ];
            unset($data['contenido']);

            // Act
            $response = $this->postJson('/api/v1comentarios-pares', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('contenido');
        }
        public function test_requires_tipo_comentario_field()
        {
            // Arrange
            $data = [
            'contenido' => $this->faker->paragraph(),
            'tipo_comentario' => $this->faker->randomElement(['positivo', 'mejora', 'critico'])
        ];
            unset($data['tipo_comentario']);

            // Act
            $response = $this->postJson('/api/v1comentarios-pares', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('tipo_comentario');
        }
        public function test_tipo_comentario_accepts_valid_values()
        {
            foreach (['positivo', 'mejora', 'critico'] as $value) {
                $data = [
            'contenido' => $this->faker->paragraph(),
            'tipo_comentario' => $this->faker->randomElement(['positivo', 'mejora', 'critico'])
        ];
                $data['tipo_comentario'] = $value;

                $response = $this->postJson('/api/v1comentarios-pares', $data);
                $response->assertCreated();
            }
        }

        public function test_tipo_comentario_rejects_invalid_values()
        {
            // Arrange
            $data = [
            'contenido' => $this->faker->paragraph(),
            'tipo_comentario' => $this->faker->randomElement(['positivo', 'mejora', 'critico'])
        ];
            $data['tipo_comentario'] = 'invalid_value';

            // Act
            $response = $this->postJson('/api/v1comentarios-pares', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('tipo_comentario');
        }

    public function test_requires_authentication()
    {
        // Arrange
        Sanctum::actingAs(null);

        // Act
        $response = $this->getJson('/api/v1/comentarios-pares');

        // Assert
        $response->assertUnauthorized();
    }


}
