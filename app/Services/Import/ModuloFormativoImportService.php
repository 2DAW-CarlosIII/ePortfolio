<?php

namespace App\Services\Import;

use App\Models\ModuloFormativo;
use App\Services\Import\BaseImportService;
use Illuminate\Support\Facades\DB;

class ModuloFormativoImportService extends BaseImportService
{
    protected string $modelClass = ModuloFormativo::class;
    
    protected array $requiredHeaders = ['nombre', 'codigo', 'horas_totales', 'curso_escolar', 'centro', 'descripcion'];
    
    protected array $validationRules = [
        'ciclo_formativo_id' => ['required', 'integer', 'exists:table,id'],
        'nombre' => ['required', 'string', 'max:255'],
        'codigo' => ['required', 'string', 'max:255'],
        'horas_totales' => ['required', 'integer'],
        'curso_escolar' => ['required', 'string', 'max:255'],
        'centro' => ['required', 'string', 'max:255'],
        'docente_id' => ['required', 'integer', 'exists:table,id'],
        'descripcion' => ['required', 'string']
    ];
    
    /**
     * Mapea una fila CSV a datos del modelo
     */
    protected function mapRowToData(array $row): array
    {
        $data = [];
        // ciclo_formativo_id - Buscar por nombre/código
        if (!empty($row[0])) {
            $related = \App\Models\CicloFormativo::where('nombre', $row[0])
                ->orWhere('codigo', $row[0])
                ->first();
            $data['ciclo_formativo_id'] = $related ? $related->id : null;
        }
        // nombre
        $data['nombre'] = !empty($row[{index}]) ? trim($row[{index}]) : null;
        // codigo
        $data['codigo'] = !empty($row[{index}]) ? trim($row[{index}]) : null;
        // horas_totales
        $data['horas_totales'] = !empty($row[{index}]) ? (int) $row[{index}] : null;
        // curso_escolar
        $data['curso_escolar'] = !empty($row[{index}]) ? trim($row[{index}]) : null;
        // centro
        $data['centro'] = !empty($row[{index}]) ? trim($row[{index}]) : null;
        // docente_id - Buscar por nombre/código
        if (!empty($row[6])) {
            $related = \App\Models\Unknown::where('nombre', $row[6])
                ->orWhere('codigo', $row[6])
                ->first();
            $data['docente_id'] = $related ? $related->id : null;
        }
        // descripcion
        $data['descripcion'] = !empty($row[{index}]) ? trim($row[{index}]) : null;
    }
    
    /**
     * Crea o actualiza el modelo
     */
    protected function createOrUpdateModel(array $data)
    {
        // Buscar duplicado por campos únicos si es necesario
        $existingQuery = ModuloFormativo::query();
        
                    ->where('codigo', $data['codigo'])
        
        $existing = $existingQuery->first();
        
        if ($existing) {
            $existing->update($data);
            return $existing;
        }
        
        return ModuloFormativo::create($data);
    }
    
    /**
     * Genera fila de ejemplo para template
     */
    protected function getExampleRow(): array
    {
        return ['Valor de ejemplo', 'Nombre de Ejemplo', 'COD001', '123', 'Valor de ejemplo', 'Valor de ejemplo', 'Valor de ejemplo', 'Descripción detallada del elemento'];
    }
}
