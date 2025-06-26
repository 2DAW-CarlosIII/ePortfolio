<?php

namespace App\Services\Import;

use App\Models\User;
use App\Services\Import\BaseImportService;
use Illuminate\Support\Facades\DB;

class UserImportService extends BaseImportService
{
    protected string $modelClass = User::class;
    
    protected array $requiredHeaders = ['name', 'email', 'password'];
    
    protected array $validationRules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'max:255', 'email'],
        'email_verified_at' => ['nullable'],
        'password' => ['required', 'string', 'max:255']
    ];
    
    /**
     * Mapea una fila CSV a datos del modelo
     */
    protected function mapRowToData(array $row): array
    {
        $data = [];
        // name
        $data['name'] = !empty($row[{index}]) ? trim($row[{index}]) : null;
        // email
        $data['email'] = !empty($row[{index}]) ? trim($row[{index}]) : null;
        // email_verified_at
        $data['email_verified_at'] = !empty($row[{index}]) ? trim($row[{index}]) : null;
        // password
        $data['password'] = !empty($row[{index}]) ? trim($row[{index}]) : null;
    }
    
    /**
     * Crea o actualiza el modelo
     */
    protected function createOrUpdateModel(array $data)
    {
        // Buscar duplicado por campos únicos si es necesario
        $existingQuery = User::query();
        
                    ->where('email', $data['email'])
        
        $existing = $existingQuery->first();
        
        if ($existing) {
            $existing->update($data);
            return $existing;
        }
        
        return User::create($data);
    }
    
    /**
     * Genera fila de ejemplo para template
     */
    protected function getExampleRow(): array
    {
        return ['Valor de ejemplo', 'usuario@ejemplo.com', 'usuario@ejemplo.com', 'Valor de ejemplo'];
    }
}
