<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamiliaProfesional extends Model
{
    use HasFactory;

    protected $table = 'familias_profesionales';

    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion'
    ];
    public function ciclos_formativos()
    {
        return $this->hasMany(CicloFormativo::class, 'familia_profesional_id');
    }
}
