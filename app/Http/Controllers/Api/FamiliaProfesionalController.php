<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FamiliaProfesional;
use App\Http\Requests\StoreFamiliaProfesionalRequest;
use App\Http\Requests\UpdateFamiliaProfesionalRequest;
use App\Http\Resources\FamiliaProfesionalResource;
use Illuminate\Http\Request;


/**
 * @OA\Tag(
 *     name="FamiliaProfesional",
 *     description="Operations related to FamiliaProfesional"
 * )
 */

class FamiliaProfesionalController extends Controller
{

/**
 * @OA\Get(
 *     path="/familias-profesionales",
 *     tags={"FamiliaProfesional"},
 *     summary="List all familiaprofesionals",
 *     description="Retrieve a paginated list of familiaprofesionals",
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
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/FamiliaProfesional")),
 *             @OA\Property(property="links", type="object"),
 *             @OA\Property(property="meta", type="object")
 *         )
 *     ),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function index(Request $request)
    {
        $query = FamiliaProfesional::query();

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
        $familiaProfesionals = $query->paginate($perPage);

        return FamiliaProfesionalResource::collection($familiaProfesionals);
    }

/**
 * @OA\Post(
 *     path="/familias-profesionales",
 *     tags={"FamiliaProfesional"},
 *     summary="Create a new familiaprofesional",
 *     description="Create a new familiaprofesional resource",
 *     security={"sanctum":{}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/StoreFamiliaProfesionalRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Resource created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/FamiliaProfesional")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function store(StoreFamiliaProfesionalRequest $request)
    {
        $familiaProfesional = FamiliaProfesional::create($request->validated());

        // Cargar relaciones para la respuesta
        $familiaProfesional->load($this->getEagerLoadRelations());

        return new FamiliaProfesionalResource($familiaProfesional);
    }

/**
 * @OA\Get(
 *     path="/familias-profesionales/{id}",
 *     tags={"FamiliaProfesional"},
 *     summary="Show a specific familiaprofesional",
 *     description="Retrieve a specific familiaprofesional by ID",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the familiaprofesional",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/FamiliaProfesional")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function show(FamiliaProfesional $familiaProfesional)
    {

        // Cargar relaciones
        $familiaProfesional->load($this->getEagerLoadRelations());

        return new FamiliaProfesionalResource($familiaProfesional);
    }

/**
 * @OA\Put(
 *     path="/familias-profesionales/{id}",
 *     tags={"FamiliaProfesional"},
 *     summary="Update a specific familiaprofesional",
 *     description="Update a specific familiaprofesional by ID",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the familiaprofesional",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateFamiliaProfesionalRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Resource updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/FamiliaProfesional")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function update(UpdateFamiliaProfesionalRequest $request, FamiliaProfesional $familiaProfesional)
    {

        $familiaProfesional->update($request->validated());

        // Cargar relaciones para la respuesta
        $familiaProfesional->load($this->getEagerLoadRelations());

        return new FamiliaProfesionalResource($familiaProfesional);
    }

/**
 * @OA\Delete(
 *     path="/familias-profesionales/{id}",
 *     tags={"FamiliaProfesional"},
 *     summary="Delete a specific familiaprofesional",
 *     description="Delete a specific familiaprofesional by ID",
 *     security={"sanctum":{}},
 *    @OA\Parameter(
 *        name="id",
 *       in="path",
 *      description="ID of the familiaprofesional",
 *      required=true,
 *      @OA\Schema(type="integer")
 *   ),
 *    @OA\Response(
 *        response=204,
 *       description="Resource deleted successfully"
 * *   ),
 *   @OA\Response(response=404, description="Resource not found"),
 *  @OA\Response(response=401, description="Unauthenticated"),
 * @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function destroy(FamiliaProfesional $familiaProfesional)
    {

        $familiaProfesional->delete();

        return response()->json([
            'message' => 'FamiliaProfesional eliminado correctamente'
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
