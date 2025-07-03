<?php

namespace Tests\Feature\Api;

use App\Models\EvaluacionEvidencia;
use App\Models\User;
use App\Models\Evidencia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\FeatureTestCase;
use Laravel\Sanctum\Sanctum;

class EvaluacionEvidenciaApiTest extends FeatureTestCase
{
    use WithFaker;

    protected User $user;
    protected Evidencia $evidencia;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);

        $this->evidencia = Evidencia::factory()->create();
    }

    public function test_can_list_evaluacionEvidencias()
    {
        // Arrange
        EvaluacionEvidencia::factory()->count(3)->create(['evidencia_id' => $this->evidencia->id]);

        // Act
        $response = $this->getJson("/api/v1/evidencias/{$this->evidencia->id}/evaluaciones-evidencias");

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'evidencia_id', 'user_id', 'puntuacion', 'estado', 'observaciones', 'fecha_evaluacion', 'created_at', 'updated_at']
                     ],
                     'links',
                     'meta'
                 ]);

        $this->assertCount(3, $response->json('data'));
    }

    public function test_can_create_evaluacionEvidencia()
    {
        // Arrange
        $data = [
            'puntuacion' => $this->faker->randomFloat(2, 0, 10),
            'estado' => $this->faker->randomElement(['pendiente', 'aprobada', 'rechazada']),
            'observaciones' => $this->faker->paragraph()
        ];

        // Act
        $response = $this->postJson("/api/v1/evidencias/{$this->evidencia->id}/evaluaciones-evidencias", $data);

        // Assert
        $response->assertCreated()
                 ->assertJsonStructure([
                     'data' => ['id', 'evidencia_id', 'user_id', 'puntuacion', 'estado', 'observaciones', 'fecha_evaluacion', 'created_at', 'updated_at']
                 ]);

        $this->assertDatabaseHas('evaluaciones_evidencias', [
            'puntuacion' => $data['puntuacion'],
            'estado' => $data['estado'],
            'observaciones' => $data['observaciones']
        ]);
    }

    public function test_can_show_evaluacionEvidencia()
    {
        // Arrange
        $evaluacionEvidencia = EvaluacionEvidencia::factory()->create(['evidencia_id' => $this->evidencia->id]);

        // Act
        $response = $this->getJson("/api/v1/evidencias/{$this->evidencia->id}/evaluaciones-evidencias/{$evaluacionEvidencia->id}");

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'evidencia_id', 'user_id', 'puntuacion', 'estado', 'observaciones', 'fecha_evaluacion', 'created_at', 'updated_at']
                 ]);
    }

    public function test_can_update_evaluacionEvidencia()
    {
        // Arrange
        $evaluacionEvidencia = EvaluacionEvidencia::factory()->create(['evidencia_id' => $this->evidencia->id]);
        $updateData = [
            'puntuacion' => $this->faker->randomFloat(2, 0, 10),
            'estado' => $this->faker->randomElement(['pendiente', 'aprobada', 'rechazada']),
            'observaciones' => $this->faker->paragraph()
        ];

        // Act
        $response = $this->putJson("/api/v1/evidencias/{$this->evidencia->id}/evaluaciones-evidencias/{$evaluacionEvidencia->id}", $updateData);

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'evidencia_id', 'user_id', 'puntuacion', 'estado', 'observaciones', 'fecha_evaluacion', 'created_at', 'updated_at']
                 ]);

        $evaluacionEvidencia->refresh();
        $this->assertEquals($updateData['puntuacion'], $evaluacionEvidencia->puntuacion);
        $this->assertEquals($updateData['estado'], $evaluacionEvidencia->estado);
        $this->assertEquals($updateData['observaciones'], $evaluacionEvidencia->observaciones);
    }

    public function test_can_delete_evaluacionEvidencia()
    {
        // Arrange
        $evaluacionEvidencia = EvaluacionEvidencia::factory()->create(['evidencia_id' => $this->evidencia->id]);

        // Act
        $response = $this->deleteJson("/api/v1/evidencias/{$this->evidencia->id}/evaluaciones-evidencias/{$evaluacionEvidencia->id}");

        // Assert
        $response->assertOk()
                 ->assertJson([
                     'message' => 'EvaluacionEvidencia eliminado correctamente'
                 ]);
    }

    public function test_can_search_evaluacionEvidencias()
    {
        // Arrange
        $searchTerm = 'test search';
        $evaluacionEvidencia1 = EvaluacionEvidencia::factory()->create([
            'observaciones' => 'Contains test search term',
            'evidencia_id' => $this->evidencia->id
        ]);
        $evaluacionEvidencia2 = EvaluacionEvidencia::factory()->create([
            'observaciones' => 'Different content',
            'evidencia_id' => $this->evidencia->id
        ]);

        // Act
        $response = $this->getJson("/api/v1/evidencias/{$this->evidencia->id}/evaluaciones-evidencias?search=" . urlencode($searchTerm));

        // Assert
        $response->assertOk();
        $data = $response->json('data');

        $this->assertCount(1, $data);
        $this->assertEquals($evaluacionEvidencia1->id, $data[0]['id']);
    }

    public function test_can_paginate_evaluacionEvidencias()
    {
        // Arrange
        EvaluacionEvidencia::factory()->count(25)->create(['evidencia_id' => $this->evidencia->id]);

        // Act
        $response = $this->getJson("/api/v1/evidencias/{$this->evidencia->id}/evaluaciones-evidencias?per_page=10");

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
        public function test_requires_puntuacion_field()
        {
            // Arrange
            $data = [
            'puntuacion' => $this->faker->randomFloat(2, 0, 10),
            'estado' => $this->faker->randomElement(['pendiente', 'aprobada', 'rechazada']),
            'observaciones' => $this->faker->paragraph()
        ];
            unset($data['puntuacion']);

            // Act
            $response = $this->postJson("/api/v1/evidencias/{$this->evidencia->id}/evaluaciones-evidencias", $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('puntuacion');
        }
        public function test_requires_estado_field()
        {
            // Arrange
            $data = [
            'puntuacion' => $this->faker->randomFloat(2, 0, 10),
            'estado' => $this->faker->randomElement(['pendiente', 'aprobada', 'rechazada']),
            'observaciones' => $this->faker->paragraph()
        ];
            unset($data['estado']);

            // Act
            $response = $this->postJson("/api/v1/evidencias/{$this->evidencia->id}/evaluaciones-evidencias", $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('estado');
        }
        public function test_requires_observaciones_field()
        {
            // Arrange
            $data = [
            'puntuacion' => $this->faker->randomFloat(2, 0, 10),
            'estado' => $this->faker->randomElement(['pendiente', 'aprobada', 'rechazada']),
            'observaciones' => $this->faker->paragraph()
        ];
            unset($data['observaciones']);

            // Act
            $response = $this->postJson("/api/v1/evidencias/{$this->evidencia->id}/evaluaciones-evidencias", $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('observaciones');
        }

        public function test_estado_accepts_valid_values()
        {
            foreach (['pendiente', 'aprobada', 'rechazada'] as $value) {
                $data = [
            'puntuacion' => $this->faker->randomFloat(2, 0, 10),
            'estado' => $this->faker->randomElement(['pendiente', 'aprobada', 'rechazada']),
            'observaciones' => $this->faker->paragraph()
        ];
                $data['estado'] = $value;

                $response = $this->postJson("/api/v1/evidencias/{$this->evidencia->id}/evaluaciones-evidencias", $data);
                $response->assertCreated();
            }
        }

        public function test_estado_rejects_invalid_values()
        {
            // Arrange
            $data = [
            'puntuacion' => $this->faker->randomFloat(2, 0, 10),
            'estado' => $this->faker->randomElement(['pendiente', 'aprobada', 'rechazada']),
            'observaciones' => $this->faker->paragraph()
        ];
            $data['estado'] = 'invalid_value';

            // Act
            $response = $this->postJson("/api/v1/evidencias/{$this->evidencia->id}/evaluaciones-evidencias", $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('estado');
        }

    public function test_requires_authentication()
    {
        // Arrange
        Sanctum::actingAs(null);

        // Act
        $response = $this->getJson("/api/v1/evidencias/{$this->evidencia->id}/evaluaciones-evidencias");

        // Assert
        $response->assertUnauthorized();
    }


        public function test_cannot_access_evaluacionEvidencia_from_wrong_parent()
        {
            // Arrange
            $otherEvidencia = Evidencia::factory()->create();
            $evaluacionEvidencia = EvaluacionEvidencia::factory()->create([
                'evidencia_id' => $this->evidencia->id
            ]);

            // Act
            $response = $this->getJson("/api/v1/evidencias/{$otherEvidencia->id}/evaluaciones-evidencias/{$evaluacionEvidencia->id}");

            // Assert
            $response->assertNotFound();
        }

        public function test_evaluacionEvidencia_belongs_to_correct_parent()
        {
            // Arrange
            $evaluacionEvidencia = EvaluacionEvidencia::factory()->create([
                'evidencia_id' => $this->evidencia->id
            ]);

            // Act
            $response = $this->getJson("/api/v1/evidencias/{$this->evidencia->id}/evaluaciones-evidencias/{$evaluacionEvidencia->id}");

            // Assert
            $response->assertOk();
            $this->assertEquals($this->evidencia->id, $response->json('data.evidencia_id'));
        }
}
