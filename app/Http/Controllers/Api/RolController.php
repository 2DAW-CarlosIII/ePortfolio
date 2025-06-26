<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Http\Requests\StoreRolRequest;
use App\Http\Requests\UpdateRolRequest;
use App\Http\Resources\RolResource;
use Illuminate\Http\Request;


/**
 * @OA\Tag(
 *     name="Rol",
 *     description="Operations related to Rol"
 * )
 */

/**
 * @OA\Get(
 *     path="/roles",
 *     tags={"Rol"},
 *     summary="List all rols",
 *     description="Retrieve a paginated list of rols",
 *     security={"sanctum":{}},
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
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Rol")),
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
 *     path="/roles",
 *     tags={"Rol"},
 *     summary="Create a new rol",
 *     description="Create a new rol resource",
 *     security={"sanctum":{}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/StoreRolRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Resource created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/Rol")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Get(
 *     path="/roles/{id}",
 *     tags={"Rol"},
 *     summary="Show a specific rol",
 *     description="Retrieve a specific rol by ID",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the rol",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/Rol")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Put(
 *     path="/roles/{id}",
 *     tags={"Rol"},
 *     summary="Update a specific rol",
 *     description="Update a specific rol by ID",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the rol",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateRolRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Resource updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/Rol")
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
 *     path="/roles/{id}",
 *     tags={"Rol"},
 *     summary="Delete a specific rol",
 *     description="Delete a specific rol by ID",
 *     security={"sanctum":{}},
class RolController extends Controller
{
    public function index(Request $request)
    {
        $query = Rol::query();


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
        $rols = $query->paginate($perPage);
        
        return RolResource::collection($rols);
    }

    public function store(StoreRolRequest $request)
    {
        $rol = Rol::create($request->validated());
        
        // Cargar relaciones para la respuesta
        $rol->load($this->getEagerLoadRelations());
        
        return new RolResource($rol);
    }

    public function show(Rol $rol)
    {
        
        // Cargar relaciones
        $rol->load($this->getEagerLoadRelations());
        
        return new RolResource($rol);
    }

    public function update(UpdateRolRequest $request, Rol $rol)
    {
        
        $rol->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $rol->load($this->getEagerLoadRelations());
        
        return new RolResource($rol);
    }

    public function destroy(Rol $rol)
    {
        
        $rol->delete();
        
        return response()->json([
            'message' => 'Rol eliminado correctamente'
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
