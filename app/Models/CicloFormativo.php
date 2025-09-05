<?php

namespace App\Models;

use App\Traits\Import\CicloFormativoImportable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="CicloFormativo",
 *     type="object",
 *     title="Ciclo Formativo",
 *     description="Modelo de Ciclo Formativo",
 *     @OA\Property(property="id", type="integer", description="ID único"),
 *     @OA\Property(property="familia_profesional_id", type="integer", description="ID de la familia profesional"),
 *     @OA\Property(property="nombre", type="string", description="Nombre del ciclo formativo"),
 *     @OA\Property(property="codigo", type="string", description="Código único del ciclo formativo"),
 *     @OA\Property(property="grado", type="string", enum={"medio", "superior"}, description="Grado del ciclo formativo"),
 *     @OA\Property(property="descripcion", type="string", description="Descripción del ciclo formativo"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización"),
 * )
 */

class CicloFormativo extends Model
{
    use HasFactory, CicloFormativoImportable;

    protected $table = 'ciclos_formativos';

    protected $fillable = [
        'familia_profesional_id',
        'nombre',
        'codigo',
        'grado',
        'descripcion'
    ];
    public function familia_profesional()
    {
        return $this->belongsTo(FamiliaProfesional::class, 'familia_profesional_id');
    }
    public function modulos_formativos()
    {
        return $this->hasMany(ModuloFormativo::class, 'ciclo_formativo_id');
    }
}
