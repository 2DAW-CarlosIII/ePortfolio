<?php

namespace Tests\Feature\Api;

use App\Models\EvaluacionPar;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\FeatureTestCase;
use Laravel\Sanctum\Sanctum;

class EvaluacionParApiTest extends FeatureTestCase
{
    use WithFaker;

    protected User $user;
    

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
        
    }

    public function test_can_list_evaluacionPars()
    {
        // Arrange
        EvaluacionPar::factory()->count(3)->create();

        // Act
        $response = $this->getJson('/api/v1/evaluaciones-pares');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'asignacion_revision_id', 'revisor_id', 'puntuacion_sugerida', 'recomendacion', 'justificacion', 'fecha_evaluacion', 'created_at', 'updated_at']
                     ],
                     'links',
                     'meta'
                 ]);
        
        $this->assertCount(3, $response->json('data'));
    }

    public function test_can_create_evaluacionPar()
    {
        // Arrange
        $data = [
            'puntuacion_sugerida' => $this->faker->randomFloat(2, 0, 100),
            'recomendacion' => $this->faker->randomElement(['aprobar', 'mejorar', 'rechazar']),
            'justificacion' => $this->faker->paragraph()
        ];

        // Act
        $response = $this->postJson('/api/v1/evaluaciones-pares', $data);

        // Assert
        $response->assertCreated()
                 ->assertJsonStructure([
                     'data' => ['id', 'asignacion_revision_id', 'revisor_id', 'puntuacion_sugerida', 'recomendacion', 'justificacion', 'fecha_evaluacion', 'created_at', 'updated_at']
                 ]);

        $this->assertDatabaseHas('evaluaciones_pares', [
            'puntuacion_sugerida' => $data['puntuacion_sugerida'],
            'recomendacion' => $data['recomendacion'],
            'justificacion' => $data['justificacion'],
            'fecha_evaluacion' => $data['fecha_evaluacion']
        ]);
    }

    public function test_can_show_evaluacionPar()
    {
        // Arrange
        $evaluacionPar = EvaluacionPar::factory()->create();

        // Act
        $response = $this->getJson('/api/v1/evaluaciones-pares/{$evaluacionPar->id}');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'asignacion_revision_id', 'revisor_id', 'puntuacion_sugerida', 'recomendacion', 'justificacion', 'fecha_evaluacion', 'created_at', 'updated_at']
                 ]);
    }

    public function test_can_update_evaluacionPar()
    {
        // Arrange
        $evaluacionPar = EvaluacionPar::factory()->create();
        $updateData = [
            'puntuacion_sugerida' => $this->faker->randomFloat(2, 0, 100),
            'recomendacion' => $this->faker->randomElement(['aprobar', 'mejorar', 'rechazar']),
            'justificacion' => $this->faker->paragraph()
        ];

        // Act
        $response = $this->putJson('/api/v1/evaluaciones-pares/{$evaluacionPar->id}', $updateData);

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'asignacion_revision_id', 'revisor_id', 'puntuacion_sugerida', 'recomendacion', 'justificacion', 'fecha_evaluacion', 'created_at', 'updated_at']
                 ]);

        $evaluacionPar->refresh();
        $this->assertEquals($updateData['puntuacion_sugerida'], $evaluacionPar->$field['name']);
        $this->assertEquals($updateData['recomendacion'], $evaluacionPar->$field['name']);
        $this->assertEquals($updateData['justificacion'], $evaluacionPar->$field['name']);
        $this->assertEquals($updateData['fecha_evaluacion'], $evaluacionPar->$field['name']);
    }

    public function test_can_delete_evaluacionPar()
    {
        // Arrange
        $evaluacionPar = EvaluacionPar::factory()->create();

        // Act
        $response = $this->deleteJson('/api/v1/evaluaciones-pares/{$evaluacionPar->id}');

        // Assert
        $response->assertOk()
                 ->assertJson([
                     'message' => 'EvaluacionPar eliminado correctamente'
                 ]);

        $this->assertSoftDeleted('evaluaciones_pares', [
            'id' => $evaluacionPar->id
        ]);
    }

    public function test_can_search_evaluacionPars()
    {
        // Arrange
        $searchTerm = 'test search';
        $evaluacionPar1 = EvaluacionPar::factory()->create([
            'nombre' => 'Contains test search term',
            
        ]);
        $evaluacionPar2 = EvaluacionPar::factory()->create([
            'nombre' => 'Different content',
            
        ]);

        // Act
        $response = $this->getJson('/api/v1/evaluaciones-pares?search=' . urlencode($searchTerm));

        // Assert
        $response->assertOk();
        $data = $response->json('data');
        
        $this->assertCount(1, $data);
        $this->assertEquals($evaluacionPar1->id, $data[0]['id']);
    }

    public function test_can_paginate_evaluacionPars()
    {
        // Arrange
        EvaluacionPar::factory()->count(25)->create();

        // Act
        $response = $this->getJson('/api/v1/evaluaciones-pares?per_page=10');

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
            'puntuacion_sugerida' => $this->faker->randomFloat(2, 0, 100),
            'recomendacion' => $this->faker->randomElement(['aprobar', 'mejorar', 'rechazar']),
            'justificacion' => $this->faker->paragraph()
        ];
            unset($data['asignacion_revision_id']);

            // Act
            $response = $this->postJson('/api/v1evaluaciones-pares', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('asignacion_revision_id');
        }
        public function test_requires_revisor_id_field()
        {
            // Arrange
            $data = [
            'puntuacion_sugerida' => $this->faker->randomFloat(2, 0, 100),
            'recomendacion' => $this->faker->randomElement(['aprobar', 'mejorar', 'rechazar']),
            'justificacion' => $this->faker->paragraph()
        ];
            unset($data['revisor_id']);

            // Act
            $response = $this->postJson('/api/v1evaluaciones-pares', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('revisor_id');
        }
        public function test_requires_puntuacion_sugerida_field()
        {
            // Arrange
            $data = [
            'puntuacion_sugerida' => $this->faker->randomFloat(2, 0, 100),
            'recomendacion' => $this->faker->randomElement(['aprobar', 'mejorar', 'rechazar']),
            'justificacion' => $this->faker->paragraph()
        ];
            unset($data['puntuacion_sugerida']);

            // Act
            $response = $this->postJson('/api/v1evaluaciones-pares', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('puntuacion_sugerida');
        }
        public function test_requires_recomendacion_field()
        {
            // Arrange
            $data = [
            'puntuacion_sugerida' => $this->faker->randomFloat(2, 0, 100),
            'recomendacion' => $this->faker->randomElement(['aprobar', 'mejorar', 'rechazar']),
            'justificacion' => $this->faker->paragraph()
        ];
            unset($data['recomendacion']);

            // Act
            $response = $this->postJson('/api/v1evaluaciones-pares', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('recomendacion');
        }
        public function test_requires_justificacion_field()
        {
            // Arrange
            $data = [
            'puntuacion_sugerida' => $this->faker->randomFloat(2, 0, 100),
            'recomendacion' => $this->faker->randomElement(['aprobar', 'mejorar', 'rechazar']),
            'justificacion' => $this->faker->paragraph()
        ];
            unset($data['justificacion']);

            // Act
            $response = $this->postJson('/api/v1evaluaciones-pares', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('justificacion');
        }
        public function test_requires_fecha_evaluacion_field()
        {
            // Arrange
            $data = [
            'puntuacion_sugerida' => $this->faker->randomFloat(2, 0, 100),
            'recomendacion' => $this->faker->randomElement(['aprobar', 'mejorar', 'rechazar']),
            'justificacion' => $this->faker->paragraph()
        ];
            unset($data['fecha_evaluacion']);

            // Act
            $response = $this->postJson('/api/v1evaluaciones-pares', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('fecha_evaluacion');
        }
        public function test_recomendacion_accepts_valid_values()
        {
            foreach (['aprobar', 'mejorar', 'rechazar'] as $value) {
                $data = [
            'puntuacion_sugerida' => $this->faker->randomFloat(2, 0, 100),
            'recomendacion' => $this->faker->randomElement(['aprobar', 'mejorar', 'rechazar']),
            'justificacion' => $this->faker->paragraph()
        ];
                $data['recomendacion'] = $value;

                $response = $this->postJson('/api/v1evaluaciones-pares', $data);
                $response->assertCreated();
            }
        }

        public function test_recomendacion_rejects_invalid_values()
        {
            // Arrange
            $data = [
            'puntuacion_sugerida' => $this->faker->randomFloat(2, 0, 100),
            'recomendacion' => $this->faker->randomElement(['aprobar', 'mejorar', 'rechazar']),
            'justificacion' => $this->faker->paragraph()
        ];
            $data['recomendacion'] = 'invalid_value';

            // Act
            $response = $this->postJson('/api/v1evaluaciones-pares', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('recomendacion');
        }

    public function test_requires_authentication()
    {
        // Arrange
        Sanctum::actingAs(null);

        // Act
        $response = $this->getJson('/api/v1/evaluaciones-pares');

        // Assert
        $response->assertUnauthorized();
    }


}
