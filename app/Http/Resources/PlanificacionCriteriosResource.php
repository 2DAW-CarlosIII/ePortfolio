<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanificacionCriteriosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'criterio_evaluacion_id' => $this->criterio_evaluacion_id,
            'modulo_formativo_id' => $this->modulo_formativo_id,
            'fecha_apertura' => $this->fecha_apertura?->format('Y-m-d'),
            'fecha_cierre' => $this->fecha_cierre?->format('Y-m-d'),
            'activo' => (bool) $this->activo,
            'observaciones' => $this->observaciones,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'criterios_evaluacion' => new CriteriosEvaluacionResource($this->whenLoaded('criterios_evaluacion')),
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
                'resource_type' => 'planificacion_criterios',
                'generated_at' => now()->toISOString(),
            ],
        ];
    }
}
