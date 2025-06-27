<?php

namespace Tests\Unit\Models;

use App\Models\ComentarioPar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ComentarioParTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_fillable_attributes()
    {
        $fillable = (new ComentarioPar())->getFillable();
        
        $expected = [
            'asignacion_revision_id',
            'revisor_id',
            'contenido',
            'tipo_comentario'
        ];
        
        $this->assertEquals($expected, $fillable);
    }

    public function test_it_has_correct_table_name()
    {
        $model = new ComentarioPar();
        $this->assertEquals('comentarios_pares', $model->getTable());
    }

    public function test_it_can_be_created_with_factory()
    {
        $comentarioPar = ComentarioPar::factory()->create();
        
        $this->assertInstanceOf(ComentarioPar::class, $comentarioPar);
        $this->assertDatabaseHas('comentarios_pares', [
            'id' => $comentarioPar->id
        ]);
    }


    public function test_it_uses_expected_factory()
    {
        $comentarioPar = ComentarioPar::factory()->make();
        $this->assertInstanceOf(ComentarioPar::class, $comentarioPar);
    }


}
