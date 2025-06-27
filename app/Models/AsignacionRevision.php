<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionRevision extends Model
{
    use HasFactory;

    protected $table = 'asignaciones_revision';

    protected $fillable = [
        'evidencia_id',
        'revisor_id',
        'asignado_por_id',
        'fecha_asignacion',
        'fecha_limite',
        'estado'
    ];
    protected $casts = [
        'fecha_asignacion' => 'date',
        'fecha_limite' => 'date'
    ];
    public function evidencia()
    {
        return $this->belongsTo(Evidencia::class, 'evidencia_id');
    }
    public function revisor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function asignador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comentarios_pares()
    {
        return $this->hasMany(ComentarioPar::class, 'asignaciones_revision_id');
    }
}
