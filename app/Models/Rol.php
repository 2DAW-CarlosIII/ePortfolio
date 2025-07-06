<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Rol",
 *     type="object",
 *     title="Rol",
 *     description="Modelo de Rol",
 *     @OA\Property(property="id", type="integer", description="ID único"),
 *     @OA\Property(property="name", type="string", description="Nombre del rol"),
 *     @OA\Property(property="description", type="string", description="Descripción del rol"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización"),
 * )
 */

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'description'
    ];
}
