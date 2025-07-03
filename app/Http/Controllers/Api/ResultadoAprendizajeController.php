<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ResultadoAprendizaje;
use App\Http\Requests\StoreResultadoAprendizajeRequest;
use App\Http\Requests\UpdateResultadoAprendizajeRequest;
use App\Http\Resources\ResultadoAprendizajeResource;
use App\Models\ModuloFormativo;
use Illuminate\Http\Request;


/**
 * @OA\Tag(
 *     name="ResultadoAprendizaje",
 *     description="Operations related to ResultadoAprendizaje"
 * )
 */

/**
 * @OA\Get(
 *     path="/modulos-formativos/{parent_id}/resultados-aprendizaje",
 *     tags={"ResultadoAprendizaje"},
 *     summary="List all resultadoaprendizajes",
 *     description="Retrieve a paginated list of resultadoaprendizajes",
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
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/ResultadoAprendizaje")),
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
 *     path="/modulos-formativos/{parent_id}/resultados-aprendizaje",
 *     tags={"ResultadoAprendizaje"},
 *     summary="Create a new resultadoaprendizaje",
 *     description="Create a new resultadoaprendizaje resource",
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
 *         @OA\JsonContent(ref="#/components/schemas/StoreResultadoAprendizajeRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Resource created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/ResultadoAprendizaje")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Get(
 *     path="/modulos-formativos/{parent_id}/resultados-aprendizaje/{id}",
 *     tags={"ResultadoAprendizaje"},
 *     summary="Show a specific resultadoaprendizaje",
 *     description="Retrieve a specific resultadoaprendizaje by ID",
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
 *         description="ID of the resultadoaprendizaje",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/ResultadoAprendizaje")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Put(
 *     path="/modulos-formativos/{parent_id}/resultados-aprendizaje/{id}",
 *     tags={"ResultadoAprendizaje"},
 *     summary="Update a specific resultadoaprendizaje",
 *     description="Update a specific resultadoaprendizaje by ID",
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
 *         description="ID of the resultadoaprendizaje",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateResultadoAprendizajeRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Resource updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/ResultadoAprendizaje")
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
 *     path="/modulos-formativos/{parent_id}/resultados-aprendizaje/{id}",
 *     tags={"ResultadoAprendizaje"},
 *     summary="Delete a specific resultadoaprendizaje",
 *     description="Delete a specific resultadoaprendizaje by ID",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the módulo formativo",
 *      required=true,
 *      @OA\Schema(type="integer")
 *   ),
 *    @OA\Response(
 *        response=204,
 *       description="Resource deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="ResultadoAprendizaje eliminado correctamente")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

class ResultadoAprendizajeController extends Controller
{
    public function index(Request $request, ModuloFormativo $moduloFormativo)
    {
        $query = $moduloFormativo->resultados_aprendizaje()->newQuery();

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
        $resultadoAprendizajes = $query->paginate($perPage);

        return ResultadoAprendizajeResource::collection($resultadoAprendizajes);
    }

    public function store(StoreResultadoAprendizajeRequest $request, ModuloFormativo $moduloFormativo)
    {
        $data = $request->validated();
        $data['modulo_formativo_id'] = $moduloFormativo->id; // Asignar el ID del módulo formativo
        $resultadoAprendizaje = ResultadoAprendizaje::create($data);

        // Cargar relaciones para la respuesta
        $resultadoAprendizaje->load($this->getEagerLoadRelations());

        return new ResultadoAprendizajeResource($resultadoAprendizaje);
    }

    public function show(ModuloFormativo $moduloFormativo, ResultadoAprendizaje $resultadoAprendizaje)
    {
        if( $resultadoAprendizaje->modulo_formativo_id !== $moduloFormativo->id) {
            return response()->json(['message' => 'Resultado de aprendizaje no encontrado en este módulo formativo'], 404);
        }

        // Cargar relaciones
        $resultadoAprendizaje->load($this->getEagerLoadRelations());

        return new ResultadoAprendizajeResource($resultadoAprendizaje);
    }

    public function update(UpdateResultadoAprendizajeRequest $request, ModuloFormativo $moduloFormativo, ResultadoAprendizaje $resultadoAprendizaje)
    {
        if( $resultadoAprendizaje->modulo_formativo_id !== $moduloFormativo->id) {
            return response()->json(['message' => 'Resultado de aprendizaje no encontrado en este módulo formativo'], 404);
        }

        $resultadoAprendizaje->update($request->validated());

        // Cargar relaciones para la respuesta
        $resultadoAprendizaje->load($this->getEagerLoadRelations());

        return new ResultadoAprendizajeResource($resultadoAprendizaje);
    }

    public function destroy(ModuloFormativo $moduloFormativo, ResultadoAprendizaje $resultadoAprendizaje)
    {
        if( $resultadoAprendizaje->modulo_formativo_id !== $moduloFormativo->id) {
            return response()->json(['message' => 'Resultado de aprendizaje no encontrado en este módulo formativo'], 404);
        }

        $resultadoAprendizaje->delete();

        return response()->json([
            'message' => 'ResultadoAprendizaje eliminado correctamente'
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
