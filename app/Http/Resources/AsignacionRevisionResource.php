<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AsignacionRevisionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'evidencia_id' => $this->evidencia_id,
            'revisor_id' => $this->revisor_id,
            'asignado_por_id' => $this->asignado_por_id,
            'fecha_asignacion' => $this->fecha_asignacion?->format('Y-m-d'),
            'fecha_limite' => $this->fecha_limite?->format('Y-m-d'),
            'estado' => $this->estado,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'evidencia' => new EvidenciaResource($this->whenLoaded('evidencia')),
            'user' => new UserResource($this->whenLoaded('user')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     */
    public function with(Request $request): array
    {
        return [
            'meta' => [
                'resource_type' => 'asignaciones_revision',
                'generated_at' => now()->toISOString(),
            ],
        ];
    }
}
