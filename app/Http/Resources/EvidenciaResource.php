<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvidenciaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'estudiante_id' => $this->estudiante_id,
            'tarea_id' => $this->criterio_evaluacion_id,
            'url' => $this->url,
            'descripcion' => $this->descripcion,
            'descripcion_excerpt' => $this->when(
                strlen($this->descripcion ?? '') > 100,
                substr($this->descripcion ?? '', 0, 100) . '...'
            ),
            'estado_validacion' => $this->estado_validacion,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'user' => new UserResource($this->whenLoaded('user')),
            'tarea' => new TareaResource($this->whenLoaded('tarea')),
            'evaluaciones_evidencias' => EvaluacionEvidenciaResource::collection($this->whenLoaded('evaluaciones_evidencias')),
            'evaluaciones_evidencias_count' => $this->whenCounted('evaluaciones_evidencias'),
            'comentarios' => ComentarioResource::collection($this->whenLoaded('comentarios')),
            'comentarios_count' => $this->whenCounted('comentarios'),
            'asignaciones_revisions' => AsignacionRevisionResource::collection($this->whenLoaded('asignaciones_revisions')),
            'asignaciones_revisions_count' => $this->whenCounted('asignaciones_revisions'),
            'estado_badge' => [
                'text' => match($this->estado_validacion) {
                    'validada' => 'Validada',
                    'rechazada' => 'Rechazada',
                    default => 'Pendiente',
                },
                'color' => match($this->estado_validacion) {
                    'validada' => 'green',
                    'rechazada' => 'red',
                    default => 'yellow',
                },
            ],
            'tiempo_transcurrido' => $this->created_at?->diffForHumans()
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     */
    public function with(Request $request): array
    {
        return [
            'meta' => [
                'resource_type' => 'evidencias',
                'generated_at' => now()->toISOString(),
            ],
        ];
    }
}
