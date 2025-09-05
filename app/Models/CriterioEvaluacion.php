<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="CriterioEvaluacion",
 *     type="object",
 *     title="Criterio de Evaluación",
 *     description="Modelo de Criterio de Evaluación",
 *     @OA\Property(property="id", type="integer", description="ID único"),
 *     @OA\Property(property="resultado_aprendizaje_id", type="integer", description="ID del resultado de aprendizaje"),
 *     @OA\Property(property="codigo", type="string", description="Código del criterio de evaluación"),
 *     @OA\Property(property="descripcion", type="string", description="Descripción del criterio de evaluación"),
 *     @OA\Property(property="peso_porcentaje", type="number", format="float", description="Peso en porcentaje"),
 *     @OA\Property(property="orden", type="integer", description="Orden de presentación"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización"),
 * )
 */

class CriterioEvaluacion extends Model
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
    public function resultado_aprendizaje()
    {
        return $this->belongsTo(ResultadoAprendizaje::class, 'resultado_aprendizaje_id');
    }
    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'criterios_tareas', 'criterio_evaluacion_id', 'tarea_id');
    }
    public function evidencias()
    {
        return $this->hasMany(Evidencia::class, 'criterio_evaluacion_id');
    }
}
