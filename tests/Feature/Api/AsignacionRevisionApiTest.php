<?php

namespace Tests\Feature\Api;

use App\Models\AsignacionRevision;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class AsignacionRevisionApiTest extends TestCase
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
    public function can_list_asignacionRevisions()
    {
        // Arrange
        AsignacionRevision::factory()->count(3)->create(['evidencia_id' => $this->evidencia->id]);

        // Act
        $response = $this->getJson('/api/v1/evidencias/{parent_id}/asignaciones-revision');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'evidencia_id', 'revisor_id', 'asignado_por_id', 'fecha_asignacion', 'fecha_limite', 'estado', 'created_at', 'updated_at']
                     ],
                     'links',
                     'meta'
                 ]);
        
        $this->assertCount(3, $response->json('data'));
    }

    /** @test */
    public function can_create_asignacionRevision()
    {
        // Arrange
        $data = [
            'fecha_asignacion' => \$this->faker->date(),
            'fecha_limite' => \$this->faker->date(),
            'estado' => \$this->faker->randomElement(['pendiente', 'completada', 'expirada'])
        ];

        // Act
        $response = $this->postJson('/api/v1/evidencias/{parent_id}/asignaciones-revision', $data);

        // Assert
        $response->assertCreated()
                 ->assertJsonStructure([
                     'data' => ['id', 'evidencia_id', 'revisor_id', 'asignado_por_id', 'fecha_asignacion', 'fecha_limite', 'estado', 'created_at', 'updated_at']
                 ]);

        $this->assertDatabaseHas('asignaciones_revision', [
            'fecha_asignacion' => $data['fecha_asignacion'],
            'fecha_limite' => $data['fecha_limite'],
            'estado' => $data['estado']
        ]);
    }

    /** @test */
    public function can_show_asignacionRevision()
    {
        // Arrange
        $asignacionRevision = AsignacionRevision::factory()->create(['evidencia_id' => $this->evidencia->id]);

        // Act
        $response = $this->getJson('/api/v1/evidencias/{parent_id}/asignaciones-revision/{$asignacionRevision->id}');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'evidencia_id', 'revisor_id', 'asignado_por_id', 'fecha_asignacion', 'fecha_limite', 'estado', 'created_at', 'updated_at']
                 ]);
    }

    /** @test */
    public function can_update_asignacionRevision()
    {
        // Arrange
        $asignacionRevision = AsignacionRevision::factory()->create(['evidencia_id' => $this->evidencia->id]);
        $updateData = [
            'fecha_asignacion' => \$this->faker->date(),
            'fecha_limite' => \$this->faker->date(),
            'estado' => \$this->faker->randomElement(['pendiente', 'completada', 'expirada'])
        ];

        // Act
        $response = $this->putJson('/api/v1/evidencias/{parent_id}/asignaciones-revision/{$asignacionRevision->id}', $updateData);

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'evidencia_id', 'revisor_id', 'asignado_por_id', 'fecha_asignacion', 'fecha_limite', 'estado', 'created_at', 'updated_at']
                 ]);

        $asignacionRevision->refresh();
        $this->assertEquals($updateData['fecha_asignacion'], $asignacionRevision->$field['name']));
        $this->assertEquals($updateData['fecha_limite'], $asignacionRevision->$field['name']));
        $this->assertEquals($updateData['estado'], $asignacionRevision->$field['name']));
    }

    /** @test */
    public function can_delete_asignacionRevision()
    {
        // Arrange
        $asignacionRevision = AsignacionRevision::factory()->create(['evidencia_id' => $this->evidencia->id]);

        // Act
        $response = $this->deleteJson('/api/v1/evidencias/{parent_id}/asignaciones-revision/{$asignacionRevision->id}');

        // Assert
        $response->assertOk()
                 ->assertJson([
                     'message' => 'AsignacionRevision eliminado correctamente'
                 ]);

        $this->assertSoftDeleted('asignaciones_revision', [
            'id' => $asignacionRevision->id
        ]);
    }

    /** @test */
    public function can_search_asignacionRevisions()
    {
        // Arrange
        $searchTerm = 'test search';
        $asignacionRevision1 = AsignacionRevision::factory()->create([
            'nombre' => 'Contains test search term',
            'evidencia_id' => $this->evidencia->id
        ]);
        $asignacionRevision2 = AsignacionRevision::factory()->create([
            'nombre' => 'Different content',
            'evidencia_id' => $this->evidencia->id
        ]);

        // Act
        $response = $this->getJson('/api/v1/evidencias/{parent_id}/asignaciones-revision?search=' . urlencode($searchTerm));

        // Assert
        $response->assertOk();
        $data = $response->json('data');
        
        $this->assertCount(1, $data);
        $this->assertEquals($asignacionRevision1->id, $data[0]['id']);
    }

    /** @test */
    public function can_paginate_asignacionRevisions()
    {
        // Arrange
        AsignacionRevision::factory()->count(25)->create(['evidencia_id' => $this->evidencia->id]);

        // Act
        $response = $this->getJson('/api/v1/evidencias/{parent_id}/asignaciones-revision?per_page=10');

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
            'fecha_asignacion' => \$this->faker->date(),
            'fecha_limite' => \$this->faker->date(),
            'estado' => \$this->faker->randomElement(['pendiente', 'completada', 'expirada'])
        ];
        unset($data['evidencia_id']);

        // Act
        $response = $this->postJson('/api/v1asignaciones-revision', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('evidencia_id');
    }
    /** @test */
    public function test_requires_revisor_id_field()
    {
        // Arrange
        $data = [
            'fecha_asignacion' => \$this->faker->date(),
            'fecha_limite' => \$this->faker->date(),
            'estado' => \$this->faker->randomElement(['pendiente', 'completada', 'expirada'])
        ];
        unset($data['revisor_id']);

        // Act
        $response = $this->postJson('/api/v1asignaciones-revision', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('revisor_id');
    }
    /** @test */
    public function test_requires_asignado_por_id_field()
    {
        // Arrange
        $data = [
            'fecha_asignacion' => \$this->faker->date(),
            'fecha_limite' => \$this->faker->date(),
            'estado' => \$this->faker->randomElement(['pendiente', 'completada', 'expirada'])
        ];
        unset($data['asignado_por_id']);

        // Act
        $response = $this->postJson('/api/v1asignaciones-revision', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('asignado_por_id');
    }
    /** @test */
    public function test_requires_fecha_asignacion_field()
    {
        // Arrange
        $data = [
            'fecha_asignacion' => \$this->faker->date(),
            'fecha_limite' => \$this->faker->date(),
            'estado' => \$this->faker->randomElement(['pendiente', 'completada', 'expirada'])
        ];
        unset($data['fecha_asignacion']);

        // Act
        $response = $this->postJson('/api/v1asignaciones-revision', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('fecha_asignacion');
    }
    /** @test */
    public function test_requires_fecha_limite_field()
    {
        // Arrange
        $data = [
            'fecha_asignacion' => \$this->faker->date(),
            'fecha_limite' => \$this->faker->date(),
            'estado' => \$this->faker->randomElement(['pendiente', 'completada', 'expirada'])
        ];
        unset($data['fecha_limite']);

        // Act
        $response = $this->postJson('/api/v1asignaciones-revision', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('fecha_limite');
    }
    /** @test */
    public function test_requires_estado_field()
    {
        // Arrange
        $data = [
            'fecha_asignacion' => \$this->faker->date(),
            'fecha_limite' => \$this->faker->date(),
            'estado' => \$this->faker->randomElement(['pendiente', 'completada', 'expirada'])
        ];
        unset($data['estado']);

        // Act
        $response = $this->postJson('/api/v1asignaciones-revision', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('estado');
    }
    /** @test */
    public function test_estado_accepts_valid_values()
    {
        foreach (['pendiente', 'completada', 'expirada'] as $value) {
            $data = [
            'fecha_asignacion' => \$this->faker->date(),
            'fecha_limite' => \$this->faker->date(),
            'estado' => \$this->faker->randomElement(['pendiente', 'completada', 'expirada'])
        ];
            $data['estado'] = $value;

            $response = $this->postJson('/api/v1asignaciones-revision', $data);
            $response->assertCreated();
        }
    }

    /** @test */
    public function test_estado_rejects_invalid_values()
    {
        // Arrange
        $data = [
            'fecha_asignacion' => \$this->faker->date(),
            'fecha_limite' => \$this->faker->date(),
            'estado' => \$this->faker->randomElement(['pendiente', 'completada', 'expirada'])
        ];
        $data['estado'] = 'invalid_value';

        // Act
        $response = $this->postJson('/api/v1asignaciones-revision', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('estado');
    }

    /** @test */
    public function requires_authentication()
    {
        // Arrange
        Sanctum::actingAs(null);

        // Act
        $response = $this->getJson('/api/v1/evidencias/{parent_id}/asignaciones-revision');

        // Assert
        $response->assertUnauthorized();
    }


    /** @test */
    public function cannot_access_asignacionRevision_from_wrong_parent()
    {
        // Arrange
        $otherEvidencia = Evidencia::factory()->create();
        $asignacionRevision = AsignacionRevision::factory()->create([
            'evidencia_id' => $this->evidencia->id
        ]);

        // Act
        $response = $this->getJson("/api/v1/evidencias/{$otherEvidencia->id}/asignacionrevision/{$asignacionRevision->id}");

        // Assert
        $response->assertNotFound();
    }

    /** @test */
    public function asignacionRevision_belongs_to_correct_parent()
    {
        // Arrange
        $asignacionRevision = AsignacionRevision::factory()->create([
            'evidencia_id' => $this->evidencia->id
        ]);

        // Act
        $response = $this->getJson("/api/v1/evidencias/{$this->evidencia->id}/asignacionrevision/{$asignacionRevision->id}");

        // Assert
        $response->assertOk();
        $this->assertEquals($this->evidencia->id, $response->json('data.evidencia_id'));
    }
}
