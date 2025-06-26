<?php

namespace Tests\Feature\Api;

use App\Models\Evidencia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class EvidenciaApiTest extends TestCase
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
    public function can_list_evidencias()
    {
        // Arrange
        Evidencia::factory()->count(3)->create();

        // Act
        $response = $this->getJson('/api/v1/evidencias');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'estudiante_id', 'criterio_evaluacion_id', 'url', 'descripcion', 'estado_validacion', 'fecha_creacion', 'created_at', 'updated_at']
                     ],
                     'links',
                     'meta'
                 ]);
        
        $this->assertCount(3, $response->json('data'));
    }

    /** @test */
    public function can_create_evidencia()
    {
        // Arrange
        $data = [
            'url' => \$this->faker->words(3, true),
            'descripcion' => \$this->faker->paragraph(),
            'estado_validacion' => \$this->faker->randomElement(['pendiente', 'validada', 'rechazada'])
        ];

        // Act
        $response = $this->postJson('/api/v1/evidencias', $data);

        // Assert
        $response->assertCreated()
                 ->assertJsonStructure([
                     'data' => ['id', 'estudiante_id', 'criterio_evaluacion_id', 'url', 'descripcion', 'estado_validacion', 'fecha_creacion', 'created_at', 'updated_at']
                 ]);

        $this->assertDatabaseHas('evidencias', [
            'url' => $data['url'],
            'descripcion' => $data['descripcion'],
            'estado_validacion' => $data['estado_validacion'],
            'fecha_creacion' => $data['fecha_creacion']
        ]);
    }

    /** @test */
    public function can_show_evidencia()
    {
        // Arrange
        $evidencia = Evidencia::factory()->create();

        // Act
        $response = $this->getJson('/api/v1/evidencias/{$evidencia->id}');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'estudiante_id', 'criterio_evaluacion_id', 'url', 'descripcion', 'estado_validacion', 'fecha_creacion', 'created_at', 'updated_at']
                 ]);
    }

    /** @test */
    public function can_update_evidencia()
    {
        // Arrange
        $evidencia = Evidencia::factory()->create();
        $updateData = [
            'url' => \$this->faker->words(3, true),
            'descripcion' => \$this->faker->paragraph(),
            'estado_validacion' => \$this->faker->randomElement(['pendiente', 'validada', 'rechazada'])
        ];

        // Act
        $response = $this->putJson('/api/v1/evidencias/{$evidencia->id}', $updateData);

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'estudiante_id', 'criterio_evaluacion_id', 'url', 'descripcion', 'estado_validacion', 'fecha_creacion', 'created_at', 'updated_at']
                 ]);

        $evidencia->refresh();
        $this->assertEquals($updateData['url'], $evidencia->$field['name']));
        $this->assertEquals($updateData['descripcion'], $evidencia->$field['name']));
        $this->assertEquals($updateData['estado_validacion'], $evidencia->$field['name']));
        $this->assertEquals($updateData['fecha_creacion'], $evidencia->$field['name']));
    }

    /** @test */
    public function can_delete_evidencia()
    {
        // Arrange
        $evidencia = Evidencia::factory()->create();

        // Act
        $response = $this->deleteJson('/api/v1/evidencias/{$evidencia->id}');

        // Assert
        $response->assertOk()
                 ->assertJson([
                     'message' => 'Evidencia eliminado correctamente'
                 ]);

        $this->assertSoftDeleted('evidencias', [
            'id' => $evidencia->id
        ]);
    }

    /** @test */
    public function can_search_evidencias()
    {
        // Arrange
        $searchTerm = 'test search';
        $evidencia1 = Evidencia::factory()->create([
            'nombre' => 'Contains test search term',
            
        ]);
        $evidencia2 = Evidencia::factory()->create([
            'nombre' => 'Different content',
            
        ]);

        // Act
        $response = $this->getJson('/api/v1/evidencias?search=' . urlencode($searchTerm));

        // Assert
        $response->assertOk();
        $data = $response->json('data');
        
        $this->assertCount(1, $data);
        $this->assertEquals($evidencia1->id, $data[0]['id']);
    }

    /** @test */
    public function can_paginate_evidencias()
    {
        // Arrange
        Evidencia::factory()->count(25)->create();

        // Act
        $response = $this->getJson('/api/v1/evidencias?per_page=10');

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
    public function test_requires_estudiante_id_field()
    {
        // Arrange
        $data = [
            'url' => \$this->faker->words(3, true),
            'descripcion' => \$this->faker->paragraph(),
            'estado_validacion' => \$this->faker->randomElement(['pendiente', 'validada', 'rechazada'])
        ];
        unset($data['estudiante_id']);

        // Act
        $response = $this->postJson('/api/v1evidencias', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('estudiante_id');
    }
    /** @test */
    public function test_requires_criterio_evaluacion_id_field()
    {
        // Arrange
        $data = [
            'url' => \$this->faker->words(3, true),
            'descripcion' => \$this->faker->paragraph(),
            'estado_validacion' => \$this->faker->randomElement(['pendiente', 'validada', 'rechazada'])
        ];
        unset($data['criterio_evaluacion_id']);

        // Act
        $response = $this->postJson('/api/v1evidencias', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('criterio_evaluacion_id');
    }
    /** @test */
    public function test_requires_url_field()
    {
        // Arrange
        $data = [
            'url' => \$this->faker->words(3, true),
            'descripcion' => \$this->faker->paragraph(),
            'estado_validacion' => \$this->faker->randomElement(['pendiente', 'validada', 'rechazada'])
        ];
        unset($data['url']);

        // Act
        $response = $this->postJson('/api/v1evidencias', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('url');
    }
    /** @test */
    public function test_requires_descripcion_field()
    {
        // Arrange
        $data = [
            'url' => \$this->faker->words(3, true),
            'descripcion' => \$this->faker->paragraph(),
            'estado_validacion' => \$this->faker->randomElement(['pendiente', 'validada', 'rechazada'])
        ];
        unset($data['descripcion']);

        // Act
        $response = $this->postJson('/api/v1evidencias', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('descripcion');
    }
    /** @test */
    public function test_requires_estado_validacion_field()
    {
        // Arrange
        $data = [
            'url' => \$this->faker->words(3, true),
            'descripcion' => \$this->faker->paragraph(),
            'estado_validacion' => \$this->faker->randomElement(['pendiente', 'validada', 'rechazada'])
        ];
        unset($data['estado_validacion']);

        // Act
        $response = $this->postJson('/api/v1evidencias', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('estado_validacion');
    }
    /** @test */
    public function test_requires_fecha_creacion_field()
    {
        // Arrange
        $data = [
            'url' => \$this->faker->words(3, true),
            'descripcion' => \$this->faker->paragraph(),
            'estado_validacion' => \$this->faker->randomElement(['pendiente', 'validada', 'rechazada'])
        ];
        unset($data['fecha_creacion']);

        // Act
        $response = $this->postJson('/api/v1evidencias', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('fecha_creacion');
    }
    /** @test */
    public function test_estado_validacion_accepts_valid_values()
    {
        foreach (['pendiente', 'validada', 'rechazada'] as $value) {
            $data = [
            'url' => \$this->faker->words(3, true),
            'descripcion' => \$this->faker->paragraph(),
            'estado_validacion' => \$this->faker->randomElement(['pendiente', 'validada', 'rechazada'])
        ];
            $data['estado_validacion'] = $value;

            $response = $this->postJson('/api/v1evidencias', $data);
            $response->assertCreated();
        }
    }

    /** @test */
    public function test_estado_validacion_rejects_invalid_values()
    {
        // Arrange
        $data = [
            'url' => \$this->faker->words(3, true),
            'descripcion' => \$this->faker->paragraph(),
            'estado_validacion' => \$this->faker->randomElement(['pendiente', 'validada', 'rechazada'])
        ];
        $data['estado_validacion'] = 'invalid_value';

        // Act
        $response = $this->postJson('/api/v1evidencias', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('estado_validacion');
    }

    /** @test */
    public function requires_authentication()
    {
        // Arrange
        Sanctum::actingAs(null);

        // Act
        $response = $this->getJson('/api/v1/evidencias');

        // Assert
        $response->assertUnauthorized();
    }


}
