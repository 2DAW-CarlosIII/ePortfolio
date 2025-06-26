<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ComentarioPar;
use App\Http\Requests\StoreComentarioParRequest;
use App\Http\Requests\UpdateComentarioParRequest;
use App\Http\Resources\ComentarioParResource;
use Illuminate\Http\Request;


/**
 * @OA\Tag(
 *     name="ComentarioPar",
 *     description="Operations related to ComentarioPar"
 * )
 */

/**
 * @OA\Get(
 *     path="/users/{parent_id}/comentarios-pares",
 *     tags={"ComentarioPar"},
 *     summary="List all comentariopars",
 *     description="Retrieve a paginated list of comentariopars",
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
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/ComentarioPar")),
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
 *     path="/users/{parent_id}/comentarios-pares",
 *     tags={"ComentarioPar"},
 *     summary="Create a new comentariopar",
 *     description="Create a new comentariopar resource",
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
 *         @OA\JsonContent(ref="#/components/schemas/StoreComentarioParRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Resource created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/ComentarioPar")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Get(
 *     path="/users/{parent_id}/comentarios-pares/{id}",
 *     tags={"ComentarioPar"},
 *     summary="Show a specific comentariopar",
 *     description="Retrieve a specific comentariopar by ID",
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
 *         description="ID of the comentariopar",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/ComentarioPar")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Put(
 *     path="/users/{parent_id}/comentarios-pares/{id}",
 *     tags={"ComentarioPar"},
 *     summary="Update a specific comentariopar",
 *     description="Update a specific comentariopar by ID",
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
 *         description="ID of the comentariopar",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateComentarioParRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Resource updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/ComentarioPar")
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
 *     path="/users/{parent_id}/comentarios-pares/{id}",
 *     tags={"ComentarioPar"},
 *     summary="Delete a specific comentariopar",
 *     description="Delete a specific comentariopar by ID",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID
 
 
 
  *         description="Resource deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="ComentarioPar eliminado correctamente")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

class ComentarioParController extends Controller
{
    public function index(Request $request)
    {
        $query = ComentarioPar::query();


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
        $comentarioPars = $query->paginate($perPage);
        
        return ComentarioParResource::collection($comentarioPars);
    }

    public function store(StoreComentarioParRequest $request)
    {
        $comentarioPar = ComentarioPar::create($request->validated());
        
        // Cargar relaciones para la respuesta
        $comentarioPar->load($this->getEagerLoadRelations());
        
        return new ComentarioParResource($comentarioPar);
    }

    public function show(ComentarioPar $comentarioPar)
    {
        
        // Cargar relaciones
        $comentarioPar->load($this->getEagerLoadRelations());
        
        return new ComentarioParResource($comentarioPar);
    }

    public function update(UpdateComentarioParRequest $request, ComentarioPar $comentarioPar)
    {
        
        $comentarioPar->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $comentarioPar->load($this->getEagerLoadRelations());
        
        return new ComentarioParResource($comentarioPar);
    }

    public function destroy(ComentarioPar $comentarioPar)
    {
        
        $comentarioPar->delete();
        
        return response()->json([
            'message' => 'ComentarioPar eliminado correctamente'
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
