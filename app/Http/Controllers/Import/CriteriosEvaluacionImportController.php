<?php

namespace App\Http\Controllers\Import;

use App\Models\CriteriosEvaluacion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CriteriosEvaluacionImportController extends BaseImportController
{
    protected string $modelClass = CriteriosEvaluacion::class;
    protected string $resourceName = 'CriteriosEvaluacion';

    /**
     * Muestra formulario de importación para CriteriosEvaluacion anidado
     */
    public function show(): JsonResponse
    {
        $fields = $this->modelClass::getImportableFields();

        return response()->json([
            'resource' => $this->resourceName,
            'parent' => $resultadoaprendizaje,
            'fields' => $fields,
            'template_url' => route('api.import.template', [
                'resource' => $this->resourceName,
                'parent_id' => $resultadoaprendizaje->id
            ])
        ]);
    }

    /**
     * Procesa importación para CriteriosEvaluacion anidado
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $results = $this->modelClass::importFromCsv($request->file('file'), [
                'resultado_aprendizaje_id' => $resultadoaprendizaje->id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'CriteriosEvaluacion importados correctamente',
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
