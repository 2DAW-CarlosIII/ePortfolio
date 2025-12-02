<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Tarea",
 *     type="object",
 *     title="Tarea",
 *     description="Modelo de Tarea",
 *     @OA\Property(property="id", type="integer", description="ID único"),
 *     @OA\Property(property="criterios_evaluacion", type="array",
 *          @OA\Items(type="object", schema="CriterioEvaluacion"),
 *          description="ID de los criterios_evaluacion"
 *     ),
 *     @OA\Property(property="fecha_apertura", type="string", format="date-time", description="Fecha de apertura"),
 *     @OA\Property(property="fecha_cierre", type="string", format="date-time", description="Fecha de cierre"),
 *     @OA\Property(property="activo", type="boolean", description="Estado activo"),
 *     @OA\Property(property="observaciones", type="string", description="Observaciones"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización"),
 * )
 */

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tareas';

    protected $fillable = [
        'fecha_apertura',
        'fecha_cierre',
        'activo',
        'observaciones'
    ];
    protected $casts = [
        'fecha_apertura' => 'datetime',
        'fecha_cierre' => 'datetime',
        'activo' => 'boolean'
    ];
    public function criterios_evaluacion()
    {
        return $this->belongsToMany(CriterioEvaluacion::class, 'criterios_tareas', 'tarea_id', 'criterio_evaluacion_id');
    }

    public function evidencias()
    {
        return $this->hasMany(Evidencia::class, 'tarea_id');
    }

    public function asignacionAleatoria($numEstudiantes = 4, $fechaLimite = null)
    {
        $now = now();
        if (!$fechaLimite) {
            $fechaLimite = $now->addDays(5);
        }
        if ($this->fecha_apertura && $now->lt($this->fecha_apertura)) {
            throw new \Exception("La tarea aún no ha abierto.");
        }

        // Obtener todas las evidencias asociadas a esta tarea
        $evidencias = $this->evidencias()->get();

        // Obtener IDs de estudiantes que han entregado evidencias para esta tarea
        $estudiantes = $evidencias->pluck('estudiante_id')->unique()->values()->all();

        if (empty($estudiantes)) {
            return; // No hay estudiantes para asignar
        }

        // Inicializar contador de revisiones por estudiante
        $revisionesPorEstudiante = array_fill_keys($estudiantes, 0);

        foreach ($evidencias as $evidencia) {
            // Mezclar estudiantes para aleatoriedad
            $estudiantesShuffle = $estudiantes;
            shuffle($estudiantesShuffle);

            // Seleccionar hasta 4 estudiantes con menos revisiones asignadas
            usort($estudiantesShuffle, function($a, $b) use ($revisionesPorEstudiante) {
                return $revisionesPorEstudiante[$a] <=> $revisionesPorEstudiante[$b];
            });

            $asignados = array_slice($estudiantesShuffle, 0, 4);

            foreach ($asignados as $estudianteId) {
                // Crear la asignación de revisión
                $evidencia->asignacionRevision()->create([
                    'evidencia_id' => $evidencia->id,
                    'revisor_id' => $estudianteId,
                    'asignado_por_id' => auth()->id(),
                    'estado' => 'pendiente',
                    'fecha_limite' => $fechaLimite->format('Y-m-d H:i:s')
                ]);
                $revisionesPorEstudiante[$estudianteId]++;
            }
            $evidencia->estado_validacion = 'asignada';
            $evidencia->save();
        }
    }
}
