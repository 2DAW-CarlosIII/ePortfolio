<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Evidencia;
use App\Models\ModuloFormativo;
use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    /**
     * Estadísticas generales del sistema
     */
    public function index()
    {
        return response()->json([
            'usuarios' => [
                'total' => User::count(),
                'estudiantes' => User::whereHas('userRoles', function($q) {
                    $q->whereHas('role', function($r) {
                        $r->where('name', 'estudiante');
                    });
                })->count(),
                'docentes' => User::whereHas('userRoles', function($q) {
                    $q->whereHas('role', function($r) {
                        $r->where('name', 'docente');
                    });
                })->count(),
            ],
            'modulos' => [
                'total' => ModuloFormativo::count(),
                'activos' => ModuloFormativo::where('activo', true)->count(),
            ],
            'matriculas' => [
                'total' => Matricula::count(),
                'activas' => Matricula::where('estado', 'activa')->count(),
            ],
            'evidencias' => [
                'total' => Evidencia::count(),
                'validadas' => Evidencia::where('estado_validacion', 'validada')->count(),
                'pendientes' => Evidencia::where('estado_validacion', 'pendiente')->count(),
            ]
        ]);
    }
    
    /**
     * Estadísticas de estudiantes
     */
    public function estudiantes(Request $request)
    {
        $moduloId = $request->get('modulo_id');
        
        $query = User::whereHas('userRoles', function($q) use ($moduloId) {
            $q->whereHas('role', function($r) {
                $r->where('name', 'estudiante');
            });
            if ($moduloId) {
                $q->where('modulo_formativo_id', $moduloId);
            }
        });
        
        return response()->json([
            'total_estudiantes' => $query->count(),
            'con_evidencias' => $query->whereHas('evidencias')->count(),
            'por_modulo' => User::whereHas('userRoles.role', function($q) {
                $q->where('name', 'estudiante');
            })->with(['userRoles.moduloFormativo'])
              ->get()
              ->groupBy('userRoles.0.moduloFormativo.nombre')
              ->map(function($users) {
                  return $users->count();
              }),
        ]);
    }
    
    /**
     * Estadísticas de evidencias por criterio
     */
    public function evidencias(Request $request)
    {
        $criterioId = $request->get('criterio_id');
        $moduloId = $request->get('modulo_id');
        
        $query = Evidencia::query();
        
        if ($criterioId) {
            $query->where('criterio_evaluacion_id', $criterioId);
        }
        
        if ($moduloId) {
            $query->whereHas('criterioEvaluacion.resultadoAprendizaje.moduloFormativo', function($q) use ($moduloId) {
                $q->where('id', $moduloId);
            });
        }
        
        return response()->json([
            'total' => $query->count(),
            'por_estado' => $query->select('estado_validacion', DB::raw('count(*) as total'))
                               ->groupBy('estado_validacion')
                               ->pluck('total', 'estado_validacion'),
            'por_mes' => $query->select(
                               DB::raw('YEAR(fecha_creacion) as año'),
                               DB::raw('MONTH(fecha_creacion) as mes'),
                               DB::raw('count(*) as total')
                           )
                           ->groupBy('año', 'mes')
                           ->orderBy('año', 'desc')
                           ->orderBy('mes', 'desc')
                           ->limit(12)
                           ->get(),
        ]);
    }
}
