<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CicloFormativoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'familia_profesional_id' => $this->familia_profesional_id,
            'nombre' => $this->nombre,
            'codigo' => $this->codigo,
            'grado' => $this->grado,
            'descripcion' => $this->descripcion,
            'descripcion_excerpt' => $this->when(
                strlen($this->descripcion ?? '') > 100,
                substr($this->descripcion ?? '', 0, 100) . '...'
            ),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'familia_profesional' => new FamiliaProfesionalResource($this->whenLoaded('familia_profesional')),
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     */
    public function with(Request $request): array
    {
        return [
            'meta' => [
                'resource_type' => 'ciclos_formativos',
                'generated_at' => now()->toISOString(),
            ],
        ];
    }
}
