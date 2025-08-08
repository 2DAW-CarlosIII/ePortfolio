<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="EvaluacionEvidencia",
 *     type="object",
 *     title="Evaluación de Evidencia",
 *     description="Modelo de Evaluación de Evidencia",
 *     @OA\Property(property="id", type="integer", description="ID único"),
 *     @OA\Property(property="evidencia_id", type="integer", description="ID de la evidencia"),
 *     @OA\Property(property="user_id", type="integer", description="ID del evaluador"),
 *     @OA\Property(property="puntuacion", type="number", format="float", description="Puntuación otorgada"),
 *     @OA\Property(property="estado", type="string", enum={"pendiente", "completada", "revisada"}, description="Estado de la evaluación"),
 *     @OA\Property(property="observaciones", type="string", description="Observaciones de la evaluación"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización"),
 * )
 */

class EvaluacionEvidencia extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones_evidencias';

    protected $fillable = [
        'evidencia_id',
        'user_id',
        'puntuacion',
        'estado',
        'observaciones'
    ];
    protected $casts = [
        'puntuacion' => 'decimal:2'
    ];
    public function evidencia()
    {
        return $this->belongsTo(Evidencia::class, 'evidencia_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
