<?php

namespace App\Http\Controllers\Import;

use App\Models\ResultadoAprendizaje;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResultadoAprendizajeImportController extends BaseImportController
{
    protected string $modelClass = ResultadoAprendizaje::class;
    protected string $resourceName = 'ResultadoAprendizaje';

    /**
     * Muestra formulario de importación para ResultadoAprendizaje anidado
     */
    public function show(): JsonResponse
    {
        $fields = $this->modelClass::getImportableFields();

        return response()->json([
            'resource' => $this->resourceName,
            'parent' => $moduloformativo,
            'fields' => $fields,
            'template_url' => route('api.import.template', [
                'resource' => $this->resourceName,
                'parent_id' => $moduloformativo->id
            ])
        ]);
    }

    /**
     * Procesa importación para ResultadoAprendizaje anidado
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $results = $this->modelClass::importFromCsv($request->file('file'), [
                'modulo_formativo_id' => $moduloformativo->id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'ResultadoAprendizaje importados correctamente',
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
