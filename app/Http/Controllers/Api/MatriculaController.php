<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Matricula;
use App\Http\Requests\StoreMatriculaRequest;
use App\Http\Requests\UpdateMatriculaRequest;
use App\Http\Resources\MatriculaResource;
use App\Models\ModuloFormativo;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;

/**
 * @OA\Tag(
 *     name="Matricula",
 *     description="Operations related to Matricula"
 * )
 */

/**
 * @OA\Get(
 *     path="/modulos-formativos/{parent_id}/matriculas",
 *     tags={"Matricula"},
 *     summary="List all matriculas",
 *     description="Retrieve a paginated list of matriculas",
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
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Matricula")),
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
 *     path="/modulos-formativos/{parent_id}/matriculas",
 *     tags={"Matricula"},
 *     summary="Create a new matricula",
 *     description="Create a new matricula resource",
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
 *         @OA\JsonContent(ref="#/components/schemas/StoreMatriculaRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Resource created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/Matricula")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation errors"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Get(
 *     path="/modulos-formativos/{parent_id}/matriculas/{id}",
 *     tags={"Matricula"},
 *     summary="Show a specific matricula",
 *     description="Retrieve a specific matricula by ID",
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
 *         description="ID of the matricula",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/Matricula")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

/**
 * @OA\Put(
 *     path="/modulos-formativos/{parent_id}/matriculas/{id}",
 *     tags={"Matricula"},
 *     summary="Update a specific matricula",
 *     description="Update a specific matricula by ID",
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
 *         description="ID of the matricula",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateMatriculaRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Resource updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", ref="#/components/schemas/Matricula")
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
 *     path="/modulos-formativos/{parent_id}/matriculas/{id}",
 *     tags={"Matricula"},
 *     summary="Delete a specific matricula",
 *     description="Delete a specific matricula by ID",
 *     security={"sanctum":{}},
 *     @OA\Parameter(
 *         name="parent_id",
 *         in="path",
 *         description="ID of the módulo formativo",
 *         required=true,
 *         @OA\Schema(type="integer")
 *   ),
 *    @OA\Response(
 *        response=204,
 *       description="Resource deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Matricula eliminado correctamente")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Resource not found"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Forbidden")
 * )
 */

class MatriculaController extends Controller
{
    public function index(Request $request, ModuloFormativo $moduloFormativo)
    {
        $query = Matricula::query();


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
        $matriculas = $query->paginate($perPage);

        return MatriculaResource::collection($matriculas);
    }

    public function store(StoreMatriculaRequest $request, ModuloFormativo $moduloFormativo)
    {
        $data= $request->validated();
        $data['modulo_formativo_id'] = $moduloFormativo->id;
        $data['estudiante_id'] = $request->user()->id; // Asignar el ID del usuario autenticado como estudiante

        $matricula = Matricula::create($data);

        // Cargar relaciones para la respuesta
        $matricula->load($this->getEagerLoadRelations());

        return new MatriculaResource($matricula);
    }

    public function show(ModuloFormativo $moduloFormativo, Matricula $matricula)
    {

        if ($matricula->modulo_formativo_id !== $moduloFormativo->id) {
            return response()->json(['message' => 'Matricula not found'], 404);
        }

        // Cargar relaciones
        $matricula->load($this->getEagerLoadRelations());

        return new MatriculaResource($matricula);
    }

    public function update(UpdateMatriculaRequest $request, ModuloFormativo $moduloFormativo, Matricula $matricula)
    {

        if ($matricula->modulo_formativo_id !== $moduloFormativo->id) {
            return response()->json(['message' => 'Matricula not found'], 404);
        }

        $matricula->update($request->validated());

        // Cargar relaciones para la respuesta
        $matricula->load($this->getEagerLoadRelations());

        return new MatriculaResource($matricula);
    }

    public function destroy(ModuloFormativo $moduloFormativo, Matricula $matricula)
    {

        if ($matricula->modulo_formativo_id !== $moduloFormativo->id) {
            return response()->json(['message' => 'Matricula not found'], 404);
        }

        $matricula->delete();

        return response()->json([
            'message' => 'Matricula eliminado correctamente'
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
