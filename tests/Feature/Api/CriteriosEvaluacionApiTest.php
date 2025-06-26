<?php

namespace Tests\Feature\Api;

use App\Models\CriteriosEvaluacion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class CriteriosEvaluacionApiTest extends TestCase
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
    public function can_list_criteriosEvaluacions()
    {
        // Arrange
        CriteriosEvaluacion::factory()->count(3)->create();

        // Act
        $response = $this->getJson('/api/v1/criterios-evaluacion');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'resultado_aprendizaje_id', 'codigo', 'descripcion', 'peso_porcentaje', 'orden', 'created_at', 'updated_at']
                     ],
                     'links',
                     'meta'
                 ]);
        
        $this->assertCount(3, $response->json('data'));
    }

    /** @test */
    public function can_create_criteriosEvaluacion()
    {
        // Arrange
        $data = [
            'codigo' => \$this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'descripcion' => \$this->faker->paragraph(),
            'peso_porcentaje' => \$this->faker->randomFloat(2, 0, 100),
            'orden' => \$this->faker->numberBetween(1, 100)
        ];

        // Act
        $response = $this->postJson('/api/v1/criterios-evaluacion', $data);

        // Assert
        $response->assertCreated()
                 ->assertJsonStructure([
                     'data' => ['id', 'resultado_aprendizaje_id', 'codigo', 'descripcion', 'peso_porcentaje', 'orden', 'created_at', 'updated_at']
                 ]);

        $this->assertDatabaseHas('criterios_evaluacion', [
            'codigo' => $data['codigo'],
            'descripcion' => $data['descripcion'],
            'peso_porcentaje' => $data['peso_porcentaje'],
            'orden' => $data['orden']
        ]);
    }

    /** @test */
    public function can_show_criteriosEvaluacion()
    {
        // Arrange
        $criteriosEvaluacion = CriteriosEvaluacion::factory()->create();

        // Act
        $response = $this->getJson('/api/v1/criterios-evaluacion/{$criteriosEvaluacion->id}');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'resultado_aprendizaje_id', 'codigo', 'descripcion', 'peso_porcentaje', 'orden', 'created_at', 'updated_at']
                 ]);
    }

    /** @test */
    public function can_update_criteriosEvaluacion()
    {
        // Arrange
        $criteriosEvaluacion = CriteriosEvaluacion::factory()->create();
        $updateData = [
            'codigo' => \$this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'descripcion' => \$this->faker->paragraph(),
            'peso_porcentaje' => \$this->faker->randomFloat(2, 0, 100),
            'orden' => \$this->faker->numberBetween(1, 100)
        ];

        // Act
        $response = $this->putJson('/api/v1/criterios-evaluacion/{$criteriosEvaluacion->id}', $updateData);

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'resultado_aprendizaje_id', 'codigo', 'descripcion', 'peso_porcentaje', 'orden', 'created_at', 'updated_at']
                 ]);

        $criteriosEvaluacion->refresh();
        $this->assertEquals($updateData['codigo'], $criteriosEvaluacion->$field['name']));
        $this->assertEquals($updateData['descripcion'], $criteriosEvaluacion->$field['name']));
        $this->assertEquals($updateData['peso_porcentaje'], $criteriosEvaluacion->$field['name']));
        $this->assertEquals($updateData['orden'], $criteriosEvaluacion->$field['name']));
    }

    /** @test */
    public function can_delete_criteriosEvaluacion()
    {
        // Arrange
        $criteriosEvaluacion = CriteriosEvaluacion::factory()->create();

        // Act
        $response = $this->deleteJson('/api/v1/criterios-evaluacion/{$criteriosEvaluacion->id}');

        // Assert
        $response->assertOk()
                 ->assertJson([
                     'message' => 'CriteriosEvaluacion eliminado correctamente'
                 ]);

        $this->assertSoftDeleted('criterios_evaluacion', [
            'id' => $criteriosEvaluacion->id
        ]);
    }

    /** @test */
    public function can_search_criteriosEvaluacions()
    {
        // Arrange
        $searchTerm = 'test search';
        $criteriosEvaluacion1 = CriteriosEvaluacion::factory()->create([
            'nombre' => 'Contains test search term',
            
        ]);
        $criteriosEvaluacion2 = CriteriosEvaluacion::factory()->create([
            'nombre' => 'Different content',
            
        ]);

        // Act
        $response = $this->getJson('/api/v1/criterios-evaluacion?search=' . urlencode($searchTerm));

        // Assert
        $response->assertOk();
        $data = $response->json('data');
        
        $this->assertCount(1, $data);
        $this->assertEquals($criteriosEvaluacion1->id, $data[0]['id']);
    }

    /** @test */
    public function can_paginate_criteriosEvaluacions()
    {
        // Arrange
        CriteriosEvaluacion::factory()->count(25)->create();

        // Act
        $response = $this->getJson('/api/v1/criterios-evaluacion?per_page=10');

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
    public function test_requires_resultado_aprendizaje_id_field()
    {
        // Arrange
        $data = [
            'codigo' => \$this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'descripcion' => \$this->faker->paragraph(),
            'peso_porcentaje' => \$this->faker->randomFloat(2, 0, 100),
            'orden' => \$this->faker->numberBetween(1, 100)
        ];
        unset($data['resultado_aprendizaje_id']);

        // Act
        $response = $this->postJson('/api/v1criterios-evaluacion', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('resultado_aprendizaje_id');
    }
    /** @test */
    public function test_requires_codigo_field()
    {
        // Arrange
        $data = [
            'codigo' => \$this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'descripcion' => \$this->faker->paragraph(),
            'peso_porcentaje' => \$this->faker->randomFloat(2, 0, 100),
            'orden' => \$this->faker->numberBetween(1, 100)
        ];
        unset($data['codigo']);

        // Act
        $response = $this->postJson('/api/v1criterios-evaluacion', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('codigo');
    }
    /** @test */
    public function test_requires_descripcion_field()
    {
        // Arrange
        $data = [
            'codigo' => \$this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'descripcion' => \$this->faker->paragraph(),
            'peso_porcentaje' => \$this->faker->randomFloat(2, 0, 100),
            'orden' => \$this->faker->numberBetween(1, 100)
        ];
        unset($data['descripcion']);

        // Act
        $response = $this->postJson('/api/v1criterios-evaluacion', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('descripcion');
    }
    /** @test */
    public function test_requires_peso_porcentaje_field()
    {
        // Arrange
        $data = [
            'codigo' => \$this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'descripcion' => \$this->faker->paragraph(),
            'peso_porcentaje' => \$this->faker->randomFloat(2, 0, 100),
            'orden' => \$this->faker->numberBetween(1, 100)
        ];
        unset($data['peso_porcentaje']);

        // Act
        $response = $this->postJson('/api/v1criterios-evaluacion', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('peso_porcentaje');
    }
    /** @test */
    public function test_requires_orden_field()
    {
        // Arrange
        $data = [
            'codigo' => \$this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'descripcion' => \$this->faker->paragraph(),
            'peso_porcentaje' => \$this->faker->randomFloat(2, 0, 100),
            'orden' => \$this->faker->numberBetween(1, 100)
        ];
        unset($data['orden']);

        // Act
        $response = $this->postJson('/api/v1criterios-evaluacion', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('orden');
    }

    /** @test */
    public function requires_authentication()
    {
        // Arrange
        Sanctum::actingAs(null);

        // Act
        $response = $this->getJson('/api/v1/criterios-evaluacion');

        // Assert
        $response->assertUnauthorized();
    }


}
