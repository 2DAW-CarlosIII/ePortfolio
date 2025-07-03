<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanificacionCriterios extends Model
{
    use HasFactory;

    protected $table = 'planificacion_criterios';

    protected $fillable = [
        'criterio_evaluacion_id',
        'fecha_apertura',
        'fecha_cierre',
        'activo',
        'observaciones'
    ];
    protected $casts = [
        'fecha_apertura' => 'date',
        'fecha_cierre' => 'date',
        'activo' => 'boolean'
    ];
    public function criterios_evaluacion()
    {
        return $this->belongsTo(CriteriosEvaluacion::class, 'criterios_evaluacion_id');
    }
}
