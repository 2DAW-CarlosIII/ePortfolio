<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evidencia;
use App\Http\Requests\StoreEvidenciaRequest;
use App\Http\Requests\UpdateEvidenciaRequest;
use App\Http\Resources\EvidenciaResource;
use App\Models\Tarea;
use Illuminate\Http\Request;


/**
 * @OA\Tag(
 *     name="Evidencia",
 *     description="Operations related to Evidencia"
 * )
 */

class EvidenciaController extends Controller
{

/**
 * @OA\Get(
 *     path="/tareas/{parent_id}/evidencias",
 *     tags={"Evidencia"},
 *     summary="List all evidencias",
 *     description="Retrieve a paginated list of evidencias",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent Tarea",
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
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Evidencia")),
 *             @OA\Property(property="links", type="object"),
 *             @OA\Property(property="meta", type="object")
 *         )
 *     ),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function index(Request $request, Tarea $tarea)
    {
        $query = $tarea->evidencias()->newQuery();

        // Filtro de búsqueda
        if ($request->has('search') && $request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('descripcion', 'like', "%$search%");
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
        $evidencias = $query->paginate($perPage);

        return EvidenciaResource::collection($evidencias);
    }

/**
 * @OA\Post(
 *     path="/tareas/{parent_id}/evidencias",
 *     tags={"Evidencia"},
 *     summary="Create a new evidencia",
 *     description="Create a new evidencia resource",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent Tarea",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/StoreEvidenciaRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Resource created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/Evidencia")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function store(StoreEvidenciaRequest $request, Tarea $tarea)
    {
        $data = $request->validated();
        $data['tarea_id'] = $tarea->id;
        $data['estudiante_id'] = auth()->id(); // Asignar el usuario autenticado

        $evidencia = Evidencia::create($data);

        // Cargar relaciones para la respuesta
        $evidencia->load($this->getEagerLoadRelations());

        return new EvidenciaResource($evidencia);
    }

/**
 * @OA\Get(
 *     path="/tareas/{parent_id}/evidencias/{id}",
 *     tags={"Evidencia"},
 *     summary="Show a specific evidencia",
 *     description="Retrieve a specific evidencia by ID",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent Tarea",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the evidencia",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/Evidencia")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function show(Tarea $tarea, Evidencia $evidencia)
    {
        if( $evidencia->tarea_id !== $tarea->id) {
            return response()->json(['message' => 'Evidencia no encontrada'], 404);
        }

        // Cargar relaciones
        $evidencia->load($this->getEagerLoadRelations());

        return new EvidenciaResource($evidencia);
    }

/**
 * @OA\Put(
 *     path="/tareas/{parent_id}/evidencias/{id}",
 *     tags={"Evidencia"},
 *     summary="Update a specific evidencia",
 *     description="Update a specific evidencia by ID",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent Tarea",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the evidencia",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateEvidenciaRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Resource updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/Evidencia")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function update(UpdateEvidenciaRequest $request, Tarea $tarea, Evidencia $evidencia)
    {
        if( $evidencia->tarea_id !== $tarea->id) {
            return response()->json(['message' => 'Evidencia no encontrada'], 404);
        }

        $evidencia->update($request->validated());

        // Cargar relaciones para la respuesta
        $evidencia->load($this->getEagerLoadRelations());

        return new EvidenciaResource($evidencia);
    }

/**
 * @OA\Delete(
 *     path="/tareas/{parent_id}/evidencias/{id}",
 *     tags={"Evidencia"},
 *     summary="Delete a specific evidencia",
 *     description="Delete a specific evidencia by ID",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the tarea",
 *      required=true,
 *      @OA\Schema(type="integer")
 *   ),
 *    @OA\Response(
 *        response=204,
 *       description="Resource deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Evidencia eliminado correctamente")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function destroy(Tarea $tarea, Evidencia $evidencia)
    {
        if( $evidencia->tarea_id !== $tarea->id) {
            return response()->json(['message' => 'Evidencia no encontrada'], 404);
        }

        $evidencia->delete();

        return response()->json([
            'message' => 'Evidencia eliminado correctamente'
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
