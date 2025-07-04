<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="FamiliaProfesional",
 *     type="object",
 *     title="Familia Profesional",
 *     description="Modelo de Familia Profesional",
 *     @OA\Property(property="id", type="integer", description="ID único"),
 *     @OA\Property(property="nombre", type="string", description="Nombre de la familia profesional"),
 *     @OA\Property(property="codigo", type="string", description="Código único de la familia profesional"),
 *     @OA\Property(property="descripcion", type="string", description="Descripción de la familia profesional"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización"),
 * )
 */

class FamiliaProfesional extends Model
{
    use HasFactory;

    protected $table = 'familias_profesionales';

    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion'
    ];
    public function ciclos_formativos()
    {
        return $this->hasMany(CicloFormativo::class, 'familia_profesional_id');
    }
}
