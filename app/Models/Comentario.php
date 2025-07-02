<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentarios';

    protected $fillable = [
        'evidencia_id',
        'user_id',
        'contenido',
        'tipo'
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
