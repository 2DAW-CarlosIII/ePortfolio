<?php

namespace App\Services\Import;

use App\Models\CriterioEvaluacion;
use App\Services\Import\BaseImportService;
use Illuminate\Support\Facades\DB;

class CriteriosEvaluacionImportService extends BaseImportService
{
    protected string $modelClass = CriterioEvaluacion::class;

    protected array $requiredHeaders = ['codigo', 'descripcion', 'peso_porcentaje', 'orden'];

    protected array $validationRules = [
        'resultado_aprendizaje_id' => ['required', 'integer', 'exists:table,id'],
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
        // resultado_aprendizaje_id - Buscar por nombre/código
        if (!empty($row[0])) {
            $related = \App\Models\ResultadoAprendizaje::where('nombre', $row[0])
                ->orWhere('codigo', $row[0])
                ->first();
            $data['resultado_aprendizaje_id'] = $related ? $related->id : null;
        }
        // codigo
        $data['codigo'] = !empty($row[0]) ? trim($row[0]) : null;
        // descripcion
        $data['descripcion'] = !empty($row[0]) ? trim($row[0]) : null;
        // peso_porcentaje
        $data['peso_porcentaje'] = !empty($row[0]) ? (float) $row[0] : null;
        // orden
        $data['orden'] = !empty($row[0]) ? (int) $row[0] : null;
    }

    /**
     * Crea o actualiza el modelo
     */
    protected function createOrUpdateModel(array $data)
    {
        // Buscar duplicado por campos únicos si es necesario
        $existingQuery = CriterioEvaluacion::query();

        $existingQuery->where('codigo', $data['codigo']);

        $existing = $existingQuery->first();

        if ($existing) {
            $existing->update($data);
            return $existing;
        }

        return CriterioEvaluacion::create($data);
    }

    /**
     * Genera fila de ejemplo para template
     */
    protected function getExampleRow(): array
    {
        return ['Valor de ejemplo', 'COD001', 'Descripción detallada del elemento', '12.50', '123'];
    }
}
