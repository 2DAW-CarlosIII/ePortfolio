<?php

namespace Tests\Feature\Api;

use App\Models\Comentario;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class ComentarioApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected User $user;
    protected Evidencia $parent;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
        
        $this->evidencia = Evidencia::factory()->create();
    }

    /** @test */
    public function can_list_comentarios()
    {
        // Arrange
        Comentario::factory()->count(3)->create(['evidencia_id' => $this->evidencia->id]);

        // Act
        $response = $this->getJson('/api/v1/evidencias/{parent_id}/comentarios');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'evidencia_id', 'docente_id', 'contenido', 'tipo', 'created_at', 'updated_at']
                     ],
                     'links',
                     'meta'
                 ]);
        
        $this->assertCount(3, $response->json('data'));
    }

    /** @test */
    public function can_create_comentario()
    {
        // Arrange
        $data = [
            'contenido' => \$this->faker->paragraph(),
            'tipo' => \$this->faker->randomElement(['feedback', 'mejora', 'felicitacion'])
        ];

        // Act
        $response = $this->postJson('/api/v1/evidencias/{parent_id}/comentarios', $data);

        // Assert
        $response->assertCreated()
                 ->assertJsonStructure([
                     'data' => ['id', 'evidencia_id', 'docente_id', 'contenido', 'tipo', 'created_at', 'updated_at']
                 ]);

        $this->assertDatabaseHas('comentarios', [
            'contenido' => $data['contenido'],
            'tipo' => $data['tipo']
        ]);
    }

    /** @test */
    public function can_show_comentario()
    {
        // Arrange
        $comentario = Comentario::factory()->create(['evidencia_id' => $this->evidencia->id]);

        // Act
        $response = $this->getJson('/api/v1/evidencias/{parent_id}/comentarios/{$comentario->id}');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'evidencia_id', 'docente_id', 'contenido', 'tipo', 'created_at', 'updated_at']
                 ]);
    }

    /** @test */
    public function can_update_comentario()
    {
        // Arrange
        $comentario = Comentario::factory()->create(['evidencia_id' => $this->evidencia->id]);
        $updateData = [
            'contenido' => \$this->faker->paragraph(),
            'tipo' => \$this->faker->randomElement(['feedback', 'mejora', 'felicitacion'])
        ];

        // Act
        $response = $this->putJson('/api/v1/evidencias/{parent_id}/comentarios/{$comentario->id}', $updateData);

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'evidencia_id', 'docente_id', 'contenido', 'tipo', 'created_at', 'updated_at']
                 ]);

        $comentario->refresh();
        $this->assertEquals($updateData['contenido'], $comentario->$field['name']));
        $this->assertEquals($updateData['tipo'], $comentario->$field['name']));
    }

    /** @test */
    public function can_delete_comentario()
    {
        // Arrange
        $comentario = Comentario::factory()->create(['evidencia_id' => $this->evidencia->id]);

        // Act
        $response = $this->deleteJson('/api/v1/evidencias/{parent_id}/comentarios/{$comentario->id}');

        // Assert
        $response->assertOk()
                 ->assertJson([
                     'message' => 'Comentario eliminado correctamente'
                 ]);

        $this->assertSoftDeleted('comentarios', [
            'id' => $comentario->id
        ]);
    }

    /** @test */
    public function can_search_comentarios()
    {
        // Arrange
        $searchTerm = 'test search';
        $comentario1 = Comentario::factory()->create([
            'nombre' => 'Contains test search term',
            'evidencia_id' => $this->evidencia->id
        ]);
        $comentario2 = Comentario::factory()->create([
            'nombre' => 'Different content',
            'evidencia_id' => $this->evidencia->id
        ]);

        // Act
        $response = $this->getJson('/api/v1/evidencias/{parent_id}/comentarios?search=' . urlencode($searchTerm));

        // Assert
        $response->assertOk();
        $data = $response->json('data');
        
        $this->assertCount(1, $data);
        $this->assertEquals($comentario1->id, $data[0]['id']);
    }

    /** @test */
    public function can_paginate_comentarios()
    {
        // Arrange
        Comentario::factory()->count(25)->create(['evidencia_id' => $this->evidencia->id]);

        // Act
        $response = $this->getJson('/api/v1/evidencias/{parent_id}/comentarios?per_page=10');

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
    public function test_requires_evidencia_id_field()
    {
        // Arrange
        $data = [
            'contenido' => \$this->faker->paragraph(),
            'tipo' => \$this->faker->randomElement(['feedback', 'mejora', 'felicitacion'])
        ];
        unset($data['evidencia_id']);

        // Act
        $response = $this->postJson('/api/v1comentarios', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('evidencia_id');
    }
    /** @test */
    public function test_requires_docente_id_field()
    {
        // Arrange
        $data = [
            'contenido' => \$this->faker->paragraph(),
            'tipo' => \$this->faker->randomElement(['feedback', 'mejora', 'felicitacion'])
        ];
        unset($data['docente_id']);

        // Act
        $response = $this->postJson('/api/v1comentarios', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('docente_id');
    }
    /** @test */
    public function test_requires_contenido_field()
    {
        // Arrange
        $data = [
            'contenido' => \$this->faker->paragraph(),
            'tipo' => \$this->faker->randomElement(['feedback', 'mejora', 'felicitacion'])
        ];
        unset($data['contenido']);

        // Act
        $response = $this->postJson('/api/v1comentarios', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('contenido');
    }
    /** @test */
    public function test_requires_tipo_field()
    {
        // Arrange
        $data = [
            'contenido' => \$this->faker->paragraph(),
            'tipo' => \$this->faker->randomElement(['feedback', 'mejora', 'felicitacion'])
        ];
        unset($data['tipo']);

        // Act
        $response = $this->postJson('/api/v1comentarios', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('tipo');
    }
    /** @test */
    public function test_tipo_accepts_valid_values()
    {
        foreach (['feedback', 'mejora', 'felicitacion'] as $value) {
            $data = [
            'contenido' => \$this->faker->paragraph(),
            'tipo' => \$this->faker->randomElement(['feedback', 'mejora', 'felicitacion'])
        ];
            $data['tipo'] = $value;

            $response = $this->postJson('/api/v1comentarios', $data);
            $response->assertCreated();
        }
    }

    /** @test */
    public function test_tipo_rejects_invalid_values()
    {
        // Arrange
        $data = [
            'contenido' => \$this->faker->paragraph(),
            'tipo' => \$this->faker->randomElement(['feedback', 'mejora', 'felicitacion'])
        ];
        $data['tipo'] = 'invalid_value';

        // Act
        $response = $this->postJson('/api/v1comentarios', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('tipo');
    }

    /** @test */
    public function requires_authentication()
    {
        // Arrange
        Sanctum::actingAs(null);

        // Act
        $response = $this->getJson('/api/v1/evidencias/{parent_id}/comentarios');

        // Assert
        $response->assertUnauthorized();
    }


    /** @test */
    public function cannot_access_comentario_from_wrong_parent()
    {
        // Arrange
        $otherEvidencia = Evidencia::factory()->create();
        $comentario = Comentario::factory()->create([
            'evidencia_id' => $this->evidencia->id
        ]);

        // Act
        $response = $this->getJson("/api/v1/evidencias/{$otherEvidencia->id}/comentario/{$comentario->id}");

        // Assert
        $response->assertNotFound();
    }

    /** @test */
    public function comentario_belongs_to_correct_parent()
    {
        // Arrange
        $comentario = Comentario::factory()->create([
            'evidencia_id' => $this->evidencia->id
        ]);

        // Act
        $response = $this->getJson("/api/v1/evidencias/{$this->evidencia->id}/comentario/{$comentario->id}");

        // Assert
        $response->assertOk();
        $this->assertEquals($this->evidencia->id, $response->json('data.evidencia_id'));
    }
}
