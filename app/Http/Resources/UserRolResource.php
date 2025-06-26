<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRolResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'user_id' => $this->user_id,
            'role_id' => $this->role_id,
            'modulo_formativo_id' => $this->modulo_formativo_id,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'user' => new UserResource($this->whenLoaded('user')),
            'role' => new RolResource($this->whenLoaded('role')),
            'modulos_formativo' => new ModuloFormativoResource($this->whenLoaded('modulos_formativo'))
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     */
    public function with(Request $request): array
    {
        return [
            'meta' => [
                'resource_type' => 'user_roles',
                'generated_at' => now()->toISOString(),
            ],
        ];
    }
}
