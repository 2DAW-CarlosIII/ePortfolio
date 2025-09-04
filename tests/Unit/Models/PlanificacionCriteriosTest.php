<?php

namespace Tests\Unit\Models;

use App\Models\Tareas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TareasTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_fillable_attributes()
    {
        $fillable = (new Tareas())->getFillable();

        $expected = [
            'criterio_evaluacion_id',
            'fecha_apertura',
            'fecha_cierre',
            'activo',
            'observaciones'
        ];

        $this->assertEquals($expected, $fillable);
    }

    public function test_it_has_correct_table_name()
    {
        $model = new Tareas();
        $this->assertEquals('tareas', $model->getTable());
    }

    public function test_it_can_be_created_with_factory()
    {
        $tarea = Tareas::factory()->create();

        $this->assertInstanceOf(Tareas::class, $tarea);
        $this->assertDatabaseHas('tareas', [
            'id' => $tarea->id
        ]);
    }


    public function test_it_uses_expected_factory()
    {
        $tarea = Tareas::factory()->make();
        $this->assertInstanceOf(Tareas::class, $tarea);
    }


}
