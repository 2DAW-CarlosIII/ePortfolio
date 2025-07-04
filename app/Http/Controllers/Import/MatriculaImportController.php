<?php

namespace App\Http\Controllers\Import;

use App\Models\Matricula;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MatriculaImportController extends BaseImportController
{
    protected string $modelClass = Matricula::class;
    protected string $resourceName = 'Matricula';

    /**
     * Muestra formulario de importación para Matricula anidado
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
     * Procesa importación para Matricula anidado
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $results = $this->modelClass::importFromCsv($request->file('file'), [
                'modulo_formativo_id' => $moduloformativo->id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Matricula importados correctamente',
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
