<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Import\UserImportable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="Usuario",
 *     description="Modelo de Usuario",
 *     @OA\Property(property="id", type="integer", description="ID único"),
 *     @OA\Property(property="name", type="string", description="Nombre del usuario"),
 *     @OA\Property(property="email", type="string", format="email", description="Correo electrónico"),
 *     @OA\Property(property="email_verified_at", type="string", format="date-time", description="Fecha de verificación del email"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización"),
 * )
 */

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, UserImportable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function evidencias()
    {
        return $this->hasMany(Evidencia::class, 'estudiante_id');
    }

    public function asignacionesRevision()
    {
        return $this->hasMany(AsignacionRevision::class, 'revisor_id');
    }

    public function modulosImpartidos()
    {
        return $this->hasMany(ModuloFormativo::class, 'docente_id');
    }

    public function modulosMatriculados()
    {
        return $this->belongsToMany(ModuloFormativo::class, 'matriculas', 'estudiante_id', 'modulo_formativo_id');
    }

    public function esDocente(?ModuloFormativo $modulo): bool
    {
        $esDocente = $modulo
            ? $this->esDocenteModulo($modulo)
            : $this->modulosImpartidos()->count() > 0;
        return $esDocente;
    }

    public function esDocenteModulo(ModuloFormativo $modulo): bool
    {
        return $this->modulosImpartidos()->where('id', $modulo->id)->exists();
    }

    public function esEstudiante(?ModuloFormativo $modulo): bool
    {
        $esEstudiante = $modulo
            ? $this->esEstudianteModulo($modulo)
            : ($this->modulosMatriculados()->count() > 0)
                ||
              (Str::endsWith($this->email, '@' . config('app.domains.estudiantes')));
        return $esEstudiante;
    }

    public function esEstudianteModulo(ModuloFormativo $modulo): bool
    {
        return $this->modulosMatriculados()->where('modulos_formativos.id', $modulo->id)->exists();
    }

    public function esAdministrador(): bool
    {
        return $this->email === config('app.admin.email');
    }
}
