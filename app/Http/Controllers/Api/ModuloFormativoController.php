<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ModuloFormativo;
use App\Http\Requests\StoreModuloFormativoRequest;
use App\Http\Requests\UpdateModuloFormativoRequest;
use App\Http\Resources\ModuloFormativoResource;
use Illuminate\Http\Request;

class ModuloFormativoController extends Controller
{
    public function index(Request $request)
    {
        $query = ModuloFormativo::query();

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
        $moduloFormativos = $query->paginate($perPage);
        
        return ModuloFormativoResource::collection($moduloFormativos);
    }

    public function store(StoreModuloFormativoRequest $request)
    {
        $moduloFormativo = ModuloFormativo::create($request->validated());
        
        // Cargar relaciones para la respuesta
        $moduloFormativo->load($this->getEagerLoadRelations());
        
        return new ModuloFormativoResource($moduloFormativo);
    }

    public function show(ModuloFormativo $moduloFormativo)
    {
        
        // Cargar relaciones
        $moduloFormativo->load($this->getEagerLoadRelations());
        
        return new ModuloFormativoResource($moduloFormativo);
    }

    public function update(UpdateModuloFormativoRequest $request, ModuloFormativo $moduloFormativo)
    {
        
        $moduloFormativo->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $moduloFormativo->load($this->getEagerLoadRelations());
        
        return new ModuloFormativoResource($moduloFormativo);
    }

    public function destroy(ModuloFormativo $moduloFormativo)
    {
        
        $moduloFormativo->delete();
        
        return response()->json([
            'message' => 'ModuloFormativo eliminado correctamente'
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
