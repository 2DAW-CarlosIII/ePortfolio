<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="PlanificacionCriterio",
 *     type="object",
 *     title="Planificación de Criterio",
 *     description="Modelo de Planificación de Criterio",
 *     @OA\Property(property="id", type="integer", description="ID único"),
 *     @OA\Property(property="criterio_evaluacion_id", type="integer", description="ID del criterio de evaluación"),
 *     @OA\Property(property="modulo_formativo_id", type="integer", description="ID del módulo formativo"),
 *     @OA\Property(property="fecha_apertura", type="string", format="date", description="Fecha de apertura"),
 *     @OA\Property(property="fecha_cierre", type="string", format="date", description="Fecha de cierre"),
 *     @OA\Property(property="activo", type="boolean", description="Estado activo"),
 *     @OA\Property(property="observaciones", type="string", description="Observaciones"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización"),
 * )
 */

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
