<?php

namespace Tests\Feature\Api;

use App\Models\FamiliaProfesional;
use App\Models\CicloFormativo;
use App\Models\Matricula;
use App\Models\ModuloFormativo;
use App\Models\User;
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
                         '*' => ['id', 'estudiante_id', 'modulo_formativo_id', 'fecha_matricula', 'estado', 'created_at', 'updated_at']
                     ],
                     'links',
                     'meta'
                 ]);

        $this->assertCount(3, $response->json('data'));
    }

    public function test_can_create_matricula()
    {
        // Arrange
        $data = [
            'fecha_matricula' => $this->faker->date('Y-m-d H:i:s'),
            'estado' => $this->faker->randomElement(['activa', 'suspendida', 'finalizada'])
        ];

        // Act
        $response = $this->postJson("/api/v1/modulos-formativos/{$this->moduloFormativo->id}/matriculas", $data);

        // Assert
        $response->assertCreated()
                 ->assertJsonStructure([
                     'data' => ['id', 'estudiante_id', 'modulo_formativo_id', 'fecha_matricula', 'estado', 'created_at', 'updated_at']
                 ]);

        $this->assertDatabaseHas('matriculas', [
            'fecha_matricula' => $data['fecha_matricula'],
            'estado' => $data['estado']
        ]);
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
                     'data' => ['id', 'estudiante_id', 'modulo_formativo_id', 'fecha_matricula', 'estado', 'created_at', 'updated_at']
                 ]);
    }

    public function test_can_update_matricula()
    {
        // Arrange
        $matricula = Matricula::factory()->create([
            'modulo_formativo_id' => $this->moduloFormativo->id,
        ]);
        $updateData = [
            'fecha_matricula' => $this->faker->date('Y-m-d'),
            'estado' => $this->faker->randomElement(['activa', 'suspendida', 'finalizada'])
        ];

        // Act
        $response = $this->putJson("/api/v1/modulos-formativos/{$this->moduloFormativo->id}/matriculas/{$matricula->id}", $updateData);

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'estudiante_id', 'modulo_formativo_id', 'fecha_matricula', 'estado', 'created_at', 'updated_at']
                 ]);

        $matricula->refresh();
        $this->assertEquals($updateData['fecha_matricula'], $matricula->fecha_matricula->format('Y-m-d'));
        $this->assertEquals($updateData['estado'], $matricula->estado);
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

    public function test_requires_estado_field()
    {
        // Arrange
        $data = [
        'fecha_matricula' => $this->faker->date(),
        'estado' => $this->faker->randomElement(['activa', 'suspendida', 'finalizada'])
    ];
        unset($data['estado']);

        // Act
        $response = $this->postJson("/api/v1/modulos-formativos/{$this->moduloFormativo->id}/matriculas", $data);

        // Assert
        $response->assertUnprocessable()
                    ->assertJsonValidationErrors('estado');
    }
    public function test_estado_accepts_valid_values()
    {
        foreach (['activa', 'suspendida', 'finalizada'] as $value) {
            $data = [
        'fecha_matricula' => $this->faker->date(),
        'estado' => $this->faker->randomElement(['activa', 'suspendida', 'finalizada'])
    ];
            $data['estado'] = $value;

            $response = $this->postJson("/api/v1/modulos-formativos/{$this->moduloFormativo->id}/matriculas", $data);
            $response->assertCreated();
        }
    }

    public function test_estado_rejects_invalid_values()
    {
        // Arrange
        $data = [
        'fecha_matricula' => $this->faker->date(),
        'estado' => $this->faker->randomElement(['activa', 'suspendida', 'finalizada'])
    ];
        $data['estado'] = 'invalid_value';

        // Act
        $response = $this->postJson("/api/v1/modulos-formativos/{$this->moduloFormativo->id}/matriculas", $data);

        // Assert
        $response->assertUnprocessable()
                    ->assertJsonValidationErrors('estado');
    }

    public function test_requires_authentication()
    {
        // Arrange
        Sanctum::actingAs(null);

        // Act
        $response = $this->getJson("/api/v1/modulos-formativos/{$this->moduloFormativo->id}/matriculas");

        // Assert
        $response->assertUnauthorized();
    }

}
