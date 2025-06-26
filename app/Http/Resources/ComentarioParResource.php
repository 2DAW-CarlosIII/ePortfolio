<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComentarioParResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'asignacion_revision_id' => $this->asignacion_revision_id,
            'revisor_id' => $this->revisor_id,
            'contenido' => $this->contenido,
            'tipo_comentario' => $this->tipo_comentario,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'asignaciones_revision' => new AsignacionRevisionResource($this->whenLoaded('asignaciones_revision')),
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
                'resource_type' => 'comentarios_pares',
                'generated_at' => now()->toISOString(),
            ],
        ];
    }
}
