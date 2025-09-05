<?php

namespace App\Models;

use App\Traits\Import\ResultadoAprendizajeImportable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="ResultadoAprendizaje",
 *     type="object",
 *     title="Resultado de Aprendizaje",
 *     description="Modelo de Resultado de Aprendizaje",
 *     @OA\Property(property="id", type="integer", description="ID único"),
 *     @OA\Property(property="modulo_formativo_id", type="integer", description="ID del módulo formativo"),
 *     @OA\Property(property="codigo", type="string", description="Código del resultado de aprendizaje"),
 *     @OA\Property(property="descripcion", type="string", description="Descripción del resultado de aprendizaje"),
 *     @OA\Property(property="peso_porcentaje", type="number", format="float", description="Peso en porcentaje"),
 *     @OA\Property(property="orden", type="integer", description="Orden de presentación"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización"),
 * )
 */

class ResultadoAprendizaje extends Model
{
    use HasFactory, ResultadoAprendizajeImportable;

    protected $table = 'resultados_aprendizaje';

    protected $fillable = [
        'modulo_formativo_id',
        'codigo',
        'descripcion',
        'peso_porcentaje',
        'orden'
    ];
    protected $casts = [
        'peso_porcentaje' => 'decimal:2'
    ];
    public function modulo_formativo()
    {
        return $this->belongsTo(ModuloFormativo::class, 'modulo_formativo_id');
    }
    public function criterios_evaluacion()
    {
        return $this->hasMany(CriterioEvaluacion::class, 'resultado_aprendizaje_id');
    }
}
