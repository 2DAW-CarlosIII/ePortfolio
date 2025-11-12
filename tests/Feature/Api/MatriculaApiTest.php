<?php

namespace Tests\Feature\Api;

use App\Models\FamiliaProfesional;
use App\Models\CicloFormativo;
use App\Models\Matricula;
use App\Models\ModuloFormativo;
use App\Models\User;
use GuzzleHttp\Promise\Each;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\FeatureTestCase;
use Laravel\Sanctum\Sanctum;
use PhpParser\Node\Expr\AssignOp\Mod;

class MatriculaApiTest extends FeatureTestCase
{
    use WithFaker;

    protected User $user;
    protected FamiliaProfesional $familiaProfesional; // Assuming you have a FamiliaProfesional model
    protected CicloFormativo $cicloFormativo; // Assuming you have a CicloFormativo model
    protected ModuloFormativo $moduloFormativo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);

        // Create a FamiliaProfesional and CicloFormativo for the test
        $this->familiaProfesional = FamiliaProfesional::factory()->create();
        $this->cicloFormativo = CicloFormativo::factory()->create([
            'familia_profesional_id' => $this->familiaProfesional->id,
        ]);

        $this->moduloFormativo = ModuloFormativo::factory()->create([
            'ciclo_formativo_id' => $this->cicloFormativo->id, // Assuming a valid ciclo_formativo_id exists
            'docente_id' => $this->user->id // Assuming the user is a docente
        ]);

    }

    public function test_can_list_matriculas()
    {
        // Arrange
        Matricula::factory()->count(3)->create([
            'modulo_formativo_id' => $this->moduloFormativo->id,
        ]);

        // Act
        $response = $this->getJson("/api/v1/modulos-formativos/{$this->moduloFormativo->id}/matriculas");

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'estudiante', 'modulo_formativo', 'created_at', 'updated_at']
                     ],
                     'links',
                     'meta'
                 ]);

        $this->assertCount(3, $response->json('data'));
    }

    public function test_can_list_modulos_matriculados()
    {
        // Arrange
        $user = $this->user;

        // Crear dos módulos y matricular al usuario autenticado en ambos
        $modulo1 = ModuloFormativo::factory()->create(['ciclo_formativo_id' => $this->cicloFormativo->id]);
        $modulo2 = ModuloFormativo::factory()->create(['ciclo_formativo_id' => $this->cicloFormativo->id]);
        Matricula::factory()->create([
            'modulo_formativo_id' => $modulo1->id,
            'estudiante_id' => $user->id,
        ]);
        Matricula::factory()->create([
            'modulo_formativo_id' => $modulo2->id,
            'estudiante_id' => $user->id,
        ]);

        // Crear un módulo y matricular a otro usuario
        $otherUser = User::factory()->create();
        $modulo3 = ModuloFormativo::factory()->create(['ciclo_formativo_id' => $this->cicloFormativo->id]);
        Matricula::factory()->create([
            'modulo_formativo_id' => $modulo3->id,
            'estudiante_id' => $otherUser->id,
        ]);

        // Act
        $response = $this->getJson('/api/v1/modulos-matriculados');

        // Assert
        $response->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJsonFragment(['id' => $modulo1->id])
            ->assertJsonFragment(['id' => $modulo2->id])
            ->assertJsonMissing(['id' => $modulo3->id]);
    }

    public function test_can_create_matricula()
    {
        // Arrange
        $data = [];

        // Act
        $response = $this->postJson("/api/v1/modulos-formativos/{$this->moduloFormativo->id}/matriculas", $data);

        // Assert
        $response->assertCreated()
                 ->assertJsonStructure([
                     'data' => ['id', 'estudiante', 'modulo_formativo', 'created_at', 'updated_at']
                 ]);
    }

    public function test_batchStore_admin_and_docentes_behaviour()
    {
        // Arrange
        $students = User::factory()->count(3)->create();

        $teacher1 = User::factory()->create();
        $teacher2 = User::factory()->create();

        // Crear dos módulos, cada uno impartido por uno de los docentes
        $mod1 = ModuloFormativo::factory()->create([
            'ciclo_formativo_id' => $this->cicloFormativo->id,
            'docente_id' => $teacher1->id,
        ]);
        $mod2 = ModuloFormativo::factory()->create([
            'ciclo_formativo_id' => $this->cicloFormativo->id,
            'docente_id' => $teacher2->id,
        ]);

        $modulos = [$mod1, $mod2];

        $payload = [
            'estudiantes_id' => $students->pluck('id')->toArray(),
            'modulos_formativos_id' => array_map(fn($m) => $m->id, $modulos),
        ];

        $admin = User::factory()->create(
            ['email' => config('app.admin.email')]
        );

        Sanctum::actingAs($admin);
        $response = $this->postJson('/api/v1/matriculas', $payload);
        $response->assertOk();
        $this->assertCount(count($students) * count($modulos), $response->json('data'));
        $this->assertDatabaseCount('matriculas', count($students) * count($modulos));

        // 2) Petición con el primer docente: como las combinaciones ya existen, no se deben crear nuevas
        Sanctum::actingAs($teacher1);
        $response2 = $this->postJson('/api/v1/matriculas', $payload);
        $response2->assertOk();
        // Esperamos que no se creen nuevas matrículas
        // No se crean nuevas matrículas, pero la respuesta debe incluir las ya existentes
        $this->assertCount(3, $response2->json('data'));
        $this->assertDatabaseCount('matriculas', count($students) * count($modulos));

        // 3) Eliminar las matrículas y volver a lanzar petición con el primer docente
        Matricula::query()->delete();
        $this->assertDatabaseCount('matriculas', 0);

        Sanctum::actingAs($teacher1);
        $response3 = $this->postJson('/api/v1/matriculas', $payload);
        $response3->assertOk();
        // Debe crear sólo las matrículas correspondientes al módulo en el que es docente (3)
        $this->assertCount(count($students), $response3->json('data'));
        $this->assertDatabaseCount('matriculas', count($students));
        // Comprobar que las matrículas existentes pertenecen al módulo del teacher1
        $this->assertDatabaseHas('matriculas', [
            'modulo_formativo_id' => $mod1->id,
            'estudiante_id' => $students->first()->id,
        ]);

        // 4) Petición con el segundo docente: debe crear las matrículas para su módulo (3)
        Sanctum::actingAs($teacher2);
        $response4 = $this->postJson('/api/v1/matriculas', $payload);
        $response4->assertOk();
        $this->assertCount(3, $response4->json('data'));
        $this->assertDatabaseCount('matriculas', count($students) * count($modulos));

    }

    public function test_can_show_matricula()
    {
        // Arrange
        $matricula = Matricula::factory()->create([
            'modulo_formativo_id' => $this->moduloFormativo->id,
        ]);

        // Act
        $response = $this->getJson("/api/v1/modulos-formativos/{$this->moduloFormativo->id}/matriculas/{$matricula->id}");

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'estudiante', 'modulo_formativo', 'created_at', 'updated_at']
                 ]);
    }

    public function test_can_delete_matricula()
    {
        // Arrange
        $matricula = Matricula::factory()->create([
            'modulo_formativo_id' => $this->moduloFormativo->id,
        ]);

        // Act
        $response = $this->deleteJson("/api/v1/modulos-formativos/{$this->moduloFormativo->id}/matriculas/{$matricula->id}");

        // Assert
        $response->assertOk()
                 ->assertJson([
                     'message' => 'Matricula eliminado correctamente'
                 ]);
    }

    public function test_can_paginate_matriculas()
    {
        // Arrange
        Matricula::factory()->count(25)->create([
            'modulo_formativo_id' => $this->moduloFormativo->id,
        ]);

        // Act
        $response = $this->getJson("/api/v1/modulos-formativos/{$this->moduloFormativo->id}/matriculas?per_page=10");

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
}
