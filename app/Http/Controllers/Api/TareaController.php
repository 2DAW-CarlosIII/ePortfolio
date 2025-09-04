<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tarea;
use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateTareaRequest;
use App\Http\Resources\TareaResource;
use App\Models\CriterioEvaluacion;
use Illuminate\Http\Request;


/**
 * @OA\Tag(
 *     name="Tareas",
 *     description="Operations related to Tareas"
 * )
 */

class TareaController extends Controller
{

/**
 * @OA\Get(
 *     path="/modulos-formativos/{parent_id}/tareas",
 *     tags={"Tareas"},
 *     summary="List all planificacioncriterioss",
 *     description="Retrieve a paginated list of planificacioncriterioss",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent ModuloFormativo",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="search",
 *         in="query",
 *         description="Search term",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="per_page",
 *         in="query",
 *         description="Items per page",
 *         required=false,
 *         @OA\Schema(type="integer", default=15)
 *     ),
 *     @OA\Parameter(
 *         name="page",
 *         in="query",
 *         description="Page number",
 *         required=false,
 *         @OA\Schema(type="integer", default=1)
 *     ),
 *     @OA\Parameter(
 *         name="sort_by",
 *         in="query",
 *         description="Field to sort by",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="sort_direction",
 *         in="query",
 *         description="direction of sorting (asc or desc)",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Tarea")),
 *             @OA\Property(property="links", type="object"),
 *             @OA\Property(property="meta", type="object")
 *         )
 *     ),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function index(Request $request, CriterioEvaluacion $criterioEvaluacion)
    {
        $query = $criterioEvaluacion->tareas()->newQuery();

        // Filtros adicionales
        if ($request->has('estado') && $request->filled('estado')) {
            $query->where('estado', $request->get('estado'));
        }

        if ($request->has('activo') && $request->filled('activo')) {
            $query->where('activo', $request->boolean('activo'));
        }

        // Eager loading de relaciones comunes
        $query->with($this->getEagerLoadRelations());

        // Ordenamiento
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        $query->orderBy($sortBy, $sortDirection);

        // Paginación
        $perPage = $request->get('per_page', 15);
        $tareas = $query->paginate($perPage);

        return TareaResource::collection($tareas);
    }

/**
 * @OA\Post(
 *     path="/modulos-formativos/{parent_id}/tareas",
 *     tags={"Tareas"},
 *     summary="Create a new tarea",
 *     description="Create a new tarea resource",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent ModuloFormativo",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/StorePlanificacionCriterioRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Resource created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/Tarea")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function store(StoreTareaRequest $request, CriterioEvaluacion $criterioEvaluacion)
    {
        $data = $request->validated();
        $data['criterio_evaluacion_id'] = $criterioEvaluacion->id;

        $tarea = Tarea::create($data);

        // Cargar relaciones para la respuesta
        $tarea->load($this->getEagerLoadRelations());

        return new TareaResource($tarea);
    }

/**
 * @OA\Get(
 *     path="/modulos-formativos/{parent_id}/tareas/{id}",
 *     tags={"Tareas"},
 *     summary="Show a specific tarea",
 *     description="Retrieve a specific tarea by ID",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent ModuloFormativo",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the tarea",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/Tarea")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function show(CriterioEvaluacion $criterioEvaluacion, Tarea $tarea)
    {
        if($criterioEvaluacion->id !== $tarea->criterio_evaluacion_id) {
            return response()->json(['message' => 'El criterio de evaluación no coincide con el planificacion criterio'], 404);
        }

        // Cargar relaciones
        $tarea->load($this->getEagerLoadRelations());

        return new TareaResource($tarea);
    }

/**
 * @OA\Put(
 *     path="/modulos-formativos/{parent_id}/tareas/{id}",
 *     tags={"Tareas"},
 *     summary="Update a specific tarea",
 *     description="Update a specific tarea by ID",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent ModuloFormativo",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the tarea",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdatePlanificacionCriterioRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Resource updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/Tarea")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function update(UpdateTareaRequest $request, CriterioEvaluacion $criterioEvaluacion, Tarea $tarea)
    {
        if($criterioEvaluacion->id !== $tarea->criterio_evaluacion_id) {
            return response()->json(['message' => 'El criterio de evaluación no coincide con el planificacion criterio'], 404);
        }

        $tarea->update($request->validated());

        // Cargar relaciones para la respuesta
        $tarea->load($this->getEagerLoadRelations());

        return new TareaResource($tarea);
    }

/**
 * @OA\Delete(
 *     path="/modulos-formativos/{parent_id}/tareas/{id}",
 *     tags={"Tareas"},
 *     summary="Delete a specific tarea",
 *     description="Delete a specific tarea by ID",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the criterio de evaluación",
 *      required=true,
 *      @OA\Schema(type="integer")
 *   ),
 *    @OA\Response(
 *        response=204,
 *       description="Resource deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Tareas eliminado correctamente")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function destroy(CriterioEvaluacion $criterioEvaluacion, Tarea $tarea)
    {
        if($criterioEvaluacion->id !== $tarea->criterio_evaluacion_id) {
            return response()->json(['message' => 'El criterio de evaluación no coincide con el planificacion criterio'], 404);
        }

        $tarea->delete();

        return response()->json([
            'message' => 'Tareas eliminado correctamente'
        ]);
    }

    /**
     * Obtiene las relaciones a cargar con eager loading
     */
    private function getEagerLoadRelations(): array
    {
        return []; // TODO: Definir relaciones específicas según el modelo
    }
}
