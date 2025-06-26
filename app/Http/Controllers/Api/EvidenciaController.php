<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evidencia;
use App\Http\Requests\StoreEvidenciaRequest;
use App\Http\Requests\UpdateEvidenciaRequest;
use App\Http\Resources\EvidenciaResource;
use Illuminate\Http\Request;

class EvidenciaController extends Controller
{
    public function index(Request $request)
    {
        $query = Evidencia::query();

        // Filtro de búsqueda
        if ($request->has('search') && $request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('descripcion', 'like', "%$search%");
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
        $evidencias = $query->paginate($perPage);
        
        return EvidenciaResource::collection($evidencias);
    }

    public function store(StoreEvidenciaRequest $request)
    {
        $evidencia = Evidencia::create($request->validated());
        
        // Cargar relaciones para la respuesta
        $evidencia->load($this->getEagerLoadRelations());
        
        return new EvidenciaResource($evidencia);
    }

    public function show(Evidencia $evidencia)
    {
        
        // Cargar relaciones
        $evidencia->load($this->getEagerLoadRelations());
        
        return new EvidenciaResource($evidencia);
    }

    public function update(UpdateEvidenciaRequest $request, Evidencia $evidencia)
    {
        
        $evidencia->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $evidencia->load($this->getEagerLoadRelations());
        
        return new EvidenciaResource($evidencia);
    }

    public function destroy(Evidencia $evidencia)
    {
        
        $evidencia->delete();
        
        return response()->json([
            'message' => 'Evidencia eliminado correctamente'
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
