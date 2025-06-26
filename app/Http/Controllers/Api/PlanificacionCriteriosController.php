<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlanificacionCriterios;
use App\Http\Requests\StorePlanificacionCriteriosRequest;
use App\Http\Requests\UpdatePlanificacionCriteriosRequest;
use App\Http\Resources\PlanificacionCriteriosResource;
use Illuminate\Http\Request;

class PlanificacionCriteriosController extends Controller
{
    public function index(Request $request)
    {
        $query = PlanificacionCriterios::query();


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
        $planificacionCriterioss = $query->paginate($perPage);
        
        return PlanificacionCriteriosResource::collection($planificacionCriterioss);
    }

    public function store(StorePlanificacionCriteriosRequest $request)
    {
        $planificacionCriterios = PlanificacionCriterios::create($request->validated());
        
        // Cargar relaciones para la respuesta
        $planificacionCriterios->load($this->getEagerLoadRelations());
        
        return new PlanificacionCriteriosResource($planificacionCriterios);
    }

    public function show(PlanificacionCriterios $planificacionCriterios)
    {
        
        // Cargar relaciones
        $planificacionCriterios->load($this->getEagerLoadRelations());
        
        return new PlanificacionCriteriosResource($planificacionCriterios);
    }

    public function update(UpdatePlanificacionCriteriosRequest $request, PlanificacionCriterios $planificacionCriterios)
    {
        
        $planificacionCriterios->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $planificacionCriterios->load($this->getEagerLoadRelations());
        
        return new PlanificacionCriteriosResource($planificacionCriterios);
    }

    public function destroy(PlanificacionCriterios $planificacionCriterios)
    {
        
        $planificacionCriterios->delete();
        
        return response()->json([
            'message' => 'PlanificacionCriterios eliminado correctamente'
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
