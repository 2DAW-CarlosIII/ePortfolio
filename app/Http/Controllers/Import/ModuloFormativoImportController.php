<?php

namespace App\Http\Controllers\Import;

use App\Models\ModuloFormativo;
use App\Models\CicloFormativo;
use App\Http\Requests\Import\ModuloFormativoImportRequest;
use Illuminate\Http\JsonResponse;

class ModuloFormativoImportController extends BaseImportController
{
    protected string $modelClass = ModuloFormativo::class;
    protected string $resourceName = 'ModuloFormativo';
    
    /**
     * Muestra formulario de importación para ModuloFormativo anidado
     */
    public function show(CicloFormativo $cicloformativo): JsonResponse
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
    public function store(ModuloFormativoImportRequest $request, CicloFormativo $cicloformativo): JsonResponse
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
