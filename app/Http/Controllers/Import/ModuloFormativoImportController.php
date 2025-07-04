<?php

namespace App\Http\Controllers\Import;

use App\Models\ModuloFormativo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ModuloFormativoImportController extends BaseImportController
{
    protected string $modelClass = ModuloFormativo::class;
    protected string $resourceName = 'ModuloFormativo';

    /**
     * Muestra formulario de importación para ModuloFormativo anidado
     */
    public function show(): JsonResponse
    {
        $fields = $this->modelClass::getImportableFields();

        return response()->json([
            'resource' => $this->resourceName,
            'parent' => $cicloformativo,
            'fields' => $fields,
            'template_url' => route('api.import.template', [
                'resource' => $this->resourceName,
                'parent_id' => $cicloformativo->id
            ])
        ]);
    }

    /**
     * Procesa importación para ModuloFormativo anidado
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $results = $this->modelClass::importFromCsv($request->file('file'), [
                'ciclo_formativo_id' => $cicloformativo->id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'ModuloFormativo importados correctamente',
                'results' => $results
            ]);

        } catch (\App\Exceptions\Import\CsvImportException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
