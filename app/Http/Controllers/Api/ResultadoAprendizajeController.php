<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ResultadoAprendizaje;
use App\Http\Requests\StoreResultadoAprendizajeRequest;
use App\Http\Requests\UpdateResultadoAprendizajeRequest;
use App\Http\Resources\ResultadoAprendizajeResource;
use Illuminate\Http\Request;

class ResultadoAprendizajeController extends Controller
{
    public function index(Request $request)
    {
        $query = ResultadoAprendizaje::query();

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
        $resultadoAprendizajes = $query->paginate($perPage);
        
        return ResultadoAprendizajeResource::collection($resultadoAprendizajes);
    }

    public function store(StoreResultadoAprendizajeRequest $request)
    {
        $resultadoAprendizaje = ResultadoAprendizaje::create($request->validated());
        
        // Cargar relaciones para la respuesta
        $resultadoAprendizaje->load($this->getEagerLoadRelations());
        
        return new ResultadoAprendizajeResource($resultadoAprendizaje);
    }

    public function show(ResultadoAprendizaje $resultadoAprendizaje)
    {
        
        // Cargar relaciones
        $resultadoAprendizaje->load($this->getEagerLoadRelations());
        
        return new ResultadoAprendizajeResource($resultadoAprendizaje);
    }

    public function update(UpdateResultadoAprendizajeRequest $request, ResultadoAprendizaje $resultadoAprendizaje)
    {
        
        $resultadoAprendizaje->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $resultadoAprendizaje->load($this->getEagerLoadRelations());
        
        return new ResultadoAprendizajeResource($resultadoAprendizaje);
    }

    public function destroy(ResultadoAprendizaje $resultadoAprendizaje)
    {
        
        $resultadoAprendizaje->delete();
        
        return response()->json([
            'message' => 'ResultadoAprendizaje eliminado correctamente'
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
