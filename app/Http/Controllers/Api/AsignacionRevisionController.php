<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AsignacionRevision;
use App\Http\Requests\StoreAsignacionRevisionRequest;
use App\Http\Requests\UpdateAsignacionRevisionRequest;
use App\Http\Resources\AsignacionRevisionResource;
use Illuminate\Http\Request;
use App\Models\Evidencia;


/**
 * @OA\Tag(
 *     name="AsignacionRevision",
 *     description="Operations related to AsignacionRevision"
 * )
 */

/**
 * @OA\Get(
 *     path="/evidencias/{parent_id}/asignaciones-revision",
 *     tags={"AsignacionRevision"},
 *     summary="List all asignacionrevisions",
 *     description="Retrieve a paginated list of asignacionrevisions",
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
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/AsignacionRevision")),
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
 *     path="/evidencias/{parent_id}/asignaciones-revision",
 *     tags={"AsignacionRevision"},
 *     summary="Create a new asignacionrevision",
 *     description="Create a new asignacionrevision resource",
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
 *         @OA\JsonContent(ref="#/components/schemas/StoreAsignacionRevisionRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Resource created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/AsignacionRevision")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Get(
 *     path="/evidencias/{parent_id}/asignaciones-revision/{id}",
 *     tags={"AsignacionRevision"},
 *     summary="Show a specific asignacionrevision",
 *     description="Retrieve a specific asignacionrevision by ID",
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
 *         description="ID of the asignacionrevision",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/AsignacionRevision")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Put(
 *     path="/evidencias/{parent_id}/asignaciones-revision/{id}",
 *     tags={"AsignacionRevision"},
 *     summary="Update a specific asignacionrevision",
 *     description="Update a specific asignacionrevision by ID",
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
 *         description="ID of the asignacionrevision",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateAsignacionRevisionRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Resource updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/AsignacionRevision")
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
 *     path="/evidencias/{parent_id}/asignaciones-revision/{id}",
 *     tags={"AsignacionRevision"},
 *     summary="Delete a specific asignacionrevision",
 *     description="Delete a specific asignacionrevision by ID",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent evidencias",
 *         required=true,
 *         @OA\\Schema(type="integer")
 *     ),
 *     @OA\\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the {model_name}",
 *      required=true,
 *      @OA\Schema(type="integer")
 *   ),
 *    @OA\Response(
 *        response=204,
 *         description="Resource deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="AsignacionRevision eliminado correctamente")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

class AsignacionRevisionController extends Controller
{
    public function index(Request $request, Evidencia $evidencia)
    {
        $query = $evidencia->asignacionRevision();


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
        $asignacionRevisions = $query->paginate($perPage);

        return AsignacionRevisionResource::collection($asignacionRevisions);
    }

    public function store(StoreAsignacionRevisionRequest $request, Evidencia $evidencia)
    {
        $data = $request->validated();

        $data['evidencia_id'] = $evidencia->id; // de la ruta anidada
        $data['asignado_por_id'] = auth()->id(); // usuario autenticado

        $asignacionRevision = AsignacionRevision::create($data);

        // Cargar relaciones para la respuesta
        $asignacionRevision->load($this->getEagerLoadRelations());

        return new AsignacionRevisionResource($asignacionRevision);
    }

    public function show(Evidencia $evidencia, AsignacionRevision $asignacionRevision)
    {
        // Verificar que el asignacionRevision pertenece al evidencia
        if ($asignacionRevision->evidencia_id !== $evidencia->id) {
            abort(404);
        }

        // Cargar relaciones
        $asignacionRevision->load($this->getEagerLoadRelations());

        return new AsignacionRevisionResource($asignacionRevision);
    }

    public function update(UpdateAsignacionRevisionRequest $request, Evidencia $evidencia, AsignacionRevision $asignacionRevision)
    {
        // Verificar que el asignacionRevision pertenece al evidencia
        if ($asignacionRevision->evidencia_id !== $evidencia->id) {
            abort(404);
        }

        $asignacionRevision->update($request->validated());

        // Cargar relaciones para la respuesta
        $asignacionRevision->load($this->getEagerLoadRelations());

        return new AsignacionRevisionResource($asignacionRevision);
    }

    public function destroy(Evidencia $evidencia, AsignacionRevision $asignacionRevision)
    {
        // Verificar que el asignacionRevision pertenece al evidencia
        if ($asignacionRevision->evidencia_id !== $evidencia->id) {
            abort(404);
        }

        $asignacionRevision->delete();

        return response()->json([
            'message' => 'AsignacionRevision eliminado correctamente'
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
