<?php

namespace Tests\Feature\Api;

use App\Models\ResultadoAprendizaje;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class ResultadoAprendizajeApiTest extends TestCase
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
    public function can_list_resultadoAprendizajes()
    {
        // Arrange
        ResultadoAprendizaje::factory()->count(3)->create();

        // Act
        $response = $this->getJson('/api/v1/resultados-aprendizaje');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'modulo_formativo_id', 'codigo', 'descripcion', 'peso_porcentaje', 'orden', 'created_at', 'updated_at']
                     ],
                     'links',
                     'meta'
                 ]);
        
        $this->assertCount(3, $response->json('data'));
    }

    /** @test */
    public function can_create_resultadoAprendizaje()
    {
        // Arrange
        $data = [
            'codigo' => \$this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'descripcion' => \$this->faker->paragraph(),
            'peso_porcentaje' => \$this->faker->randomFloat(2, 0, 100),
            'orden' => \$this->faker->numberBetween(1, 100)
        ];

        // Act
        $response = $this->postJson('/api/v1/resultados-aprendizaje', $data);

        // Assert
        $response->assertCreated()
                 ->assertJsonStructure([
                     'data' => ['id', 'modulo_formativo_id', 'codigo', 'descripcion', 'peso_porcentaje', 'orden', 'created_at', 'updated_at']
                 ]);

        $this->assertDatabaseHas('resultados_aprendizaje', [
            'codigo' => $data['codigo'],
            'descripcion' => $data['descripcion'],
            'peso_porcentaje' => $data['peso_porcentaje'],
            'orden' => $data['orden']
        ]);
    }

    /** @test */
    public function can_show_resultadoAprendizaje()
    {
        // Arrange
        $resultadoAprendizaje = ResultadoAprendizaje::factory()->create();

        // Act
        $response = $this->getJson('/api/v1/resultados-aprendizaje/{$resultadoAprendizaje->id}');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'modulo_formativo_id', 'codigo', 'descripcion', 'peso_porcentaje', 'orden', 'created_at', 'updated_at']
                 ]);
    }

    /** @test */
    public function can_update_resultadoAprendizaje()
    {
        // Arrange
        $resultadoAprendizaje = ResultadoAprendizaje::factory()->create();
        $updateData = [
            'codigo' => \$this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'descripcion' => \$this->faker->paragraph(),
            'peso_porcentaje' => \$this->faker->randomFloat(2, 0, 100),
            'orden' => \$this->faker->numberBetween(1, 100)
        ];

        // Act
        $response = $this->putJson('/api/v1/resultados-aprendizaje/{$resultadoAprendizaje->id}', $updateData);

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'modulo_formativo_id', 'codigo', 'descripcion', 'peso_porcentaje', 'orden', 'created_at', 'updated_at']
                 ]);

        $resultadoAprendizaje->refresh();
        $this->assertEquals($updateData['codigo'], $resultadoAprendizaje->$field['name']));
        $this->assertEquals($updateData['descripcion'], $resultadoAprendizaje->$field['name']));
        $this->assertEquals($updateData['peso_porcentaje'], $resultadoAprendizaje->$field['name']));
        $this->assertEquals($updateData['orden'], $resultadoAprendizaje->$field['name']));
    }

    /** @test */
    public function can_delete_resultadoAprendizaje()
    {
        // Arrange
        $resultadoAprendizaje = ResultadoAprendizaje::factory()->create();

        // Act
        $response = $this->deleteJson('/api/v1/resultados-aprendizaje/{$resultadoAprendizaje->id}');

        // Assert
        $response->assertOk()
                 ->assertJson([
                     'message' => 'ResultadoAprendizaje eliminado correctamente'
                 ]);

        $this->assertSoftDeleted('resultados_aprendizaje', [
            'id' => $resultadoAprendizaje->id
        ]);
    }

    /** @test */
    public function can_search_resultadoAprendizajes()
    {
        // Arrange
        $searchTerm = 'test search';
        $resultadoAprendizaje1 = ResultadoAprendizaje::factory()->create([
            'nombre' => 'Contains test search term',
            
        ]);
        $resultadoAprendizaje2 = ResultadoAprendizaje::factory()->create([
            'nombre' => 'Different content',
            
        ]);

        // Act
        $response = $this->getJson('/api/v1/resultados-aprendizaje?search=' . urlencode($searchTerm));

        // Assert
        $response->assertOk();
        $data = $response->json('data');
        
        $this->assertCount(1, $data);
        $this->assertEquals($resultadoAprendizaje1->id, $data[0]['id']);
    }

    /** @test */
    public function can_paginate_resultadoAprendizajes()
    {
        // Arrange
        ResultadoAprendizaje::factory()->count(25)->create();

        // Act
        $response = $this->getJson('/api/v1/resultados-aprendizaje?per_page=10');

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
    public function test_requires_modulo_formativo_id_field()
    {
        // Arrange
        $data = [
            'codigo' => \$this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'descripcion' => \$this->faker->paragraph(),
            'peso_porcentaje' => \$this->faker->randomFloat(2, 0, 100),
            'orden' => \$this->faker->numberBetween(1, 100)
        ];
        unset($data['modulo_formativo_id']);

        // Act
        $response = $this->postJson('/api/v1resultados-aprendizaje', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('modulo_formativo_id');
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
        $response = $this->postJson('/api/v1resultados-aprendizaje', $data);

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
        $response = $this->postJson('/api/v1resultados-aprendizaje', $data);

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
        $response = $this->postJson('/api/v1resultados-aprendizaje', $data);

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
        $response = $this->postJson('/api/v1resultados-aprendizaje', $data);

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
        $response = $this->getJson('/api/v1/resultados-aprendizaje');

        // Assert
        $response->assertUnauthorized();
    }


}
