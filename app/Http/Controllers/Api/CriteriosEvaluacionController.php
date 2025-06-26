<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CriteriosEvaluacion;
use App\Http\Requests\StoreCriteriosEvaluacionRequest;
use App\Http\Requests\UpdateCriteriosEvaluacionRequest;
use App\Http\Resources\CriteriosEvaluacionResource;
use Illuminate\Http\Request;


/**
 * @OA\Tag(
 *     name="CriteriosEvaluacion",
 *     description="Operations related to CriteriosEvaluacion"
 * )
 */

/**
 * @OA\Get(
 *     path="/resultados-aprendizaje/{parent_id}/criterios-evaluacion",
 *     tags={"CriteriosEvaluacion"},
 *     summary="List all criteriosevaluacions",
 *     description="Retrieve a paginated list of criteriosevaluacions",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent ResultadoAprendizaje",
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
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/CriteriosEvaluacion")),
 *             @OA\Property(property="links", type="object"),
 *             @OA\Property(property="meta", type="object")
 *         )
 *     ),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Post(
 *     path="/resultados-aprendizaje/{parent_id}/criterios-evaluacion",
 *     tags={"CriteriosEvaluacion"},
 *     summary="Create a new criteriosevaluacion",
 *     description="Create a new criteriosevaluacion resource",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent ResultadoAprendizaje",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/StoreCriteriosEvaluacionRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Resource created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/CriteriosEvaluacion")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Get(
 *     path="/resultados-aprendizaje/{parent_id}/criterios-evaluacion/{id}",
 *     tags={"CriteriosEvaluacion"},
 *     summary="Show a specific criteriosevaluacion",
 *     description="Retrieve a specific criteriosevaluacion by ID",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent ResultadoAprendizaje",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the criteriosevaluacion",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/CriteriosEvaluacion")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Put(
 *     path="/resultados-aprendizaje/{parent_id}/criterios-evaluacion/{id}",
 *     tags={"CriteriosEvaluacion"},
 *     summary="Update a specific criteriosevaluacion",
 *     description="Update a specific criteriosevaluacion by ID",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent ResultadoAprendizaje",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the criteriosevaluacion",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateCriteriosEvaluacionRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Resource updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/CriteriosEvaluacion")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Delete(
 *     path="/resultados-aprendizaje/{parent_id}/criterios-evaluacion/{id}",
 *     tags={"CriteriosEvaluacion"},
 *     summary="Delete a specific criteriosevaluacion",
 *     description="Delete a specific criteriosevaluacion by ID",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID
 
 
 
  *         description="Resource deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="CriteriosEvaluacion eliminado correctamente")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

class CriteriosEvaluacionController extends Controller
{
    public function index(Request $request)
    {
        $query = CriteriosEvaluacion::query();

        // Filtro de búsqueda
        if ($request->has('search') && $request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('codigo', 'like', "%$search%")->orWhere('descripcion', 'like', "%$search%");
            });
        }

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
        $criteriosEvaluacions = $query->paginate($perPage);
        
        return CriteriosEvaluacionResource::collection($criteriosEvaluacions);
    }

    public function store(StoreCriteriosEvaluacionRequest $request)
    {
        $criteriosEvaluacion = CriteriosEvaluacion::create($request->validated());
        
        // Cargar relaciones para la respuesta
        $criteriosEvaluacion->load($this->getEagerLoadRelations());
        
        return new CriteriosEvaluacionResource($criteriosEvaluacion);
    }

    public function show(CriteriosEvaluacion $criteriosEvaluacion)
    {
        
        // Cargar relaciones
        $criteriosEvaluacion->load($this->getEagerLoadRelations());
        
        return new CriteriosEvaluacionResource($criteriosEvaluacion);
    }

    public function update(UpdateCriteriosEvaluacionRequest $request, CriteriosEvaluacion $criteriosEvaluacion)
    {
        
        $criteriosEvaluacion->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $criteriosEvaluacion->load($this->getEagerLoadRelations());
        
        return new CriteriosEvaluacionResource($criteriosEvaluacion);
    }

    public function destroy(CriteriosEvaluacion $criteriosEvaluacion)
    {
        
        $criteriosEvaluacion->delete();
        
        return response()->json([
            'message' => 'CriteriosEvaluacion eliminado correctamente'
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
