<?php

namespace Tests\Unit\Models;

use App\Models\PlanificacionCriterios;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlanificacionCriteriosTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_fillable_attributes()
    {
        $fillable = (new PlanificacionCriterios())->getFillable();

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
        $model = new PlanificacionCriterios();
        $this->assertEquals('planificacion_criterios', $model->getTable());
    }

    public function test_it_can_be_created_with_factory()
    {
        $planificacionCriterios = PlanificacionCriterios::factory()->create();

        $this->assertInstanceOf(PlanificacionCriterios::class, $planificacionCriterios);
        $this->assertDatabaseHas('planificacion_criterios', [
            'id' => $planificacionCriterios->id
        ]);
    }


    public function test_it_uses_expected_factory()
    {
        $planificacionCriterios = PlanificacionCriterios::factory()->make();
        $this->assertInstanceOf(PlanificacionCriterios::class, $planificacionCriterios);
    }


}
