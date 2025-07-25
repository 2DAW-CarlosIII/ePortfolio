<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComentarioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'evidencia_id' => $this->evidencia_id,
            'user_id' => $this->user_id,
            'contenido' => $this->contenido,
            'tipo' => $this->tipo,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'evidencia' => new EvidenciaResource($this->whenLoaded('evidencia')),
            'user' => new UserResource($this->whenLoaded('user'))
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     */
    public function with(Request $request): array
    {
        return [
            'meta' => [
                'resource_type' => 'comentarios',
                'generated_at' => now()->toISOString(),
            ],
        ];
    }
}
