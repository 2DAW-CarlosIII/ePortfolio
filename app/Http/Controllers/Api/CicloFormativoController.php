<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CicloFormativo;
use App\Http\Requests\StoreCicloFormativoRequest;
use App\Http\Requests\UpdateCicloFormativoRequest;
use App\Http\Resources\CicloFormativoResource;
use Illuminate\Http\Request;

class CicloFormativoController extends Controller
{
    public function index(Request $request)
    {
        $query = CicloFormativo::query();

        // Filtro de búsqueda
        if ($request->has('search') && $request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%$search%")->orWhere('codigo', 'like', "%$search%")->orWhere('descripcion', 'like', "%$search%");
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
        $cicloFormativos = $query->paginate($perPage);
        
        return CicloFormativoResource::collection($cicloFormativos);
    }

    public function store(StoreCicloFormativoRequest $request)
    {
        $cicloFormativo = CicloFormativo::create($request->validated());
        
        // Cargar relaciones para la respuesta
        $cicloFormativo->load($this->getEagerLoadRelations());
        
        return new CicloFormativoResource($cicloFormativo);
    }

    public function show(CicloFormativo $cicloFormativo)
    {
        
        // Cargar relaciones
        $cicloFormativo->load($this->getEagerLoadRelations());
        
        return new CicloFormativoResource($cicloFormativo);
    }

    public function update(UpdateCicloFormativoRequest $request, CicloFormativo $cicloFormativo)
    {
        
        $cicloFormativo->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $cicloFormativo->load($this->getEagerLoadRelations());
        
        return new CicloFormativoResource($cicloFormativo);
    }

    public function destroy(CicloFormativo $cicloFormativo)
    {
        
        $cicloFormativo->delete();
        
        return response()->json([
            'message' => 'CicloFormativo eliminado correctamente'
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
