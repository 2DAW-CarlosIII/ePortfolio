<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionEvidencia extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones_evidencias';

    protected $fillable = [
        'evidencia_id',
        'docente_id',
        'puntuacion',
        'estado',
        'observaciones',
        'fecha_evaluacion'
    ];
    protected $casts = [
        'puntuacion' => 'decimal:2',
        'fecha_evaluacion' => 'datetime'
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
