<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CicloFormativo extends Model
{
    use HasFactory;

    protected $table = 'ciclos_formativos';

    protected $fillable = [
        'familia_profesional_id',
        'nombre',
        'codigo',
        'grado',
        'descripcion'
    ];
    public function familias_profesionale()
    {
        return $this->belongsTo(FamiliaProfesional::class, 'familias_profesionale_id');
    }
    public function modulos_formativos()
    {
        return $this->hasMany(ModuloFormativo::class, 'ciclos_formativo_id');
    }
}
