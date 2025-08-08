<?php

namespace Tests\Feature\Api;

use App\Models\CriterioEvaluacion;
use App\Models\PlanificacionCriterios;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\FeatureTestCase;
use Laravel\Sanctum\Sanctum;

class PlanificacionCriteriosApiTest extends FeatureTestCase
{
    use WithFaker;

    protected User $user;
    protected CriterioEvaluacion $criterioEvaluacion;


    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);

        $this->criterioEvaluacion = CriterioEvaluacion::factory()->create();

    }

    public function test_can_list_planificacionCriterioss()
    {
        // Arrange
        PlanificacionCriterios::factory()->count(3)->create([
            'criterio_evaluacion_id' => $this->criterioEvaluacion->id
        ]);

        // Act
        $response = $this->getJson("/api/v1/criterios-evaluacion/{$this->criterioEvaluacion->id}/planificacion-criterios");

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'criterio_evaluacion_id', 'fecha_apertura', 'fecha_cierre', 'activo', 'observaciones', 'created_at', 'updated_at']
                     ],
                     'links',
                     'meta'
                 ]);

        $this->assertCount(3, $response->json('data'));
    }

    public function test_can_create_planificacionCriterios()
    {
        // Arrange
        $data = [
            'fecha_apertura' => now()->format('Y-m-d H:i:s'),
            'fecha_cierre' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d H:i:s'),
            'activo' => $this->faker->boolean(),
            'observaciones' => $this->faker->paragraph()
        ];

        // Act
        $response = $this->postJson("/api/v1/criterios-evaluacion/{$this->criterioEvaluacion->id}/planificacion-criterios", $data);

        // Assert
        $response->assertCreated()
                 ->assertJsonStructure([
                     'data' => ['id', 'criterio_evaluacion_id', 'fecha_apertura', 'fecha_cierre', 'activo', 'observaciones', 'created_at', 'updated_at']
                 ]);

        $this->assertDatabaseHas('planificacion_criterios', [
            'fecha_apertura' => $data['fecha_apertura'],
            'fecha_cierre' => $data['fecha_cierre'],
            'activo' => $data['activo'],
            'observaciones' => $data['observaciones']
        ]);
    }

    public function test_can_show_planificacionCriterios()
    {
        // Arrange
        $planificacionCriterios = PlanificacionCriterios::factory()->create([
            'criterio_evaluacion_id' => $this->criterioEvaluacion->id
        ]);

        // Act
        $response = $this->getJson("/api/v1/criterios-evaluacion/{$this->criterioEvaluacion->id}/planificacion-criterios/{$planificacionCriterios->id}");

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'criterio_evaluacion_id', 'fecha_apertura', 'fecha_cierre', 'activo', 'observaciones', 'created_at', 'updated_at']
                 ]);
    }

    public function test_can_update_planificacionCriterios()
    {
        // Arrange
        $planificacionCriterios = PlanificacionCriterios::factory()->create([
            'criterio_evaluacion_id' => $this->criterioEvaluacion->id
        ]);
        $updateData = [
            'fecha_apertura' => now()->format('Y-m-d'),
            'fecha_cierre' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'activo' => $this->faker->boolean(),
            'observaciones' => $this->faker->paragraph()
        ];

        // Act
        $response = $this->putJson("/api/v1/criterios-evaluacion/{$this->criterioEvaluacion->id}/planificacion-criterios/{$planificacionCriterios->id}", $updateData);

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'criterio_evaluacion_id', 'fecha_apertura', 'fecha_cierre', 'activo', 'observaciones', 'created_at', 'updated_at']
                 ]);

        $planificacionCriterios->refresh();
        $this->assertEquals($updateData['fecha_apertura'], $planificacionCriterios->fecha_apertura->format('Y-m-d'));
        $this->assertEquals($updateData['fecha_cierre'], $planificacionCriterios->fecha_cierre->format('Y-m-d'));
        $this->assertEquals($updateData['activo'], $planificacionCriterios->activo);
        $this->assertEquals($updateData['observaciones'], $planificacionCriterios->observaciones);
    }

    public function test_can_delete_planificacionCriterios()
    {
        // Arrange
        $planificacionCriterios = PlanificacionCriterios::factory()->create([
            'criterio_evaluacion_id' => $this->criterioEvaluacion->id
        ]);

        // Act
        $response = $this->deleteJson("/api/v1/criterios-evaluacion/{$this->criterioEvaluacion->id}/planificacion-criterios/{$planificacionCriterios->id}");

        // Assert
        $response->assertOk()
                 ->assertJson([
                     'message' => 'PlanificacionCriterios eliminado correctamente'
                 ]);
    }

    public function test_can_paginate_planificacionCriterioss()
    {
        // Arrange
        PlanificacionCriterios::factory()->count(25)->create([
            'criterio_evaluacion_id' => $this->criterioEvaluacion->id
        ]);

        // Act
        $response = $this->getJson("/api/v1/criterios-evaluacion/{$this->criterioEvaluacion->id}/planificacion-criterios?per_page=10");

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

    public function test_requires_fecha_apertura_field()
    {
        // Arrange
        $data = [
            'fecha_apertura' => now()->format('Y-m-d'),
            'fecha_cierre' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'activo' => $this->faker->boolean(),
            'observaciones' => $this->faker->paragraph()
        ];
        unset($data['fecha_apertura']);

        // Act
        $response = $this->postJson("/api/v1/criterios-evaluacion/{$this->criterioEvaluacion->id}/planificacion-criterios", $data);

        // Assert
        $response->assertUnprocessable()
                    ->assertJsonValidationErrors('fecha_apertura');
    }
    public function test_requires_fecha_cierre_field()
    {
        // Arrange
        $data = [
            'fecha_apertura' => now()->format('Y-m-d'),
            'fecha_cierre' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'activo' => $this->faker->boolean(),
            'observaciones' => $this->faker->paragraph()
        ];
        unset($data['fecha_cierre']);

        // Act
        $response = $this->postJson("/api/v1/criterios-evaluacion/{$this->criterioEvaluacion->id}/planificacion-criterios", $data);

        // Assert
        $response->assertUnprocessable()
                    ->assertJsonValidationErrors('fecha_cierre');
    }
    public function test_requires_activo_field()
    {
        // Arrange
        $data = [
            'fecha_apertura' => now()->format('Y-m-d'),
            'fecha_cierre' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'activo' => $this->faker->boolean(),
            'observaciones' => $this->faker->paragraph()
        ];
        unset($data['activo']);

        // Act
        $response = $this->postJson("/api/v1/criterios-evaluacion/{$this->criterioEvaluacion->id}/planificacion-criterios", $data);

        // Assert
        $response->assertUnprocessable()
                    ->assertJsonValidationErrors('activo');
    }
}
