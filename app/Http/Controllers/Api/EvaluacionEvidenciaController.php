<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EvaluacionEvidencia;
use App\Http\Requests\StoreEvaluacionEvidenciaRequest;
use App\Http\Requests\UpdateEvaluacionEvidenciaRequest;
use App\Http\Resources\EvaluacionEvidenciaResource;
use Illuminate\Http\Request;
use App\Models\Evidencia;


/**
 * @OA\Tag(
 *     name="EvaluacionEvidencia",
 *     description="Operations related to EvaluacionEvidencia"
 * )
 */

class EvaluacionEvidenciaController extends Controller
{

/**
 * @OA\Get(
 *     path="/users/{parent_id}/evaluaciones-evidencias",
 *     tags={"EvaluacionEvidencia"},
 *     summary="List all evaluacionevidencias",
 *     description="Retrieve a paginated list of evaluacionevidencias",
 *     security={{"sanctum":{}}},
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
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/EvaluacionEvidencia")),
 *             @OA\Property(property="links", type="object"),
 *             @OA\Property(property="meta", type="object")
 *         )
 *     ),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function index(Request $request, Evidencia $evidencia)
    {
        $query = $evidencia->evaluaciones()->newQuery();

        // Filtro de búsqueda
        if ($request->has('search') && $request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('puntuacion', 'like', "%$search%")
                ->orWhere('observaciones', 'like', "%$search%")
                ->orWhere('estado', 'like', "%$search%");
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
        $evaluacionEvidencias = $query->paginate($perPage);

        return EvaluacionEvidenciaResource::collection($evaluacionEvidencias);
    }

/**
 * @OA\Post(
 *     path="/users/{parent_id}/evaluaciones-evidencias",
 *     tags={"EvaluacionEvidencia"},
 *     summary="Create a new evaluacionevidencia",
 *     description="Create a new evaluacionevidencia resource",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent User",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/StoreEvaluacionEvidenciaRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Resource created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/EvaluacionEvidencia")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function store(StoreEvaluacionEvidenciaRequest $request, Evidencia $evidencia)
    {
        $data = $request->validated();
        $data['evidencia_id'] = $evidencia->id;
        $data['user_id'] = auth()->id(); // Asignar el usuario autenticado

        $evaluacionEvidencia = EvaluacionEvidencia::create($data);

        // Cargar relaciones para la respuesta
        $evaluacionEvidencia->load($this->getEagerLoadRelations());

        return new EvaluacionEvidenciaResource($evaluacionEvidencia);
    }

/**
 * @OA\Get(
 *     path="/users/{parent_id}/evaluaciones-evidencias/{id}",
 *     tags={"EvaluacionEvidencia"},
 *     summary="Show a specific evaluacionevidencia",
 *     description="Retrieve a specific evaluacionevidencia by ID",
 *     security={{"sanctum":{}}},
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
 *         description="ID of the evaluacionevidencia",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/EvaluacionEvidencia")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function show(Evidencia $evidencia, EvaluacionEvidencia $evaluacionEvidencia)
    {
        // Verificar que el evaluacionEvidencia pertenece al evidencia
        if ($evaluacionEvidencia->evidencia_id !== $evidencia->id) {
            abort(404);
        }

        // Cargar relaciones
        $evaluacionEvidencia->load($this->getEagerLoadRelations());

        return new EvaluacionEvidenciaResource($evaluacionEvidencia);
    }

/**
 * @OA\Put(
 *     path="/users/{parent_id}/evaluaciones-evidencias/{id}",
 *     tags={"EvaluacionEvidencia"},
 *     summary="Update a specific evaluacionevidencia",
 *     description="Update a specific evaluacionevidencia by ID",
 *     security={{"sanctum":{}}},
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
 *         description="ID of the evaluacionevidencia",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateEvaluacionEvidenciaRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Resource updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/EvaluacionEvidencia")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function update(UpdateEvaluacionEvidenciaRequest $request, Evidencia $evidencia, EvaluacionEvidencia $evaluacionEvidencia)
    {
        // Verificar que el evaluacionEvidencia pertenece al evidencia
        if ($evaluacionEvidencia->evidencia_id !== $evidencia->id) {
            abort(404);
        }

        $evaluacionEvidencia->update($request->validated());

        // Cargar relaciones para la respuesta
        $evaluacionEvidencia->load($this->getEagerLoadRelations());

        return new EvaluacionEvidenciaResource($evaluacionEvidencia);
    }

/**
 * @OA\Delete(
 *     path="/users/{parent_id}/evaluaciones-evidencias/{id}",
 *     tags={"EvaluacionEvidencia"},
 *     summary="Delete a specific evaluacionevidencia",
 *     description="Delete a specific evaluacionevidencia by ID",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the evidencia",
 *      required=true,
 *      @OA\Schema(type="integer")
 *   ),
 *    @OA\Response(
 *        response=204,
 *       description="Resource deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="EvaluacionEvidencia eliminado correctamente")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function destroy(Evidencia $evidencia, EvaluacionEvidencia $evaluacionEvidencia)
    {
        // Verificar que el evaluacionEvidencia pertenece al evidencia
        if ($evaluacionEvidencia->evidencia_id !== $evidencia->id) {
            abort(404);
        }

        $evaluacionEvidencia->delete();

        return response()->json([
            'message' => 'EvaluacionEvidencia eliminado correctamente'
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
