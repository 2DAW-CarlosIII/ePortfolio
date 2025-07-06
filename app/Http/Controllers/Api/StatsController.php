<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Evidencia;
use App\Models\ModuloFormativo;
use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Tag(
 *     name="Estadísticas",
 *     description="Endpoints para obtener estadísticas del sistema ePortfolio"
 * )
 */
class StatsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/stats",
     *     tags={"Estadísticas"},
     *     summary="Estadísticas generales del sistema",
     *     description="Obtiene un resumen de estadísticas generales del sistema incluyendo usuarios, módulos, matrículas y evidencias",
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Estadísticas obtenidas exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="usuarios",
     *                 type="object",
     *                 @OA\Property(property="total", type="integer", example=250, description="Total de usuarios registrados")
     *             ),
     *             @OA\Property(
     *                 property="modulos",
     *                 type="object",
     *                 @OA\Property(property="total", type="integer", example=12, description="Total de módulos formativos"),
     *                 @OA\Property(property="activos", type="integer", example=8, description="Módulos formativos activos")
     *             ),
     *             @OA\Property(
     *                 property="matriculas",
     *                 type="object",
     *                 @OA\Property(property="total", type="integer", example=180, description="Total de matrículas"),
     *                 @OA\Property(property="activas", type="integer", example=165, description="Matrículas activas")
     *             ),
     *             @OA\Property(
     *                 property="evidencias",
     *                 type="object",
     *                 @OA\Property(property="total", type="integer", example=1250, description="Total de evidencias"),
     *                 @OA\Property(property="validadas", type="integer", example=980, description="Evidencias validadas"),
     *                 @OA\Property(property="pendientes", type="integer", example=270, description="Evidencias pendientes de validación")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autorizado - Token requerido",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Error interno del servidor"),
     *             @OA\Property(property="error", type="string")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json([
            'usuarios' => [
                'total' => User::count(),
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
     * @OA\Get(
     *     path="/api/stats/estudiantes",
     *     tags={"Estadísticas"},
     *     summary="Estadísticas de estudiantes",
     *     description="Obtiene estadísticas específicas sobre estudiantes, con posibilidad de filtrar por módulo formativo",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="modulo_id",
     *         in="query",
     *         description="ID del módulo formativo para filtrar estadísticas",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Estadísticas de estudiantes obtenidas exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="total_estudiantes",
     *                 type="integer",
     *                 example=1,
     *                 description="Total de estudiantes registrados"
     *             ),
     *             @OA\Property(
     *                 property="con_evidencias",
     *                 type="integer",
     *                 example=1,
     *                 description="Estudiantes que tienen al menos una evidencia"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autorizado - Token requerido",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Los datos proporcionados no son válidos"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="modulo_id",
     *                     type="array",
     *                     @OA\Items(type="string", example="El campo modulo_id debe ser un número entero.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function estudiantes(Request $request)
    {
        $moduloId = $request->get('modulo_id');

/*         $query = User::whereHas('userRoles', function($q) use ($moduloId) {
            $q->whereHas('role', function($r) {
                $r->where('name', 'estudiante');
            });
            if ($moduloId) {
                $q->where('modulo_formativo_id', $moduloId);
            }
        }); */
        return response()->json([
            'total_estudiantes' => 1,
            'con_evidencias' => 1,
        ]);
/*
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
 */    }

    /**
     * @OA\Get(
     *     path="/api/stats/evidencias",
     *     tags={"Estadísticas"},
     *     summary="Estadísticas de evidencias por criterio",
     *     description="Obtiene estadísticas detalladas sobre evidencias, con posibilidad de filtrar por criterio de evaluación y módulo formativo",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="criterio_id",
     *         in="query",
     *         description="ID del criterio de evaluación para filtrar evidencias",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             example=5
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="modulo_id",
     *         in="query",
     *         description="ID del módulo formativo para filtrar evidencias",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Estadísticas de evidencias obtenidas exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="total",
     *                 type="integer",
     *                 example=850,
     *                 description="Total de evidencias que coinciden con los filtros"
     *             ),
     *             @OA\Property(
     *                 property="por_estado",
     *                 type="object",
     *                 description="Distribución de evidencias por estado de validación",
     *                 @OA\Property(property="pendiente", type="integer", example=125),
     *                 @OA\Property(property="validada", type="integer", example=650),
     *                 @OA\Property(property="rechazada", type="integer", example=75)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autorizado - Token requerido",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Los datos proporcionados no son válidos"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="criterio_id",
     *                     type="array",
     *                     @OA\Items(type="string", example="El campo criterio_id debe ser un número entero.")
     *                 ),
     *                 @OA\Property(
     *                     property="modulo_id",
     *                     type="array",
     *                     @OA\Items(type="string", example="El campo modulo_id debe ser un número entero.")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recurso no encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="El criterio o módulo especificado no existe")
     *         )
     *     )
     * )
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
/*
            'por_mes' => $query->select(
                               DB::raw('YEAR(fecha_creacion) as año'),
                               DB::raw('MONTH(fecha_creacion) as mes'),
                               DB::raw('count(*) as total')
                           )
                           ->groupBy('año', 'mes')
                           ->orderBy('año', 'desc')
                           ->orderBy('mes', 'desc')
                           ->limit(12)
                           ->get(), */
        ]);
    }
}
