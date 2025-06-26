<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserRol;
use App\Http\Requests\StoreUserRolRequest;
use App\Http\Requests\UpdateUserRolRequest;
use App\Http\Resources\UserRolResource;
use Illuminate\Http\Request;
use App\Models\Rol;


/**
 * @OA\Tag(
 *     name="UserRol",
 *     description="Operations related to UserRol"
 * )
 */

/**
 * @OA\Get(
 *     path="/modulos-formativos/{parent_id}/user-roles",
 *     tags={"UserRol"},
 *     summary="List all userrols",
 *     description="Retrieve a paginated list of userrols",
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
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/UserRol")),
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
 *     path="/modulos-formativos/{parent_id}/user-roles",
 *     tags={"UserRol"},
 *     summary="Create a new userrol",
 *     description="Create a new userrol resource",
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
 *         @OA\JsonContent(ref="#/components/schemas/StoreUserRolRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Resource created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/UserRol")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Get(
 *     path="/modulos-formativos/{parent_id}/user-roles/{id}",
 *     tags={"UserRol"},
 *     summary="Show a specific userrol",
 *     description="Retrieve a specific userrol by ID",
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
 *         description="ID of the userrol",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/UserRol")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Put(
 *     path="/modulos-formativos/{parent_id}/user-roles/{id}",
 *     tags={"UserRol"},
 *     summary="Update a specific userrol",
 *     description="Update a specific userrol by ID",
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
 *         description="ID of the userrol",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateUserRolRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Resource updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/UserRol")
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
 *     path="/modulos-formativos/{parent_id}/user-roles/{id}",
 *     tags={"UserRol"},
 *     summary="Delete a specific userrol",
 *     description="Delete a specific userrol by ID",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID
 
 
 
  *         description="Resource deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="UserRol eliminado correctamente")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

class UserRolController extends Controller
{
    public function index(Request $request, Rol $rol)
    {
        $query = $rol->userRols();


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
        $userRols = $query->paginate($perPage);
        
        return UserRolResource::collection($userRols);
    }

    public function store(StoreUserRolRequest $request, Rol $rol)
    {
        $data = $request->validated();
        $data['role_id'] = $rol->id;
        
        $userRol = UserRol::create($data);
        
        // Cargar relaciones para la respuesta
        $userRol->load($this->getEagerLoadRelations());
        
        return new UserRolResource($userRol);
    }

    public function show(Rol $rol, UserRol $userRol)
    {
        // Verificar que el userRol pertenece al rol
        if ($userRol->role_id !== $rol->id) {
            abort(404);
        }
        
        // Cargar relaciones
        $userRol->load($this->getEagerLoadRelations());
        
        return new UserRolResource($userRol);
    }

    public function update(UpdateUserRolRequest $request, Rol $rol, UserRol $userRol)
    {
        // Verificar que el userRol pertenece al rol
        if ($userRol->role_id !== $rol->id) {
            abort(404);
        }
        
        $userRol->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $userRol->load($this->getEagerLoadRelations());
        
        return new UserRolResource($userRol);
    }

    public function destroy(Rol $rol, UserRol $userRol)
    {
        // Verificar que el userRol pertenece al rol
        if ($userRol->role_id !== $rol->id) {
            abort(404);
        }
        
        $userRol->delete();
        
        return response()->json([
            'message' => 'UserRol eliminado correctamente'
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
