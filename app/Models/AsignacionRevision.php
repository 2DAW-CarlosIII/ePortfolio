<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="AsignacionRevision",
 *     type="object",
 *     title="Asignación de Revisión",
 *     description="Modelo de Asignación de Revisión",
 *     @OA\Property(property="id", type="integer", description="ID único"),
 *     @OA\Property(property="evidencia_id", type="integer", description="ID de la evidencia"),
 *     @OA\Property(property="revisor_id", type="integer", description="ID del revisor"),
 *     @OA\Property(property="asignado_por_id", type="integer", description="ID del usuario que asigna"),
 *     @OA\Property(property="fecha_limite", type="string", format="date", description="Fecha límite"),
 *     @OA\Property(property="estado", type="string", enum={"pendiente", "expirada", "completada"}, description="Estado de la revisión"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización"),
 *     @OA\Property(property="evidencia", ref="#/components/schemas/Evidencia"),
 *     @OA\Property(property="revisor", ref="#/components/schemas/User"),
 * )
 */

class AsignacionRevision extends Model
{
    use HasFactory;

    protected $table = 'asignaciones_revision';

    protected $fillable = [
        'evidencia_id',
        'revisor_id',
        'asignado_por_id',
        'fecha_limite',
        'estado'
    ];
    protected $casts = [
        'fecha_limite' => 'date'
    ];
    public function evidencia()
    {
        return $this->belongsTo(Evidencia::class, 'evidencia_id');
    }
    public function revisor()
    {
        return $this->belongsTo(User::class, 'revisor_id');
    }
    public function asignador()
    {
        return $this->belongsTo(User::class, 'asignador_id');
    }
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'asignaciones_revision_id');
    }
}
