<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserRol;
use App\Http\Requests\StoreUserRolRequest;
use App\Http\Requests\UpdateUserRolRequest;
use App\Http\Resources\UserRolResource;
use Illuminate\Http\Request;
use App\Models\Rol;

class UserRolController extends Controller
{
    public function index(Request $request, Rol $rol)
    {
        $query = $rol->userRols();


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
        $userRols = $query->paginate($perPage);
        
        return UserRolResource::collection($userRols);
    }

    public function store(StoreUserRolRequest $request, Rol $rol)
    {
        $data = $request->validated();
        $data['role_id'] = $rol->id;
        
        $userRol = UserRol::create($data);
        
        // Cargar relaciones para la respuesta
        $userRol->load($this->getEagerLoadRelations());
        
        return new UserRolResource($userRol);
    }

    public function show(Rol $rol, UserRol $userRol)
    {
        // Verificar que el userRol pertenece al rol
        if ($userRol->role_id !== $rol->id) {
            abort(404);
        }
        
        // Cargar relaciones
        $userRol->load($this->getEagerLoadRelations());
        
        return new UserRolResource($userRol);
    }

    public function update(UpdateUserRolRequest $request, Rol $rol, UserRol $userRol)
    {
        // Verificar que el userRol pertenece al rol
        if ($userRol->role_id !== $rol->id) {
            abort(404);
        }
        
        $userRol->update($request->validated());
        
        // Cargar relaciones para la respuesta
        $userRol->load($this->getEagerLoadRelations());
        
        return new UserRolResource($userRol);
    }

    public function destroy(Rol $rol, UserRol $userRol)
    {
        // Verificar que el userRol pertenece al rol
        if ($userRol->role_id !== $rol->id) {
            abort(404);
        }
        
        $userRol->delete();
        
        return response()->json([
            'message' => 'UserRol eliminado correctamente'
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
