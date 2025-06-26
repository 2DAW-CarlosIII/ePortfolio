<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultadoAprendizaje extends Model
{
    use HasFactory;

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
    public function modulos_formativo()
    {
        return $this->belongsTo(ModuloFormativo::class, 'modulos_formativo_id');
    }
    public function criterios_evaluacion()
    {
        return $this->hasMany(CriteriosEvaluacion::class, 'resultados_aprendizaje_id');
    }
}
