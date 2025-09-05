<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultadoAprendizajeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'modulo_formativo_id' => $this->modulo_formativo_id,
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
            'modulo_formativo' => new ModuloFormativoResource($this->whenLoaded('modulo_formativo'))
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     */
    public function with(Request $request): array
    {
        return [
            'meta' => [
                'resource_type' => 'resultado_aprendizaje',
                'generated_at' => now()->toISOString(),
            ],
        ];
    }
}
