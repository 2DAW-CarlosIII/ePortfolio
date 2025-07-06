<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlanificacionCriterios;
use App\Http\Requests\StorePlanificacionCriteriosRequest;
use App\Http\Requests\UpdatePlanificacionCriteriosRequest;
use App\Http\Resources\PlanificacionCriteriosResource;
use App\Models\CriterioEvaluacion;
use Illuminate\Http\Request;


/**
 * @OA\Tag(
 *     name="PlanificacionCriterios",
 *     description="Operations related to PlanificacionCriterios"
 * )
 */

class PlanificacionCriteriosController extends Controller
{

/**
 * @OA\Get(
 *     path="/modulos-formativos/{parent_id}/planificacion-criterios",
 *     tags={"PlanificacionCriterios"},
 *     summary="List all planificacioncriterioss",
 *     description="Retrieve a paginated list of planificacioncriterioss",
 *     security={"sanctum":{}},
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
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/PlanificacionCriterio")),
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
        $query = $criterioEvaluacion->planificacion_criterios()->newQuery();

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
        $planificacionCriterios = $query->paginate($perPage);

        return PlanificacionCriteriosResource::collection($planificacionCriterios);
    }

/**
 * @OA\Post(
 *     path="/modulos-formativos/{parent_id}/planificacion-criterios",
 *     tags={"PlanificacionCriterios"},
 *     summary="Create a new planificacioncriterios",
 *     description="Create a new planificacioncriterios resource",
 *     security={"sanctum":{}},
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
 *             @OA\Property(property="data", ref="#/components/schemas/PlanificacionCriterio")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function store(StorePlanificacionCriteriosRequest $request, CriterioEvaluacion $criterioEvaluacion)
    {
        $data = $request->validated();
        $data['criterio_evaluacion_id'] = $criterioEvaluacion->id;

        $planificacionCriterio = PlanificacionCriterios::create($data);

        // Cargar relaciones para la respuesta
        $planificacionCriterio->load($this->getEagerLoadRelations());

        return new PlanificacionCriteriosResource($planificacionCriterio);
    }

/**
 * @OA\Get(
 *     path="/modulos-formativos/{parent_id}/planificacion-criterios/{id}",
 *     tags={"PlanificacionCriterios"},
 *     summary="Show a specific planificacioncriterios",
 *     description="Retrieve a specific planificacioncriterios by ID",
 *     security={"sanctum":{}},
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
 *         description="ID of the planificacioncriterios",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/PlanificacionCriterio")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function show(CriterioEvaluacion $criterioEvaluacion, PlanificacionCriterios $planificacionCriterio)
    {
        if($criterioEvaluacion->id !== $planificacionCriterio->criterio_evaluacion_id) {
            return response()->json(['message' => 'El criterio de evaluación no coincide con el planificacion criterio'], 404);
        }

        // Cargar relaciones
        $planificacionCriterio->load($this->getEagerLoadRelations());

        return new PlanificacionCriteriosResource($planificacionCriterio);
    }

/**
 * @OA\Put(
 *     path="/modulos-formativos/{parent_id}/planificacion-criterios/{id}",
 *     tags={"PlanificacionCriterios"},
 *     summary="Update a specific planificacioncriterios",
 *     description="Update a specific planificacioncriterios by ID",
 *     security={"sanctum":{}},
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
 *         description="ID of the planificacioncriterios",
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
 *             @OA\Property(property="data", ref="#/components/schemas/PlanificacionCriterio")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function update(UpdatePlanificacionCriteriosRequest $request, CriterioEvaluacion $criterioEvaluacion, PlanificacionCriterios $planificacionCriterio)
    {
        if($criterioEvaluacion->id !== $planificacionCriterio->criterio_evaluacion_id) {
            return response()->json(['message' => 'El criterio de evaluación no coincide con el planificacion criterio'], 404);
        }

        $planificacionCriterio->update($request->validated());

        // Cargar relaciones para la respuesta
        $planificacionCriterio->load($this->getEagerLoadRelations());

        return new PlanificacionCriteriosResource($planificacionCriterio);
    }

/**
 * @OA\Delete(
 *     path="/modulos-formativos/{parent_id}/planificacion-criterios/{id}",
 *     tags={"PlanificacionCriterios"},
 *     summary="Delete a specific planificacioncriterios",
 *     description="Delete a specific planificacioncriterios by ID",
 *     security={"sanctum":{}},
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
 *             @OA\Property(property="message", type="string", example="PlanificacionCriterios eliminado correctamente")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function destroy(CriterioEvaluacion $criterioEvaluacion, PlanificacionCriterios $planificacionCriterio)
    {
        if($criterioEvaluacion->id !== $planificacionCriterio->criterio_evaluacion_id) {
            return response()->json(['message' => 'El criterio de evaluación no coincide con el planificacion criterio'], 404);
        }

        $planificacionCriterio->delete();

        return response()->json([
            'message' => 'PlanificacionCriterios eliminado correctamente'
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
