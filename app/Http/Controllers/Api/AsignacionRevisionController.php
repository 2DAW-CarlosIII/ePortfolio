<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AsignacionRevision;
use App\Http\Requests\StoreAsignacionRevisionRequest;
use App\Http\Requests\UpdateAsignacionRevisionRequest;
use App\Http\Resources\AsignacionRevisionResource;
use Illuminate\Http\Request;
use App\Models\Evidencia;

class AsignacionRevisionController extends Controller
{
    public function index(Request $request, Evidencia $evidencia)
    {
        $query = $evidencia->asignacionRevisions();


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
        $asignacionRevisions = $query->paginate($perPage);
        
        return AsignacionRevisionResource::collection($asignacionRevisions);
    }

    public function store(StoreAsignacionRevisionRequest $request, Evidencia $evidencia)
    {
        $data = $request->validated();
        $data['evidencia_id'] = $evidencia->id;
        
        $asignacionRevision = AsignacionRevision::create($data);
        
        // Cargar relaciones para la respuesta
        $asignacionRevision->load($this->getEagerLoadRelations());
        
        return new AsignacionRevisionResource($asignacionRevision);
    }

    public function show(Evidencia $evidencia, AsignacionRevision $asignacionRevision)
    {
        // Verificar que el asignacionRevision pertenece al evidencia
        if ($asignacionRevision->evidencia_id !== $evidencia->id) {
            abort(404);
        }
        
        // Cargar relaciones
        $asignacionRevision->load($this->getEagerLoadRelations());
        
        return new AsignacionRevisionResource($asignacionRevision);
    }

    public function update(UpdateAsignacionRevisionRequest $request, Evidencia $evidencia, AsignacionRevision $asignacionRevision)
    {
        // Verificar que el asignacionRevision pertenece al evidencia
        if ($asignacionRevision->evidencia_id !== $evidencia->id) {
            abort(404);
        }
        
        $asignacionRevision->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $asignacionRevision->load($this->getEagerLoadRelations());
        
        return new AsignacionRevisionResource($asignacionRevision);
    }

    public function destroy(Evidencia $evidencia, AsignacionRevision $asignacionRevision)
    {
        // Verificar que el asignacionRevision pertenece al evidencia
        if ($asignacionRevision->evidencia_id !== $evidencia->id) {
            abort(404);
        }
        
        $asignacionRevision->delete();
        
        return response()->json([
            'message' => 'AsignacionRevision eliminado correctamente'
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
