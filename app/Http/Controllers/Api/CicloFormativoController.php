<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CicloFormativo;
use App\Http\Requests\StoreCicloFormativoRequest;
use App\Http\Requests\UpdateCicloFormativoRequest;
use App\Http\Resources\CicloFormativoResource;
use App\Models\FamiliaProfesional;
use Illuminate\Http\Request;


/**
 * @OA\Tag(
 *     name="CicloFormativo",
 *     description="Operations related to CicloFormativo"
 * )
 */

class CicloFormativoController extends Controller
{

/**
 * @OA\Get(
 *     path="/familias-profesionales/{parent_id}/ciclos-formativos",
 *     tags={"CicloFormativo"},
 *     summary="List all cicloformativos",
 *     description="Retrieve a paginated list of cicloformativos",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent FamiliaProfesional",
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
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/CicloFormativo")),
 *             @OA\Property(property="links", type="object"),
 *             @OA\Property(property="meta", type="object")
 *         )
 *     ),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function index(Request $request, FamiliaProfesional $familiaProfesional)
    {
        $query = $familiaProfesional->ciclos_formativos()->newQuery();

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
        $cicloFormativos = $query->paginate($perPage);

        return CicloFormativoResource::collection($cicloFormativos);
    }

/**
 * @OA\Post(
 *     path="/familias-profesionales/{parent_id}/ciclos-formativos",
 *     tags={"CicloFormativo"},
 *     summary="Create a new cicloformativo",
 *     description="Create a new cicloformativo resource",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent FamiliaProfesional",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/StoreCicloFormativoRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Resource created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/CicloFormativo")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function store(StoreCicloFormativoRequest $request, FamiliaProfesional $familiaProfesional)
    {
        $cicloFormativo = $familiaProfesional->ciclos_formativos()->create($request->validated());

        // Cargar relaciones para la respuesta
        $cicloFormativo->load($this->getEagerLoadRelations());

        return new CicloFormativoResource($cicloFormativo);
    }

/**
 * @OA\Get(
 *     path="/familias-profesionales/{parent_id}/ciclos-formativos/{id}",
 *     tags={"CicloFormativo"},
 *     summary="Show a specific cicloformativo",
 *     description="Retrieve a specific cicloformativo by ID",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent FamiliaProfesional",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the cicloformativo",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/CicloFormativo")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function show(FamiliaProfesional $familiaProfesional, CicloFormativo $cicloFormativo)
    {
        // Verificar que el ciclo formativo pertenece a la familia profesional
        if ($cicloFormativo->familia_profesional_id !== $familiaProfesional->id) {
            abort(404);
        }

        // Cargar relaciones
        $cicloFormativo->load($this->getEagerLoadRelations());

        return new CicloFormativoResource($cicloFormativo);
    }

/**
 * @OA\Put(
 *     path="/familias-profesionales/{parent_id}/ciclos-formativos/{id}",
 *     tags={"CicloFormativo"},
 *     summary="Update a specific cicloformativo",
 *     description="Update a specific cicloformativo by ID",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent FamiliaProfesional",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the cicloformativo",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateCicloFormativoRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Resource updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/CicloFormativo")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function update(UpdateCicloFormativoRequest $request, FamiliaProfesional $familiaProfesional, CicloFormativo $cicloFormativo)
    {
        // Verificar que el ciclo formativo pertenece a la familia profesional
        if ($cicloFormativo->familia_profesional_id !== $familiaProfesional->id) {
            abort(404);
        }

        $cicloFormativo->update($request->validated());

        // Cargar relaciones para la respuesta
        $cicloFormativo->load($this->getEagerLoadRelations());

        return new CicloFormativoResource($cicloFormativo);
    }

/**
 * @OA\Delete(
 *     path="/familias-profesionales/{parent_id}/ciclos-formativos/{id}",
 *     tags={"CicloFormativo"},
 *     summary="Delete a specific cicloformativo",
 *     description="Delete a specific cicloformativo by ID",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the parent familias-profesionales",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the Ciclo Formativo",
 *      required=true,
 *      @OA\Schema(type="integer")
 *   ),
 *    @OA\Response(
 *        response=204,
 *         description="Resource deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="CicloFormativo eliminado correctamente")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

    public function destroy(FamiliaProfesional $familiaProfesional, CicloFormativo $cicloFormativo)
    {
        // Verificar que el ciclo formativo pertenece a la familia profesional
        if ($cicloFormativo->familia_profesional_id !== $familiaProfesional->id) {
            abort(404);
        }

        $cicloFormativo->delete();

        return response()->json([
            'message' => 'CicloFormativo eliminado correctamente'
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
