<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EvaluacionPar;
use App\Http\Requests\StoreEvaluacionParRequest;
use App\Http\Requests\UpdateEvaluacionParRequest;
use App\Http\Resources\EvaluacionParResource;
use Illuminate\Http\Request;

class EvaluacionParController extends Controller
{
    public function index(Request $request)
    {
        $query = EvaluacionPar::query();


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
        $evaluacionPars = $query->paginate($perPage);
        
        return EvaluacionParResource::collection($evaluacionPars);
    }

    public function store(StoreEvaluacionParRequest $request)
    {
        $evaluacionPar = EvaluacionPar::create($request->validated());
        
        // Cargar relaciones para la respuesta
        $evaluacionPar->load($this->getEagerLoadRelations());
        
        return new EvaluacionParResource($evaluacionPar);
    }

    public function show(EvaluacionPar $evaluacionPar)
    {
        
        // Cargar relaciones
        $evaluacionPar->load($this->getEagerLoadRelations());
        
        return new EvaluacionParResource($evaluacionPar);
    }

    public function update(UpdateEvaluacionParRequest $request, EvaluacionPar $evaluacionPar)
    {
        
        $evaluacionPar->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $evaluacionPar->load($this->getEagerLoadRelations());
        
        return new EvaluacionParResource($evaluacionPar);
    }

    public function destroy(EvaluacionPar $evaluacionPar)
    {
        
        $evaluacionPar->delete();
        
        return response()->json([
            'message' => 'EvaluacionPar eliminado correctamente'
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
