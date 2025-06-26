<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriteriosEvaluacion extends Model
{
    use HasFactory;

    protected $table = 'criterios_evaluacion';

    protected $fillable = [
        'resultado_aprendizaje_id',
        'codigo',
        'descripcion',
        'peso_porcentaje',
        'orden'
    ];
    protected $casts = [
        'peso_porcentaje' => 'decimal:2'
    ];
    public function resultados_aprendizaje()
    {
        return $this->belongsTo(ResultadoAprendizaje::class, 'resultados_aprendizaje_id');
    }
    public function planificacion_criterios()
    {
        return $this->hasMany(PlanificacionCriterios::class, 'criterios_evaluacion_id');
    }
    public function evidencias()
    {
        return $this->hasMany(Evidencia::class, 'criterios_evaluacion_id');
    }
}
