<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ComentarioPar;
use App\Http\Requests\StoreComentarioParRequest;
use App\Http\Requests\UpdateComentarioParRequest;
use App\Http\Resources\ComentarioParResource;
use Illuminate\Http\Request;

class ComentarioParController extends Controller
{
    public function index(Request $request)
    {
        $query = ComentarioPar::query();


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
        $comentarioPars = $query->paginate($perPage);
        
        return ComentarioParResource::collection($comentarioPars);
    }

    public function store(StoreComentarioParRequest $request)
    {
        $comentarioPar = ComentarioPar::create($request->validated());
        
        // Cargar relaciones para la respuesta
        $comentarioPar->load($this->getEagerLoadRelations());
        
        return new ComentarioParResource($comentarioPar);
    }

    public function show(ComentarioPar $comentarioPar)
    {
        
        // Cargar relaciones
        $comentarioPar->load($this->getEagerLoadRelations());
        
        return new ComentarioParResource($comentarioPar);
    }

    public function update(UpdateComentarioParRequest $request, ComentarioPar $comentarioPar)
    {
        
        $comentarioPar->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $comentarioPar->load($this->getEagerLoadRelations());
        
        return new ComentarioParResource($comentarioPar);
    }

    public function destroy(ComentarioPar $comentarioPar)
    {
        
        $comentarioPar->delete();
        
        return response()->json([
            'message' => 'ComentarioPar eliminado correctamente'
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
