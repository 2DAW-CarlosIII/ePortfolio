<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CriteriosEvaluacionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'resultado_aprendizaje_id' => $this->resultado_aprendizaje_id,
            'codigo' => $this->codigo,
            'descripcion' => $this->descripcion,
            'descripcion_excerpt' => $this->when(
                strlen($this->descripcion ?? '') > 100,
                substr($this->descripcion ?? '', 0, 100) . '...'
            ),
            'peso_porcentaje' => round((float) $this->peso_porcentaje, 2),
            'orden' => (int) $this->orden,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'resultado_aprendizaje' => new ResultadoAprendizajeResource($this->whenLoaded('resultado_aprendizaje'))
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     */
    public function with(Request $request): array
    {
        return [
            'meta' => [
                'resource_type' => 'criterios_evaluacion',
                'generated_at' => now()->toISOString(),
            ],
        ];
    }
}
