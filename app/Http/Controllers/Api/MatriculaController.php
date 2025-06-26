<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Matricula;
use App\Http\Requests\StoreMatriculaRequest;
use App\Http\Requests\UpdateMatriculaRequest;
use App\Http\Resources\MatriculaResource;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index(Request $request)
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

    public function store(StoreMatriculaRequest $request)
    {
        $matricula = Matricula::create($request->validated());
        
        // Cargar relaciones para la respuesta
        $matricula->load($this->getEagerLoadRelations());
        
        return new MatriculaResource($matricula);
    }

    public function show(Matricula $matricula)
    {
        
        // Cargar relaciones
        $matricula->load($this->getEagerLoadRelations());
        
        return new MatriculaResource($matricula);
    }

    public function update(UpdateMatriculaRequest $request, Matricula $matricula)
    {
        
        $matricula->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $matricula->load($this->getEagerLoadRelations());
        
        return new MatriculaResource($matricula);
    }

    public function destroy(Matricula $matricula)
    {
        
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
