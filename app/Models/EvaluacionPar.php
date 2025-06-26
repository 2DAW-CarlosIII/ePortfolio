<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionPar extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones_pares';

    protected $fillable = [
        'asignacion_revision_id',
        'revisor_id',
        'puntuacion_sugerida',
        'recomendacion',
        'justificacion',
        'fecha_evaluacion'
    ];
    protected $casts = [
        'puntuacion_sugerida' => 'decimal:2',
        'fecha_evaluacion' => 'datetime'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
