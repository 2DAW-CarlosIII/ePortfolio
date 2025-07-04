<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Matricula",
 *     type="object",
 *     title="Matrícula",
 *     description="Modelo de Matrícula",
 *     @OA\Property(property="id", type="integer", description="ID único"),
 *     @OA\Property(property="estudiante_id", type="integer", description="ID del estudiante"),
 *     @OA\Property(property="modulo_formativo_id", type="integer", description="ID del módulo formativo"),
 *     @OA\Property(property="fecha_matricula", type="string", format="date", description="Fecha de matrícula"),
 *     @OA\Property(property="estado", type="string", enum={"activa", "inactiva", "finalizada"}, description="Estado de la matrícula"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización"),
 * )
 */

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matriculas';

    protected $fillable = [
        'estudiante_id',
        'modulo_formativo_id',
        'fecha_matricula',
        'estado'
    ];
    protected $casts = [
        'fecha_matricula' => 'date'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function modulos_formativo()
    {
        return $this->belongsTo(ModuloFormativo::class, 'modulos_formativo_id');
    }
}
