<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioPar extends Model
{
    use HasFactory;

    protected $table = 'comentarios_pares';

    protected $fillable = [
        'asignacion_revision_id',
        'revisor_id',
        'contenido',
        'tipo_comentario'
    ];
    public function asignaciones_revision()
    {
        return $this->belongsTo(AsignacionRevision::class, 'asignaciones_revision_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
