<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Comentario",
 *     type="object",
 *     title="Comentario",
 *     description="Modelo de Comentario",
 *     @OA\Property(property="id", type="integer", description="ID único"),
 *     @OA\Property(property="evidencia_id", type="integer", description="ID de la evidencia"),
 *     @OA\Property(property="user_id", type="integer", description="ID del usuario que comenta"),
 *     @OA\Property(property="contenido", type="string", description="Contenido del comentario"),
 *     @OA\Property(property="tipo", type="string", enum={"feedback", "pregunta", "sugerencia"}, description="Tipo de comentario"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización"),
 * )
 */

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentarios';

    protected $fillable = [
        'evidencia_id',
        'user_id',
        'contenido',
        'tipo'
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
