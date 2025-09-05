<?php

namespace App\Models;

use App\Traits\Import\ModuloFormativoImportable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="ModuloFormativo",
 *     type="object",
 *     title="Módulo Formativo",
 *     description="Modelo de Módulo Formativo",
 *     @OA\Property(property="id", type="integer", description="ID único"),
 *     @OA\Property(property="ciclo_formativo_id", type="integer", description="ID del ciclo formativo"),
 *     @OA\Property(property="nombre", type="string", description="Nombre del módulo formativo"),
 *     @OA\Property(property="codigo", type="string", description="Código del módulo formativo"),
 *     @OA\Property(property="horas_totales", type="integer", description="Horas totales del módulo"),
 *     @OA\Property(property="curso_escolar", type="string", description="Curso escolar"),
 *     @OA\Property(property="centro", type="string", description="Centro educativo"),
 *     @OA\Property(property="docente_id", type="integer", description="ID del docente"),
 *     @OA\Property(property="descripcion", type="string", description="Descripción del módulo"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización"),
 * )
 */

class ModuloFormativo extends Model
{
    use HasFactory, ModuloFormativoImportable;

    protected $table = 'modulos_formativos';

    protected $fillable = [
        'ciclo_formativo_id',
        'nombre',
        'codigo',
        'horas_totales',
        'curso_escolar',
        'centro',
        'docente_id',
        'descripcion'
    ];
    public function ciclo_formativo()
    {
        return $this->belongsTo(CicloFormativo::class, 'ciclo_formativo_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function resultados_aprendizaje()
    {
        return $this->hasMany(ResultadoAprendizaje::class, 'modulo_formativo_id');
    }
    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'modulo_formativo_id');
    }
}
