<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Tarea",
 *     type="object",
 *     title="Tarea",
 *     description="Modelo de Tarea",
 *     @OA\Property(property="id", type="integer", description="ID único"),
 *     @OA\Property(property="criterios_evaluacion_id", type="array", @OA\Items(type="integer"), description="ID de los criterios_evaluacion"),
 *     @OA\Property(property="fecha_apertura", type="string", format="date", description="Fecha de apertura"),
 *     @OA\Property(property="fecha_cierre", type="string", format="date", description="Fecha de cierre"),
 *     @OA\Property(property="activo", type="boolean", description="Estado activo"),
 *     @OA\Property(property="observaciones", type="string", description="Observaciones"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización"),
 * )
 */

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tareas';

    protected $fillable = [
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
        return $this->belongsToMany(CriterioEvaluacion::class, 'criterios_tareas', 'tarea_id', 'criterio_evaluacion_id');
    }

    public function evidencias()
    {
        return $this->hasMany(Evidencia::class, 'tarea_id');
    }
}
