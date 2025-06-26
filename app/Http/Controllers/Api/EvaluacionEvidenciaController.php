<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EvaluacionEvidencia;
use App\Http\Requests\StoreEvaluacionEvidenciaRequest;
use App\Http\Requests\UpdateEvaluacionEvidenciaRequest;
use App\Http\Resources\EvaluacionEvidenciaResource;
use Illuminate\Http\Request;
use App\Models\Evidencia;

class EvaluacionEvidenciaController extends Controller
{
    public function index(Request $request, Evidencia $evidencia)
    {
        $query = $evidencia->evaluacionEvidencias();


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
        $evaluacionEvidencias = $query->paginate($perPage);
        
        return EvaluacionEvidenciaResource::collection($evaluacionEvidencias);
    }

    public function store(StoreEvaluacionEvidenciaRequest $request, Evidencia $evidencia)
    {
        $data = $request->validated();
        $data['evidencia_id'] = $evidencia->id;
        
        $evaluacionEvidencia = EvaluacionEvidencia::create($data);
        
        // Cargar relaciones para la respuesta
        $evaluacionEvidencia->load($this->getEagerLoadRelations());
        
        return new EvaluacionEvidenciaResource($evaluacionEvidencia);
    }

    public function show(Evidencia $evidencia, EvaluacionEvidencia $evaluacionEvidencia)
    {
        // Verificar que el evaluacionEvidencia pertenece al evidencia
        if ($evaluacionEvidencia->evidencia_id !== $evidencia->id) {
            abort(404);
        }
        
        // Cargar relaciones
        $evaluacionEvidencia->load($this->getEagerLoadRelations());
        
        return new EvaluacionEvidenciaResource($evaluacionEvidencia);
    }

    public function update(UpdateEvaluacionEvidenciaRequest $request, Evidencia $evidencia, EvaluacionEvidencia $evaluacionEvidencia)
    {
        // Verificar que el evaluacionEvidencia pertenece al evidencia
        if ($evaluacionEvidencia->evidencia_id !== $evidencia->id) {
            abort(404);
        }
        
        $evaluacionEvidencia->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $evaluacionEvidencia->load($this->getEagerLoadRelations());
        
        return new EvaluacionEvidenciaResource($evaluacionEvidencia);
    }

    public function destroy(Evidencia $evidencia, EvaluacionEvidencia $evaluacionEvidencia)
    {
        // Verificar que el evaluacionEvidencia pertenece al evidencia
        if ($evaluacionEvidencia->evidencia_id !== $evidencia->id) {
            abort(404);
        }
        
        $evaluacionEvidencia->delete();
        
        return response()->json([
            'message' => 'EvaluacionEvidencia eliminado correctamente'
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
