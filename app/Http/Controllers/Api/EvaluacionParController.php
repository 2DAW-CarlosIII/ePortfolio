<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EvaluacionPar;
use App\Http\Requests\StoreEvaluacionParRequest;
use App\Http\Requests\UpdateEvaluacionParRequest;
use App\Http\Resources\EvaluacionParResource;
use Illuminate\Http\Request;


/**
 * @OA\Tag(
 *     name="EvaluacionPar",
 *     description="Operations related to EvaluacionPar"
 * )
 */

/**
 * @OA\Get(
 *     path="/users/{parent_id}/evaluaciones-pares",
 *     tags={"EvaluacionPar"},
 *     summary="List all evaluacionpars",
 *     description="Retrieve a paginated list of evaluacionpars",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent User",
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
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/EvaluacionPar")),
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
 *     path="/users/{parent_id}/evaluaciones-pares",
 *     tags={"EvaluacionPar"},
 *     summary="Create a new evaluacionpar",
 *     description="Create a new evaluacionpar resource",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent User",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/StoreEvaluacionParRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Resource created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/EvaluacionPar")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Get(
 *     path="/users/{parent_id}/evaluaciones-pares/{id}",
 *     tags={"EvaluacionPar"},
 *     summary="Show a specific evaluacionpar",
 *     description="Retrieve a specific evaluacionpar by ID",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent User",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the evaluacionpar",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/EvaluacionPar")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Put(
 *     path="/users/{parent_id}/evaluaciones-pares/{id}",
 *     tags={"EvaluacionPar"},
 *     summary="Update a specific evaluacionpar",
 *     description="Update a specific evaluacionpar by ID",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent User",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the evaluacionpar",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateEvaluacionParRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Resource updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/EvaluacionPar")
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
 *     path="/users/{parent_id}/evaluaciones-pares/{id}",
 *     tags={"EvaluacionPar"},
 *     summary="Delete a specific evaluacionpar",
 *     description="Delete a specific evaluacionpar by ID",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID
 
 
 
  *         description="Resource deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="EvaluacionPar eliminado correctamente")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

class EvaluacionParController extends Controller
{
    public function index(Request $request)
    {
        $query = EvaluacionPar::query();


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
        $evaluacionPars = $query->paginate($perPage);
        
        return EvaluacionParResource::collection($evaluacionPars);
    }

    public function store(StoreEvaluacionParRequest $request)
    {
        $evaluacionPar = EvaluacionPar::create($request->validated());
        
        // Cargar relaciones para la respuesta
        $evaluacionPar->load($this->getEagerLoadRelations());
        
        return new EvaluacionParResource($evaluacionPar);
    }

    public function show(EvaluacionPar $evaluacionPar)
    {
        
        // Cargar relaciones
        $evaluacionPar->load($this->getEagerLoadRelations());
        
        return new EvaluacionParResource($evaluacionPar);
    }

    public function update(UpdateEvaluacionParRequest $request, EvaluacionPar $evaluacionPar)
    {
        
        $evaluacionPar->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $evaluacionPar->load($this->getEagerLoadRelations());
        
        return new EvaluacionParResource($evaluacionPar);
    }

    public function destroy(EvaluacionPar $evaluacionPar)
    {
        
        $evaluacionPar->delete();
        
        return response()->json([
            'message' => 'EvaluacionPar eliminado correctamente'
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
