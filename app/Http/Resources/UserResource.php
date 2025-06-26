<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at?->toISOString(),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            
            // Relaciones
            'roles' => RoleResource::collection($this->whenLoaded('userRoles.role')),
            'modulos_impartidos' => ModuloFormativoResource::collection($this->whenLoaded('modulosImpartidos')),
            'matriculas' => MatriculaResource::collection($this->whenLoaded('matriculas')),
            'evidencias' => EvidenciaResource::collection($this->whenLoaded('evidencias')),
            
            // Contadores
            'matriculas_count' => $this->whenCounted('matriculas'),
            'evidencias_count' => $this->whenCounted('evidencias'),
            'modulos_impartidos_count' => $this->whenCounted('modulosImpartidos'),
            
            // Campos calculados
            'rol_principal' => $this->when(
                $this->relationLoaded('userRoles'),
                function() {
                    return $this->userRoles->first()?->role?->name ?? 'sin_rol';
                }
            ),
            'ultimo_acceso' => $this->last_login_at?->diffForHumans(),
            'avatar_url' => 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=random',
        ];
    }
    
    /**
     * Get additional data that should be returned with the resource array.
     */
    public function with(Request $request): array
    {
        return [
            'meta' => [
                'resource_type' => 'user',
                'generated_at' => now()->toISOString(),
                'permissions' => $this->when(
                    $request->user()?->can('viewAny', $this->resource),
                    function() use ($request) {
                        return [
                            'can_edit' => $request->user()->can('update', $this->resource),
                            'can_delete' => $request->user()->can('delete', $this->resource),
                        ];
                    }
                ),
            ],
        ];
    }
}
