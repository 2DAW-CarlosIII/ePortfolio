<?php

namespace Tests\Unit\Models;

use App\Models\EvaluacionPar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EvaluacionParTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_fillable_attributes()
    {
        $fillable = (new EvaluacionPar())->getFillable();
        
        $expected = [
            'asignacion_revision_id',
            'revisor_id',
            'puntuacion_sugerida',
            'recomendacion',
            'justificacion',
            'fecha_evaluacion'
        ];
        
        $this->assertEquals($expected, $fillable);
    }

    public function test_it_has_correct_table_name()
    {
        $model = new EvaluacionPar();
        $this->assertEquals('evaluaciones_pares', $model->getTable());
    }

    public function test_it_can_be_created_with_factory()
    {
        $evaluacionPar = EvaluacionPar::factory()->create();
        
        $this->assertInstanceOf(EvaluacionPar::class, $evaluacionPar);
        $this->assertDatabaseHas('evaluaciones_pares', [
            'id' => $evaluacionPar->id
        ]);
    }


    public function test_it_uses_expected_factory()
    {
        $evaluacionPar = EvaluacionPar::factory()->make();
        $this->assertInstanceOf(EvaluacionPar::class, $evaluacionPar);
    }


}
