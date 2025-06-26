<?php

namespace App\Http\Controllers\Import;

use App\Models\CriteriosEvaluacion;
use App\Models\ResultadoAprendizaje;
use App\Http\Requests\Import\CriteriosEvaluacionImportRequest;
use Illuminate\Http\JsonResponse;

class CriteriosEvaluacionImportController extends BaseImportController
{
    protected string $modelClass = CriteriosEvaluacion::class;
    protected string $resourceName = 'CriteriosEvaluacion';
    
    /**
     * Muestra formulario de importación para CriteriosEvaluacion anidado
     */
    public function show(ResultadoAprendizaje $resultadoaprendizaje): JsonResponse
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
    public function store(CriteriosEvaluacionImportRequest $request, ResultadoAprendizaje $resultadoaprendizaje): JsonResponse
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
