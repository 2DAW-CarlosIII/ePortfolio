<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FamiliaProfesional;
use App\Http\Requests\StoreFamiliaProfesionalRequest;
use App\Http\Requests\UpdateFamiliaProfesionalRequest;
use App\Http\Resources\FamiliaProfesionalResource;
use Illuminate\Http\Request;

class FamiliaProfesionalController extends Controller
{
    public function index(Request $request)
    {
        $query = FamiliaProfesional::query();

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
        $familiaProfesionals = $query->paginate($perPage);
        
        return FamiliaProfesionalResource::collection($familiaProfesionals);
    }

    public function store(StoreFamiliaProfesionalRequest $request)
    {
        $familiaProfesional = FamiliaProfesional::create($request->validated());
        
        // Cargar relaciones para la respuesta
        $familiaProfesional->load($this->getEagerLoadRelations());
        
        return new FamiliaProfesionalResource($familiaProfesional);
    }

    public function show(FamiliaProfesional $familiaProfesional)
    {
        
        // Cargar relaciones
        $familiaProfesional->load($this->getEagerLoadRelations());
        
        return new FamiliaProfesionalResource($familiaProfesional);
    }

    public function update(UpdateFamiliaProfesionalRequest $request, FamiliaProfesional $familiaProfesional)
    {
        
        $familiaProfesional->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $familiaProfesional->load($this->getEagerLoadRelations());
        
        return new FamiliaProfesionalResource($familiaProfesional);
    }

    public function destroy(FamiliaProfesional $familiaProfesional)
    {
        
        $familiaProfesional->delete();
        
        return response()->json([
            'message' => 'FamiliaProfesional eliminado correctamente'
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
