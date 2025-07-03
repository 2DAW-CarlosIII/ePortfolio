<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuloFormativo extends Model
{
    use HasFactory;

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
    public function ciclos_formativo()
    {
        return $this->belongsTo(CicloFormativo::class, 'ciclos_formativo_id');
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
