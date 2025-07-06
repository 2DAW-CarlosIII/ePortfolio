<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comentario;
use App\Http\Requests\StoreComentarioRequest;
use App\Http\Requests\UpdateComentarioRequest;
use App\Http\Resources\ComentarioResource;
use Illuminate\Http\Request;
use App\Models\Evidencia;


/**
 * @OA\Tag(
 *     name="Comentario",
 *     description="Operations related to Comentario"
 * )
 */

class ComentarioController extends Controller
{

/**
 * @OA\Get(
 *     path="/evidencias/{parent_id}/comentarios",
 *     tags={"Comentario"},
 *     summary="List all comentarios",
 *     description="Retrieve a paginated list of comentarios",
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
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Comentario")),
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
        $query = $evidencia->comentarios()->newQuery();

        // Filtro de búsqueda
        if ($request->has('search') && $request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('contenido', 'like', "%$search%");
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
        $comentarios = $query->paginate($perPage);

        return ComentarioResource::collection($comentarios);
    }

/**
 * @OA\Post(
 *     path="/evidencias/{parent_id}/comentarios",
 *     tags={"Comentario"},
 *     summary="Create a new comentario",
 *     description="Create a new comentario resource",
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
 *         @OA\JsonContent(ref="#/components/schemas/StoreComentarioRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Resource created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/Comentario")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function store(StoreComentarioRequest $request, Evidencia $evidencia)
    {
        $data = $request->validated();

        $data['evidencia_id'] = $evidencia->id; // de la ruta anidada
        $data['user_id'] = auth()->id(); // usuario autenticado

        $comentario = Comentario::create($data);

        // Cargar relaciones para la respuesta
        $comentario->load($this->getEagerLoadRelations());

        return new ComentarioResource($comentario);
    }

/**
 * @OA\Get(
 *     path="/evidencias/{parent_id}/comentarios/{id}",
 *     tags={"Comentario"},
 *     summary="Show a specific comentario",
 *     description="Retrieve a specific comentario by ID",
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
 *         description="ID of the comentario",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/Comentario")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function show(Evidencia $evidencia, Comentario $comentario)
    {
        // Verificar que el comentario pertenece al evidencia
        if ($comentario->evidencia_id !== $evidencia->id) {
            abort(404);
        }

        // Cargar relaciones
        $comentario->load($this->getEagerLoadRelations());

        return new ComentarioResource($comentario);
    }

/**
 * @OA\Put(
 *     path="/evidencias/{parent_id}/comentarios/{id}",
 *     tags={"Comentario"},
 *     summary="Update a specific comentario",
 *     description="Update a specific comentario by ID",
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
 *         description="ID of the comentario",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateComentarioRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Resource updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/Comentario")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function update(UpdateComentarioRequest $request, Evidencia $evidencia, Comentario $comentario)
    {
        // Verificar que el comentario pertenece al evidencia
        if ($comentario->evidencia_id !== $evidencia->id) {
            abort(404);
        }

        $comentario->update($request->validated());

        // Cargar relaciones para la respuesta
        $comentario->load($this->getEagerLoadRelations());

        return new ComentarioResource($comentario);
    }

/**
 * @OA\Delete(
 *     path="/evidencias/{parent_id}/comentarios/{id}",
 *     tags={"Comentario"},
 *     summary="Delete a specific comentario",
 *     description="Delete a specific comentario by ID",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent evidencias",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the comentario",
 *      required=true,
 *      @OA\Schema(type="integer")
 *   ),
 *    @OA\Response(
 *        response=204,
 *         description="Resource deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Comentario eliminado correctamente")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function destroy(Evidencia $evidencia, Comentario $comentario)
    {
        // Verificar que el comentario pertenece al evidencia
        if ($comentario->evidencia_id !== $evidencia->id) {
            abort(404);
        }

        $comentario->delete();

        return response()->json([
            'message' => 'Comentario eliminado correctamente'
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
