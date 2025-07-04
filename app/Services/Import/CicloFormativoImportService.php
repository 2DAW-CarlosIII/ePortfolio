<?php

namespace App\Services\Import;

use App\Models\CicloFormativo;
use App\Services\Import\BaseImportService;
use Illuminate\Support\Facades\DB;

class CicloFormativoImportService extends BaseImportService
{
    protected string $modelClass = CicloFormativo::class;

    protected array $requiredHeaders = ['nombre', 'codigo', 'grado', 'descripcion'];

    protected array $validationRules = [
        'familia_profesional_id' => ['required', 'integer', 'exists:table,id'],
        'nombre' => ['required', 'string', 'max:255'],
        'codigo' => ['required', 'string', 'max:255'],
        'grado' => ['required', 'in:value1,value2'],
        'descripcion' => ['required', 'string']
    ];

    /**
     * Mapea una fila CSV a datos del modelo
     */
    protected function mapRowToData(array $row): array
    {
        $data = [];
        // familia_profesional_id - Buscar por nombre/código
        if (!empty($row[0])) {
            $related = \App\Models\FamiliaProfesional::where('nombre', $row[0])
                ->orWhere('codigo', $row[0])
                ->first();
            $data['familia_profesional_id'] = $related ? $related->id : null;
        }
        // nombre
        $data['nombre'] = !empty($row[0]) ? trim($row[0]) : null;
        // codigo
        $data['codigo'] = !empty($row[0]) ? trim($row[0]) : null;
        // grado
        $data['grado'] = !empty($row[0]) ? trim($row[0]) : null;
        // descripcion
        $data['descripcion'] = !empty($row[0]) ? trim($row[0]) : null;
    }

    /**
     * Crea o actualiza el modelo
     */
    protected function createOrUpdateModel(array $data)
    {
        // Buscar duplicado por campos únicos si es necesario
        $existingQuery = CicloFormativo::query();

        $existingQuery->where('codigo', $data['codigo']);

        $existing = $existingQuery->first();

        if ($existing) {
            $existing->update($data);
            return $existing;
        }

        return CicloFormativo::create($data);
    }

    /**
     * Genera fila de ejemplo para template
     */
    protected function getExampleRow(): array
    {
        return ['Valor de ejemplo', 'Nombre de Ejemplo', 'COD001', 'Valor de ejemplo', 'Descripción detallada del elemento'];
    }
}
