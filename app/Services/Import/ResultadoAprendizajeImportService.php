<?php

namespace App\Services\Import;

use App\Models\ResultadoAprendizaje;
use App\Services\Import\BaseImportService;
use Illuminate\Support\Facades\DB;

class ResultadoAprendizajeImportService extends BaseImportService
{
    protected string $modelClass = ResultadoAprendizaje::class;
    
    protected array $requiredHeaders = ['codigo', 'descripcion', 'peso_porcentaje', 'orden'];
    
    protected array $validationRules = [
        'modulo_formativo_id' => ['required', 'integer', 'exists:table,id'],
        'codigo' => ['required', 'string', 'max:255'],
        'descripcion' => ['required', 'string'],
        'peso_porcentaje' => ['required', 'numeric'],
        'orden' => ['required', 'integer']
    ];
    
    /**
     * Mapea una fila CSV a datos del modelo
     */
    protected function mapRowToData(array $row): array
    {
        $data = [];
        // modulo_formativo_id - Buscar por nombre/código
        if (!empty($row[0])) {
            $related = \App\Models\ModuloFormativo::where('nombre', $row[0])
                ->orWhere('codigo', $row[0])
                ->first();
            $data['modulo_formativo_id'] = $related ? $related->id : null;
        }
        // codigo
        $data['codigo'] = !empty($row[{index}]) ? trim($row[{index}]) : null;
        // descripcion
        $data['descripcion'] = !empty($row[{index}]) ? trim($row[{index}]) : null;
        // peso_porcentaje
        $data['peso_porcentaje'] = !empty($row[{index}]) ? (float) $row[{index}] : null;
        // orden
        $data['orden'] = !empty($row[{index}]) ? (int) $row[{index}] : null;
    }
    
    /**
     * Crea o actualiza el modelo
     */
    protected function createOrUpdateModel(array $data)
    {
        // Buscar duplicado por campos únicos si es necesario
        $existingQuery = ResultadoAprendizaje::query();
        
                    ->where('codigo', $data['codigo'])
        
        $existing = $existingQuery->first();
        
        if ($existing) {
            $existing->update($data);
            return $existing;
        }
        
        return ResultadoAprendizaje::create($data);
    }
    
    /**
     * Genera fila de ejemplo para template
     */
    protected function getExampleRow(): array
    {
        return ['Valor de ejemplo', 'COD001', 'Descripción detallada del elemento', '12.50', '123'];
    }
}
