<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comentario;
use App\Http\Requests\StoreComentarioRequest;
use App\Http\Requests\UpdateComentarioRequest;
use App\Http\Resources\ComentarioResource;
use Illuminate\Http\Request;
use App\Models\Evidencia;

class ComentarioController extends Controller
{
    public function index(Request $request, Evidencia $evidencia)
    {
        $query = $evidencia->comentarios();


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
        $comentarios = $query->paginate($perPage);
        
        return ComentarioResource::collection($comentarios);
    }

    public function store(StoreComentarioRequest $request, Evidencia $evidencia)
    {
        $data = $request->validated();
        $data['evidencia_id'] = $evidencia->id;
        
        $comentario = Comentario::create($data);
        
        // Cargar relaciones para la respuesta
        $comentario->load($this->getEagerLoadRelations());
        
        return new ComentarioResource($comentario);
    }

    public function show(Evidencia $evidencia, Comentario $comentario)
    {
        // Verificar que el comentario pertenece al evidencia
        if ($comentario->evidencia_id !== $evidencia->id) {
            abort(404);
        }
        
        // Cargar relaciones
        $comentario->load($this->getEagerLoadRelations());
        
        return new ComentarioResource($comentario);
    }

    public function update(UpdateComentarioRequest $request, Evidencia $evidencia, Comentario $comentario)
    {
        // Verificar que el comentario pertenece al evidencia
        if ($comentario->evidencia_id !== $evidencia->id) {
            abort(404);
        }
        
        $comentario->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $comentario->load($this->getEagerLoadRelations());
        
        return new ComentarioResource($comentario);
    }

    public function destroy(Evidencia $evidencia, Comentario $comentario)
    {
        // Verificar que el comentario pertenece al evidencia
        if ($comentario->evidencia_id !== $evidencia->id) {
            abort(404);
        }
        
        $comentario->delete();
        
        return response()->json([
            'message' => 'Comentario eliminado correctamente'
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
