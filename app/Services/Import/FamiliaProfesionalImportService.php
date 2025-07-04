<?php

namespace App\Services\Import;

use App\Models\FamiliaProfesional;
use App\Services\Import\BaseImportService;
use Illuminate\Support\Facades\DB;

class FamiliaProfesionalImportService extends BaseImportService
{
    protected string $modelClass = FamiliaProfesional::class;

    protected array $requiredHeaders = ['nombre', 'codigo', 'descripcion'];

    protected array $validationRules = [
        'nombre' => ['required', 'string', 'max:255'],
        'codigo' => ['required', 'string', 'max:255'],
        'descripcion' => ['required', 'string']
    ];

    /**
     * Mapea una fila CSV a datos del modelo
     */
    protected function mapRowToData(array $row): array
    {
        $data = [];
        // nombre
        $data['nombre'] = !empty($row[0]) ? trim($row[0]) : null;
        // codigo
        $data['codigo'] = !empty($row[0]) ? trim($row[0]) : null;
        // descripcion
        $data['descripcion'] = !empty($row[0]) ? trim($row[0]) : null;
    }

    /**
     * Crea o actualiza el modelo
     */
    protected function createOrUpdateModel(array $data)
    {
        // Buscar duplicado por campos únicos si es necesario
        $existingQuery = FamiliaProfesional::query();

        $existingQuery->where('codigo', $data['codigo']);

        $existing = $existingQuery->first();

        if ($existing) {
            $existing->update($data);
            return $existing;
        }

        return FamiliaProfesional::create($data);
    }

    /**
     * Genera fila de ejemplo para template
     */
    protected function getExampleRow(): array
    {
        return ['Nombre de Ejemplo', 'COD001', 'Descripción detallada del elemento'];
    }
}
