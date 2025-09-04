<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Evidencia",
 *     type="object",
 *     title="Evidencia",
 *     description="Modelo de Evidencia",
 *     @OA\Property(property="id", type="integer", description="ID único"),
 *     @OA\Property(property="estudiante_id", type="integer", description="ID del estudiante"),
 *     @OA\Property(property="criterio_evaluacion_id", type="integer", description="ID del criterio de evaluación"),
 *     @OA\Property(property="url", type="string", description="URL de la evidencia"),
 *     @OA\Property(property="descripcion", type="string", description="Descripción de la evidencia"),
 *     @OA\Property(property="estado_validacion", type="string", enum={"pendiente", "validada", "rechazada"}, description="Estado de validación"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización"),
 * )
 */

class Evidencia extends Model
{
    use HasFactory;

    protected $table = 'evidencias';

    protected $fillable = [
        'estudiante_id',
        'tarea_id',
        'url',
        'descripcion',
        'estado_validacion'
    ];
    protected $casts = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'tarea_id');
    }
    public function evaluaciones()
    {
        return $this->hasMany(EvaluacionEvidencia::class, 'evidencia_id');
    }
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'evidencia_id');
    }
    public function asignacionRevision()
    {
        return $this->hasMany(AsignacionRevision::class, 'evidencia_id');
    }
}
