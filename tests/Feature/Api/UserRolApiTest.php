<?php

namespace Tests\Feature\Api;

use App\Models\UserRol;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class UserRolApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected User $user;
    protected Rol $parent;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
        
        $this->rol = Rol::factory()->create();
    }

    /** @test */
    public function can_list_userRols()
    {
        // Arrange
        UserRol::factory()->count(3)->create(['role_id' => $this->rol->id]);

        // Act
        $response = $this->getJson('/api/v1/roles/{parent_id}/user-roles');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'user_id', 'role_id', 'modulo_formativo_id', 'created_at', 'updated_at']
                     ],
                     'links',
                     'meta'
                 ]);
        
        $this->assertCount(3, $response->json('data'));
    }

    /** @test */
    public function can_create_userRol()
    {
        // Arrange
        $data = [
            
        ];

        // Act
        $response = $this->postJson('/api/v1/roles/{parent_id}/user-roles', $data);

        // Assert
        $response->assertCreated()
                 ->assertJsonStructure([
                     'data' => ['id', 'user_id', 'role_id', 'modulo_formativo_id', 'created_at', 'updated_at']
                 ]);

        $this->assertDatabaseHas('user_roles', [
            
        ]);
    }

    /** @test */
    public function can_show_userRol()
    {
        // Arrange
        $userRol = UserRol::factory()->create(['role_id' => $this->rol->id]);

        // Act
        $response = $this->getJson('/api/v1/roles/{parent_id}/user-roles/{$userRol->id}');

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'user_id', 'role_id', 'modulo_formativo_id', 'created_at', 'updated_at']
                 ]);
    }

    /** @test */
    public function can_update_userRol()
    {
        // Arrange
        $userRol = UserRol::factory()->create(['role_id' => $this->rol->id]);
        $updateData = [
            
        ];

        // Act
        $response = $this->putJson('/api/v1/roles/{parent_id}/user-roles/{$userRol->id}', $updateData);

        // Assert
        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => ['id', 'user_id', 'role_id', 'modulo_formativo_id', 'created_at', 'updated_at']
                 ]);

        $userRol->refresh();
        
    }

    /** @test */
    public function can_delete_userRol()
    {
        // Arrange
        $userRol = UserRol::factory()->create(['role_id' => $this->rol->id]);

        // Act
        $response = $this->deleteJson('/api/v1/roles/{parent_id}/user-roles/{$userRol->id}');

        // Assert
        $response->assertOk()
                 ->assertJson([
                     'message' => 'UserRol eliminado correctamente'
                 ]);

        $this->assertSoftDeleted('user_roles', [
            'id' => $userRol->id
        ]);
    }

    /** @test */
    public function can_search_userRols()
    {
        // Arrange
        $searchTerm = 'test search';
        $userRol1 = UserRol::factory()->create([
            'nombre' => 'Contains test search term',
            'role_id' => $this->rol->id
        ]);
        $userRol2 = UserRol::factory()->create([
            'nombre' => 'Different content',
            'role_id' => $this->rol->id
        ]);

        // Act
        $response = $this->getJson('/api/v1/roles/{parent_id}/user-roles?search=' . urlencode($searchTerm));

        // Assert
        $response->assertOk();
        $data = $response->json('data');
        
        $this->assertCount(1, $data);
        $this->assertEquals($userRol1->id, $data[0]['id']);
    }

    /** @test */
    public function can_paginate_userRols()
    {
        // Arrange
        UserRol::factory()->count(25)->create(['role_id' => $this->rol->id]);

        // Act
        $response = $this->getJson('/api/v1/roles/{parent_id}/user-roles?per_page=10');

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
    public function test_requires_user_id_field()
    {
        // Arrange
        $data = [
            
        ];
        unset($data['user_id']);

        // Act
        $response = $this->postJson('/api/v1user-roles', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('user_id');
    }
    /** @test */
    public function test_requires_role_id_field()
    {
        // Arrange
        $data = [
            
        ];
        unset($data['role_id']);

        // Act
        $response = $this->postJson('/api/v1user-roles', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('role_id');
    }
    /** @test */
    public function test_requires_modulo_formativo_id_field()
    {
        // Arrange
        $data = [
            
        ];
        unset($data['modulo_formativo_id']);

        // Act
        $response = $this->postJson('/api/v1user-roles', $data);

        // Assert
        $response->assertUnprocessable()
                 ->assertJsonValidationErrors('modulo_formativo_id');
    }

    /** @test */
    public function requires_authentication()
    {
        // Arrange
        Sanctum::actingAs(null);

        // Act
        $response = $this->getJson('/api/v1/roles/{parent_id}/user-roles');

        // Assert
        $response->assertUnauthorized();
    }


    /** @test */
    public function cannot_access_userRol_from_wrong_parent()
    {
        // Arrange
        $otherRol = Rol::factory()->create();
        $userRol = UserRol::factory()->create([
            'role_id' => $this->rol->id
        ]);

        // Act
        $response = $this->getJson("/api/v1/roles/{$otherRol->id}/userrol/{$userRol->id}");

        // Assert
        $response->assertNotFound();
    }

    /** @test */
    public function userRol_belongs_to_correct_parent()
    {
        // Arrange
        $userRol = UserRol::factory()->create([
            'role_id' => $this->rol->id
        ]);

        // Act
        $response = $this->getJson("/api/v1/roles/{$this->rol->id}/userrol/{$userRol->id}");

        // Assert
        $response->assertOk();
        $this->assertEquals($this->rol->id, $response->json('data.role_id'));
    }
}
