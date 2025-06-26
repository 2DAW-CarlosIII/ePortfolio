<?php

namespace App\Services\Import;

use App\Models\Matricula;
use App\Services\Import\BaseImportService;
use Illuminate\Support\Facades\DB;

class MatriculaImportService extends BaseImportService
{
    protected string $modelClass = Matricula::class;
    
    protected array $requiredHeaders = ['fecha_matricula', 'estado'];
    
    protected array $validationRules = [
        'estudiante_id' => ['required', 'integer', 'exists:table,id'],
        'modulo_formativo_id' => ['required', 'integer', 'exists:table,id'],
        'fecha_matricula' => ['required', 'date'],
        'estado' => ['required', 'in:value1,value2']
    ];
    
    /**
     * Mapea una fila CSV a datos del modelo
     */
    protected function mapRowToData(array $row): array
    {
        $data = [];
        // estudiante_id - Buscar por nombre/código
        if (!empty($row[0])) {
            $related = \App\Models\Unknown::where('nombre', $row[0])
                ->orWhere('codigo', $row[0])
                ->first();
            $data['estudiante_id'] = $related ? $related->id : null;
        }
        // modulo_formativo_id - Buscar por nombre/código
        if (!empty($row[1])) {
            $related = \App\Models\ModuloFormativo::where('nombre', $row[1])
                ->orWhere('codigo', $row[1])
                ->first();
            $data['modulo_formativo_id'] = $related ? $related->id : null;
        }
        // fecha_matricula
        $data['fecha_matricula'] = !empty($row[{index}]) ? date('Y-m-d', strtotime($row[{index}])) : null;
        // estado
        $data['estado'] = !empty($row[{index}]) ? trim($row[{index}]) : null;
    }
    
    /**
     * Crea o actualiza el modelo
     */
    protected function createOrUpdateModel(array $data)
    {
        // Buscar duplicado por campos únicos si es necesario
        $existingQuery = Matricula::query();
        
                // No hay campos únicos definidos
        
        $existing = $existingQuery->first();
        
        if ($existing) {
            $existing->update($data);
            return $existing;
        }
        
        return Matricula::create($data);
    }
    
    /**
     * Genera fila de ejemplo para template
     */
    protected function getExampleRow(): array
    {
        return ['Valor de ejemplo', 'Valor de ejemplo', '2024-01-15', 'Valor de ejemplo'];
    }
}
