<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matriculas';

    protected $fillable = [
        'estudiante_id',
        'modulo_formativo_id',
        'fecha_matricula',
        'estado'
    ];
    protected $casts = [
        'fecha_matricula' => 'date'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function modulos_formativo()
    {
        return $this->belongsTo(ModuloFormativo::class, 'modulos_formativo_id');
    }
}
