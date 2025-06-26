<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Http\Requests\StoreRolRequest;
use App\Http\Requests\UpdateRolRequest;
use App\Http\Resources\RolResource;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index(Request $request)
    {
        $query = Rol::query();


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
        $rols = $query->paginate($perPage);
        
        return RolResource::collection($rols);
    }

    public function store(StoreRolRequest $request)
    {
        $rol = Rol::create($request->validated());
        
        // Cargar relaciones para la respuesta
        $rol->load($this->getEagerLoadRelations());
        
        return new RolResource($rol);
    }

    public function show(Rol $rol)
    {
        
        // Cargar relaciones
        $rol->load($this->getEagerLoadRelations());
        
        return new RolResource($rol);
    }

    public function update(UpdateRolRequest $request, Rol $rol)
    {
        
        $rol->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $rol->load($this->getEagerLoadRelations());
        
        return new RolResource($rol);
    }

    public function destroy(Rol $rol)
    {
        
        $rol->delete();
        
        return response()->json([
            'message' => 'Rol eliminado correctamente'
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
