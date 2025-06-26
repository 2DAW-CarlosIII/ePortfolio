<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    use HasFactory;

    protected $table = 'evidencias';

    protected $fillable = [
        'estudiante_id',
        'criterio_evaluacion_id',
        'url',
        'descripcion',
        'estado_validacion',
        'fecha_creacion'
    ];
    protected $casts = [
        'fecha_creacion' => 'datetime'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function criterios_evaluacion()
    {
        return $this->belongsTo(CriteriosEvaluacion::class, 'criterios_evaluacion_id');
    }
    public function evaluaciones_evidencias()
    {
        return $this->hasMany(EvaluacionEvidencia::class, 'evidencia_id');
    }
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'evidencia_id');
    }
    public function asignaciones_revision()
    {
        return $this->hasMany(AsignacionRevision::class, 'evidencia_id');
    }
}
