<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CriteriosEvaluacion;
use App\Http\Requests\StoreCriteriosEvaluacionRequest;
use App\Http\Requests\UpdateCriteriosEvaluacionRequest;
use App\Http\Resources\CriteriosEvaluacionResource;
use Illuminate\Http\Request;

class CriteriosEvaluacionController extends Controller
{
    public function index(Request $request)
    {
        $query = CriteriosEvaluacion::query();

        // Filtro de búsqueda
        if ($request->has('search') && $request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('codigo', 'like', "%$search%")->orWhere('descripcion', 'like', "%$search%");
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
        $criteriosEvaluacions = $query->paginate($perPage);
        
        return CriteriosEvaluacionResource::collection($criteriosEvaluacions);
    }

    public function store(StoreCriteriosEvaluacionRequest $request)
    {
        $criteriosEvaluacion = CriteriosEvaluacion::create($request->validated());
        
        // Cargar relaciones para la respuesta
        $criteriosEvaluacion->load($this->getEagerLoadRelations());
        
        return new CriteriosEvaluacionResource($criteriosEvaluacion);
    }

    public function show(CriteriosEvaluacion $criteriosEvaluacion)
    {
        
        // Cargar relaciones
        $criteriosEvaluacion->load($this->getEagerLoadRelations());
        
        return new CriteriosEvaluacionResource($criteriosEvaluacion);
    }

    public function update(UpdateCriteriosEvaluacionRequest $request, CriteriosEvaluacion $criteriosEvaluacion)
    {
        
        $criteriosEvaluacion->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $criteriosEvaluacion->load($this->getEagerLoadRelations());
        
        return new CriteriosEvaluacionResource($criteriosEvaluacion);
    }

    public function destroy(CriteriosEvaluacion $criteriosEvaluacion)
    {
        
        $criteriosEvaluacion->delete();
        
        return response()->json([
            'message' => 'CriteriosEvaluacion eliminado correctamente'
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
