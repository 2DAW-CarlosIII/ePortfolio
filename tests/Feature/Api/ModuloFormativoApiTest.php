<?php

namespace Tests\Feature\Api;

use App\Models\ModuloFormativo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\FeatureTestCase;
use Laravel\Sanctum\Sanctum;

class ModuloFormativoApiTest extends FeatureTestCase
{
    use WithFaker;

    protected User $user;
    

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
        
    }

    public function test_can_list_moduloFormativos()
    {
        // Arrange
        ModuloFormativo::factory()->count(3)->create();

        // Act
        $response = $this->getJson('/api/v1/modulos-formativos');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'ciclo_formativo_id', 'nombre', 'codigo', 'horas_totales', 'curso_escolar', 'centro', 'docente_id', 'descripcion', 'created_at', 'updated_at']
                     ],
                     'links',
                     'meta'
                 ]);
        
        $this->assertCount(3, $response->json('data'));
    }

    public function test_can_create_moduloFormativo()
    {
        // Arrange
        $data = [
            'nombre' => $this->faker->words(3, true),
            'codigo' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'horas_totales' => $this->faker->numberBetween(20, 200),
            'curso_escolar' => $this->faker->words(3, true),
            'centro' => $this->faker->words(3, true),
            'descripcion' => $this->faker->paragraph()
        ];

        // Act
        $response = $this->postJson('/api/v1/modulos-formativos', $data);

        // Assert
        $response->assertCreated()
                 ->assertJsonStructure([
                     'data' => ['id', 'ciclo_formativo_id', 'nombre', 'codigo', 'horas_totales', 'curso_escolar', 'centro', 'docente_id', 'descripcion', 'created_at', 'updated_at']
                 ]);

        $this->assertDatabaseHas('modulos_formativos', [
            'nombre' => $data['nombre'],
            'codigo' => $data['codigo'],
            'horas_totales' => $data['horas_totales'],
            'curso_escolar' => $data['curso_escolar'],
            'centro' => $data['centro'],
            'descripcion' => $data['descripcion']
        ]);
    }

    public function test_can_show_moduloFormativo()
    {
        // Arrange
        $moduloFormativo = ModuloFormativo::factory()->create();

        // Act
        $response = $this->getJson('/api/v1/modulos-formativos/{$moduloFormativo->id}');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'ciclo_formativo_id', 'nombre', 'codigo', 'horas_totales', 'curso_escolar', 'centro', 'docente_id', 'descripcion', 'created_at', 'updated_at']
                 ]);
    }

    public function test_can_update_moduloFormativo()
    {
        // Arrange
        $moduloFormativo = ModuloFormativo::factory()->create();
        $updateData = [
            'nombre' => $this->faker->words(3, true),
            'codigo' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'horas_totales' => $this->faker->numberBetween(20, 200),
            'curso_escolar' => $this->faker->words(3, true),
            'centro' => $this->faker->words(3, true),
            'descripcion' => $this->faker->paragraph()
        ];

        // Act
        $response = $this->putJson('/api/v1/modulos-formativos/{$moduloFormativo->id}', $updateData);

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'ciclo_formativo_id', 'nombre', 'codigo', 'horas_totales', 'curso_escolar', 'centro', 'docente_id', 'descripcion', 'created_at', 'updated_at']
                 ]);

        $moduloFormativo->refresh();
        $this->assertEquals($updateData['nombre'], $moduloFormativo->$field['name']);
        $this->assertEquals($updateData['codigo'], $moduloFormativo->$field['name']);
        $this->assertEquals($updateData['horas_totales'], $moduloFormativo->$field['name']);
        $this->assertEquals($updateData['curso_escolar'], $moduloFormativo->$field['name']);
        $this->assertEquals($updateData['centro'], $moduloFormativo->$field['name']);
        $this->assertEquals($updateData['descripcion'], $moduloFormativo->$field['name']);
    }

    public function test_can_delete_moduloFormativo()
    {
        // Arrange
        $moduloFormativo = ModuloFormativo::factory()->create();

        // Act
        $response = $this->deleteJson('/api/v1/modulos-formativos/{$moduloFormativo->id}');

        // Assert
        $response->assertOk()
                 ->assertJson([
                     'message' => 'ModuloFormativo eliminado correctamente'
                 ]);

        $this->assertSoftDeleted('modulos_formativos', [
            'id' => $moduloFormativo->id
        ]);
    }

    public function test_can_search_moduloFormativos()
    {
        // Arrange
        $searchTerm = 'test search';
        $moduloFormativo1 = ModuloFormativo::factory()->create([
            'nombre' => 'Contains test search term',
            
        ]);
        $moduloFormativo2 = ModuloFormativo::factory()->create([
            'nombre' => 'Different content',
            
        ]);

        // Act
        $response = $this->getJson('/api/v1/modulos-formativos?search=' . urlencode($searchTerm));

        // Assert
        $response->assertOk();
        $data = $response->json('data');
        
        $this->assertCount(1, $data);
        $this->assertEquals($moduloFormativo1->id, $data[0]['id']);
    }

    public function test_can_paginate_moduloFormativos()
    {
        // Arrange
        ModuloFormativo::factory()->count(25)->create();

        // Act
        $response = $this->getJson('/api/v1/modulos-formativos?per_page=10');

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


        public function test_requires_ciclo_formativo_id_field()
        {
            // Arrange
            $data = [
            'nombre' => $this->faker->words(3, true),
            'codigo' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'horas_totales' => $this->faker->numberBetween(20, 200),
            'curso_escolar' => $this->faker->words(3, true),
            'centro' => $this->faker->words(3, true),
            'descripcion' => $this->faker->paragraph()
        ];
            unset($data['ciclo_formativo_id']);

            // Act
            $response = $this->postJson('/api/v1modulos-formativos', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('ciclo_formativo_id');
        }
        public function test_requires_nombre_field()
        {
            // Arrange
            $data = [
            'nombre' => $this->faker->words(3, true),
            'codigo' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'horas_totales' => $this->faker->numberBetween(20, 200),
            'curso_escolar' => $this->faker->words(3, true),
            'centro' => $this->faker->words(3, true),
            'descripcion' => $this->faker->paragraph()
        ];
            unset($data['nombre']);

            // Act
            $response = $this->postJson('/api/v1modulos-formativos', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('nombre');
        }
        public function test_requires_codigo_field()
        {
            // Arrange
            $data = [
            'nombre' => $this->faker->words(3, true),
            'codigo' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'horas_totales' => $this->faker->numberBetween(20, 200),
            'curso_escolar' => $this->faker->words(3, true),
            'centro' => $this->faker->words(3, true),
            'descripcion' => $this->faker->paragraph()
        ];
            unset($data['codigo']);

            // Act
            $response = $this->postJson('/api/v1modulos-formativos', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('codigo');
        }
        public function test_requires_horas_totales_field()
        {
            // Arrange
            $data = [
            'nombre' => $this->faker->words(3, true),
            'codigo' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'horas_totales' => $this->faker->numberBetween(20, 200),
            'curso_escolar' => $this->faker->words(3, true),
            'centro' => $this->faker->words(3, true),
            'descripcion' => $this->faker->paragraph()
        ];
            unset($data['horas_totales']);

            // Act
            $response = $this->postJson('/api/v1modulos-formativos', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('horas_totales');
        }
        public function test_requires_curso_escolar_field()
        {
            // Arrange
            $data = [
            'nombre' => $this->faker->words(3, true),
            'codigo' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'horas_totales' => $this->faker->numberBetween(20, 200),
            'curso_escolar' => $this->faker->words(3, true),
            'centro' => $this->faker->words(3, true),
            'descripcion' => $this->faker->paragraph()
        ];
            unset($data['curso_escolar']);

            // Act
            $response = $this->postJson('/api/v1modulos-formativos', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('curso_escolar');
        }
        public function test_requires_centro_field()
        {
            // Arrange
            $data = [
            'nombre' => $this->faker->words(3, true),
            'codigo' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'horas_totales' => $this->faker->numberBetween(20, 200),
            'curso_escolar' => $this->faker->words(3, true),
            'centro' => $this->faker->words(3, true),
            'descripcion' => $this->faker->paragraph()
        ];
            unset($data['centro']);

            // Act
            $response = $this->postJson('/api/v1modulos-formativos', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('centro');
        }
        public function test_requires_docente_id_field()
        {
            // Arrange
            $data = [
            'nombre' => $this->faker->words(3, true),
            'codigo' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'horas_totales' => $this->faker->numberBetween(20, 200),
            'curso_escolar' => $this->faker->words(3, true),
            'centro' => $this->faker->words(3, true),
            'descripcion' => $this->faker->paragraph()
        ];
            unset($data['docente_id']);

            // Act
            $response = $this->postJson('/api/v1modulos-formativos', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('docente_id');
        }
        public function test_requires_descripcion_field()
        {
            // Arrange
            $data = [
            'nombre' => $this->faker->words(3, true),
            'codigo' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'horas_totales' => $this->faker->numberBetween(20, 200),
            'curso_escolar' => $this->faker->words(3, true),
            'centro' => $this->faker->words(3, true),
            'descripcion' => $this->faker->paragraph()
        ];
            unset($data['descripcion']);

            // Act
            $response = $this->postJson('/api/v1modulos-formativos', $data);

            // Assert
            $response->assertUnprocessable()
                     ->assertJsonValidationErrors('descripcion');
        }

    public function test_requires_authentication()
    {
        // Arrange
        Sanctum::actingAs(null);

        // Act
        $response = $this->getJson('/api/v1/modulos-formativos');

        // Assert
        $response->assertUnauthorized();
    }


}
