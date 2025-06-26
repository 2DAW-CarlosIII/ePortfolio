<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluacionParResource extends JsonResource
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
            'puntuacion_sugerida' => number_format((float) $this->puntuacion_sugerida, 2, '.', ''),
            'recomendacion' => $this->recomendacion,
            'justificacion' => $this->justificacion,
            'fecha_evaluacion' => $this->fecha_evaluacion?->format('Y-m-d H:i:s'),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
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
                'resource_type' => 'evaluaciones_pares',
                'generated_at' => now()->toISOString(),
            ],
        ];
    }
}
