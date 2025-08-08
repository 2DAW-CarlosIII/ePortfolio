<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ModuloFormativo;
use App\Http\Requests\StoreModuloFormativoRequest;
use App\Http\Requests\UpdateModuloFormativoRequest;
use App\Http\Resources\ModuloFormativoResource;
use App\Models\CicloFormativo;
use Illuminate\Http\Request;


/**
 * @OA\Tag(
 *     name="ModuloFormativo",
 *     description="Operations related to ModuloFormativo"
 * )
 */

class ModuloFormativoController extends Controller
{

/**
 * @OA\Get(
 *     path="/ciclos-formativos/{parent_id}/modulos-formativos",
 *     tags={"ModuloFormativo"},
 *     summary="List all modulos formativos of a ciclo formativo",
 *     description="Retrieve a paginated list of modulos formativos of a specific ciclo formativo",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent CicloFormativo",
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
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/ModuloFormativo")),
 *             @OA\Property(property="links", type="object"),
 *             @OA\Property(property="meta", type="object")
 *         )
 *     ),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function index(Request $request, CicloFormativo $cicloFormativo)
    {
        $query = $cicloFormativo->modulos_formativos()->newQuery();

        // Filtro de búsqueda
        if ($request->has('search') && $request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%$search%")->orWhere('codigo', 'like', "%$search%")->orWhere('descripcion', 'like', "%$search%");
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
        $moduloFormativos = $query->paginate($perPage);

        return ModuloFormativoResource::collection($moduloFormativos);
    }

/**
 * @OA\Get(
 *     path="/modulos-impartidos",
 *     tags={"ModuloFormativo"},
 *     summary="Listar módulos en los que el usuario autenticado imparte docencia",
 *     description="Devuelve una colección de módulos formativos en los que el usuario autenticado imparte docencia.",
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de módulos impartidos por el usuario autenticado",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(ref="#/components/schemas/ModuloFormativo")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=401, description="Unauthenticated")
 * )
 */

    public function modulosImpartidos(Request $request)
    {
        $user = $request->user();

        // Obtener los módulos en los que el usuario imparte docencia
        $modulos = ModuloFormativo::where('docente_id', $user->id)->get();

        return ModuloFormativoResource::collection($modulos);
    }

/**
 * @OA\Post(
 *     path="/ciclos-formativos/{parent_id}/modulos-formativos",
 *     tags={"ModuloFormativo"},
 *     summary="Create a new moduloformativo of a ciclo formativo",
 *     description="Create a new moduloformativo resource of a specific ciclo formativo",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent CicloFormativo",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/StoreModuloFormativoRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Resource created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/ModuloFormativo")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function store(StoreModuloFormativoRequest $request, CicloFormativo $cicloFormativo)
    {
        $data = $request->validated();
        $data['ciclo_formativo_id'] = $cicloFormativo->id;
        $data['docente_id'] = auth()->id(); // Asignar el docente actual
        $moduloFormativo = ModuloFormativo::create($data);

        // Cargar relaciones para la respuesta
        $moduloFormativo->load($this->getEagerLoadRelations());

        return new ModuloFormativoResource($moduloFormativo);
    }

/**
 * @OA\Get(
 *     path="/ciclos-formativos/{parent_id}/modulos-formativos/{id}",
 *     tags={"ModuloFormativo"},
 *     summary="Show a specific moduloformativo",
 *     description="Retrieve a specific moduloformativo by ID",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent CicloFormativo",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the moduloformativo",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/ModuloFormativo")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function show(CicloFormativo $cicloFormativo, ModuloFormativo $moduloFormativo)
    {
        if($cicloFormativo->id !== $moduloFormativo->ciclo_formativo_id) {
            return response()->json(['message' => 'ModuloFormativo not found in the specified CicloFormativo'], 404);
        }

        // Cargar relaciones
        $moduloFormativo->load($this->getEagerLoadRelations());

        return new ModuloFormativoResource($moduloFormativo);
    }

/**
 * @OA\Put(
 *     path="/ciclos-formativos/{parent_id}/modulos-formativos/{id}",
 *     tags={"ModuloFormativo"},
 *     summary="Update a specific moduloformativo",
 *     description="Update a specific moduloformativo by ID",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent CicloFormativo",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the moduloformativo",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateModuloFormativoRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Resource updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/ModuloFormativo")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function update(UpdateModuloFormativoRequest $request, CicloFormativo $cicloFormativo, ModuloFormativo $moduloFormativo)
    {
        if($cicloFormativo->id !== $moduloFormativo->ciclo_formativo_id) {
            return response()->json(['message' => 'ModuloFormativo not found in the specified CicloFormativo'], 404);
        }

        $moduloFormativo->update($request->validated());

        // Cargar relaciones para la respuesta
        $moduloFormativo->load($this->getEagerLoadRelations());

        return new ModuloFormativoResource($moduloFormativo);
    }

/**
 * @OA\Delete(
 *     path="/ciclos-formativos/{parent_id}/modulos-formativos/{id}",
 *     tags={"ModuloFormativo"},
 *     summary="Delete a specific moduloformativo",
 *     description="Delete a specific moduloformativo by ID",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the ciclo formativo",
 *      required=true,
 *      @OA\Schema(type="integer")
 *   ),
 *    @OA\Response(
 *        response=204,
 *       description="Resource deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="ModuloFormativo eliminado correctamente")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function destroy(CicloFormativo $cicloFormativo, ModuloFormativo $moduloFormativo)
    {
        if($cicloFormativo->id !== $moduloFormativo->ciclo_formativo_id) {
            return response()->json(['message' => 'ModuloFormativo not found in the specified CicloFormativo'], 404);
        }

        $moduloFormativo->delete();

        return response()->json([
            'message' => 'ModuloFormativo eliminado correctamente'
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
