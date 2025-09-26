<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatriculaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'estudiante' => new UserResource($this->whenLoaded('user')),
            'modulo_formativo' => new ModuloFormativoResource($this->whenLoaded('modulo_formativo')),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'estado_badge' => [
                'text' => match($this->estado) {
                    'activa' => 'Activa',
                    'suspendida' => 'Suspendida',
                    'finalizada' => 'Finalizada',
                    default => 'Desconocido',
                },
                'color' => match($this->estado) {
                    'activa' => 'green',
                    'suspendida' => 'orange',
                    'finalizada' => 'blue',
                    default => 'gray',
                },
            ],
            'dias_matriculado' => $this->created_at?->diffInDays(now())
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     */
    public function with(Request $request): array
    {
        return [
            'meta' => [
                'resource_type' => 'matriculas',
                'generated_at' => now()->toISOString(),
            ],
        ];
    }
}
