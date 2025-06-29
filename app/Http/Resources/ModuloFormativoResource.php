<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModuloFormativoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'ciclo_formativo_id' => $this->ciclo_formativo_id,
            'nombre' => $this->nombre,
            'codigo' => $this->codigo,
            'horas_totales' => (int) $this->horas_totales,
            'curso_escolar' => $this->curso_escolar,
            'centro' => $this->centro,
            'docente_id' => $this->docente_id,
            'descripcion' => $this->descripcion,
            'descripcion_excerpt' => $this->when(
                strlen($this->descripcion ?? '') > 100,
                substr($this->descripcion ?? '', 0, 100) . '...'
            ),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'ciclos_formativo' => new CicloFormativoResource($this->whenLoaded('ciclos_formativo')),
            'user' => new UserResource($this->whenLoaded('user')),
            'resultados_aprendizajes' => ResultadoAprendizajeResource::collection($this->whenLoaded('resultados_aprendizajes')),
            'resultados_aprendizajes_count' => $this->whenCounted('resultados_aprendizajes'),
            'user_roles' => UserRolResource::collection($this->whenLoaded('user_roles')),
            'user_roles_count' => $this->whenCounted('user_roles'),
            'matriculas' => MatriculaResource::collection($this->whenLoaded('matriculas')),
            'matriculas_count' => $this->whenCounted('matriculas'),
            'planificacion_criterios' => PlanificacionCriteriosResource::collection($this->whenLoaded('planificacion_criterios')),
            'planificacion_criterios_count' => $this->whenCounted('planificacion_criterios'),
            'progreso_porcentaje' => $this->when(,
                $this->relationLoaded('evidencias') && $this->relationLoaded('criteriosEvaluacion'),
                function() {
                    $totalCriterios = $this->criteriosEvaluacion->count();,
                    $criteriosConEvidencias = $this->evidencias->pluck('criterio_evaluacion_id')->unique()->count();,
                    return $totalCriterios > 0 ? round(($criteriosConEvidencias / $totalCriterios) * 100, 1) : 0;,
                },
            ),
            'estado_general' => $this->when(,
                $this->relationLoaded('matriculas'),
                function() {
                    $activas = $this->matriculas->where('estado', 'activa')->count();,
                    return $activas > 0 ? 'activo' : 'inactivo';,
                },
            )
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     */
    public function with(Request $request): array
    {
        return [
            'meta' => [
                'resource_type' => 'modulos_formativos',
                'generated_at' => now()->toISOString(),
            ],
        ];
    }
}
