<?php

namespace Tests\Feature\Stats;

use App\Models\User;
use App\Models\Evidencia;
use App\Models\ModuloFormativo;
use App\Models\Matricula;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class StatsApiTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
    }

    /** @test */
    public function can_get_general_stats()
    {
        // Arrange
        User::factory()->count(10)->create();
        ModuloFormativo::factory()->count(5)->create();
        Evidencia::factory()->count(20)->create();

        // Act
        $response = $this->getJson('/api/v1/stats');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'usuarios' => ['total', 'estudiantes', 'docentes'],
                     'modulos' => ['total', 'activos'],
                     'matriculas' => ['total', 'activas'],
                     'evidencias' => ['total', 'validadas', 'pendientes']
                 ]);
    }

    /** @test */
    public function can_get_students_stats()
    {
        // Act
        $response = $this->getJson('/api/v1/stats/estudiantes');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'total_estudiantes',
                     'con_evidencias',
                     'por_modulo'
                 ]);
    }

    /** @test */
    public function can_get_evidences_stats()
    {
        // Act
        $response = $this->getJson('/api/v1/stats/evidencias');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'total',
                     'por_estado',
                     'por_mes'
                 ]);
    }

    /** @test */
    public function can_filter_students_stats_by_module()
    {
        // Arrange
        $modulo = ModuloFormativo::factory()->create();

        // Act
        $response = $this->getJson("/api/v1/stats/estudiantes?modulo_id={$modulo->id}");

        // Assert
        $response->assertOk();
    }

    /** @test */
    public function can_filter_evidences_stats_by_criteria()
    {
        // Arrange
        $criterio = CriterioEvaluacion::factory()->create();

        // Act
        $response = $this->getJson("/api/v1/stats/evidencias?criterio_id={$criterio->id}");

        // Assert
        $response->assertOk();
    }

    /** @test */
    public function requires_authentication_for_stats()
    {
        // Arrange
        Sanctum::actingAs(null);

        // Act
        $response = $this->getJson('/api/v1/stats');

        // Assert
        $response->assertUnauthorized();
    }
}
