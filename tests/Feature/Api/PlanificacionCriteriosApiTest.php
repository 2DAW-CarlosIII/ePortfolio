<?php

namespace Tests\Feature\Api;

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
    

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
        
    }

    public function test_can_list_planificacionCriterioss()
    {
        // Arrange
        PlanificacionCriterios::factory()->count(3)->create();

        // Act
        $response = $this->getJson('/api/v1/planificacion-criterios');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'criterio_evaluacion_id', 'modulo_formativo_id', 'fecha_apertura', 'fecha_cierre', 'activo', 'observaciones', 'created_at', 'updated_at']
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
            'fecha_apertura' => $this->faker->date(),
            'fecha_cierre' => $this->faker->date(),
            'activo' => $this->faker->boolean(),
            'observaciones' => $this->faker->paragraph()
        ];

        // Act
        $response = $this->postJson('/api/v1/planificacion-criterios', $data);

        // Assert
        $response->assertCreated()
                 ->assertJsonStructure([
                     'data' => ['id', 'criterio_evaluacion_id', 'modulo_formativo_id', 'fecha_apertura', 'fecha_cierre', 'activo', 'observaciones', 'created_at', 'updated_at']
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
        $planificacionCriterios = PlanificacionCriterios::factory()->create();

        // Act
        $response = $this->getJson('/api/v1/planificacion-criterios/{$planificacionCriterios->id}');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'criterio_evaluacion_id', 'modulo_formativo_id', 'fecha_apertura', 'fecha_cierre', 'activo', 'observaciones', 'created_at', 'updated_at']
                 ]);
    }

    public function test_can_update_planificacionCriterios()
    {
        // Arrange
        $planificacionCriterios = PlanificacionCriterios::factory()->create();
        $updateData = [
            'fecha_apertura' => $this->faker->date(),
            'fecha_cierre' => $this->faker->date(),
            'activo' => $this->faker->boolean(),
            'observaciones' => $this->faker->paragraph()
        ];

        // Act
        $response = $this->putJson('/api/v1/planificacion-criterios/{$planificacionCriterios->id}', $updateData);

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'criterio_evaluacion_id', 'modulo_formativo_id', 'fecha_apertura', 'fecha_cierre', 'activo', 'observaciones', 'created_at', 'updated_at']
                 ]);

        $planificacionCriterios->refresh();
        $this->assertEquals($updateData['fecha_apertura'], $planificacionCriterios->$field['name']);
        $this->assertEquals($updateData['fecha_cierre'], $planificacionCriterios->$field['name']);
        $this->assertEquals($updateData['activo'], $planificacionCriterios->$field['name']);
        $this->assertEquals($updateData['observaciones'], $planificacionCriterios->$field['name']);
    }

    public function test_can_delete_planificacionCriterios()
    {
        // Arrange
        $planificacionCriterios = PlanificacionCriterios::factory()->create();

        // Act
        $response = $this->deleteJson('/api/v1/planificacion-criterios/{$planificacionCriterios->id}');

        // Assert
        $response->assertOk()
                 ->assertJson([
                     'message' => 'PlanificacionCriterios eliminado correctamente'
                 ]);

        $this->assertSoftDeleted('planificacion_criterios', [
            'id' => $planificacionCriterios->id
        ]);
    }

    public function test_can_search_planificacionCriterioss()
    {
        // Arrange
        $searchTerm = 'test search';
        $planificacionCriterios1 = PlanificacionCriterios::factory()->create([
            'nombre' => 'Contains test search term',
            
        ]);
        $planificacionCriterios2 = PlanificacionCriterios::factory()->create([
            'nombre' => 'Different content',
            
        ]);

        // Act
        $response = $this->getJson('/api/v1/planificacion-criterios?search=' . urlencode($searchTerm));

        // Assert
        $response->assertOk();
        $data = $response->json('data');
        
        $this->assertCount(1, $data);
        $this->assertEquals($planificacionCriterios1->id, $data[0]['id']);
    }

    public function test_can_paginate_planificacionCriterioss()
    {
        // Arrange
        PlanificacionCriterios::factory()->count(25)->create();

        // Act
        $response = $this->getJson('/api/v1/planificacion-criterios?per_page=10');

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


        public function test_requires_criterio_evaluacion_id_field()
        {
            // Arrange
            $data = [
            'fecha_apertura' => $this->faker->date(),
            'fecha_cierre' => $this->faker->date(),
            'activo' => $this->faker->boolean(),
            'observaciones' => $this->faker->paragraph()
        ];
            unset($data['criterio_evaluacion_id']);

            // Act
            $response = $this->postJson('/api/v1planificacion-criterios', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('criterio_evaluacion_id');
        }
        public function test_requires_modulo_formativo_id_field()
        {
            // Arrange
            $data = [
            'fecha_apertura' => $this->faker->date(),
            'fecha_cierre' => $this->faker->date(),
            'activo' => $this->faker->boolean(),
            'observaciones' => $this->faker->paragraph()
        ];
            unset($data['modulo_formativo_id']);

            // Act
            $response = $this->postJson('/api/v1planificacion-criterios', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('modulo_formativo_id');
        }
        public function test_requires_fecha_apertura_field()
        {
            // Arrange
            $data = [
            'fecha_apertura' => $this->faker->date(),
            'fecha_cierre' => $this->faker->date(),
            'activo' => $this->faker->boolean(),
            'observaciones' => $this->faker->paragraph()
        ];
            unset($data['fecha_apertura']);

            // Act
            $response = $this->postJson('/api/v1planificacion-criterios', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('fecha_apertura');
        }
        public function test_requires_fecha_cierre_field()
        {
            // Arrange
            $data = [
            'fecha_apertura' => $this->faker->date(),
            'fecha_cierre' => $this->faker->date(),
            'activo' => $this->faker->boolean(),
            'observaciones' => $this->faker->paragraph()
        ];
            unset($data['fecha_cierre']);

            // Act
            $response = $this->postJson('/api/v1planificacion-criterios', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('fecha_cierre');
        }
        public function test_requires_activo_field()
        {
            // Arrange
            $data = [
            'fecha_apertura' => $this->faker->date(),
            'fecha_cierre' => $this->faker->date(),
            'activo' => $this->faker->boolean(),
            'observaciones' => $this->faker->paragraph()
        ];
            unset($data['activo']);

            // Act
            $response = $this->postJson('/api/v1planificacion-criterios', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('activo');
        }
        public function test_requires_observaciones_field()
        {
            // Arrange
            $data = [
            'fecha_apertura' => $this->faker->date(),
            'fecha_cierre' => $this->faker->date(),
            'activo' => $this->faker->boolean(),
            'observaciones' => $this->faker->paragraph()
        ];
            unset($data['observaciones']);

            // Act
            $response = $this->postJson('/api/v1planificacion-criterios', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('observaciones');
        }

    public function test_requires_authentication()
    {
        // Arrange
        Sanctum::actingAs(null);

        // Act
        $response = $this->getJson('/api/v1/planificacion-criterios');

        // Assert
        $response->assertUnauthorized();
    }


}
