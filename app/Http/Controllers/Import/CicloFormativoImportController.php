<?php

namespace App\Http\Controllers\Import;

use App\Models\CicloFormativo;
use App\Models\FamiliaProfesional;
use App\Http\Requests\Import\CicloFormativoImportRequest;
use Illuminate\Http\JsonResponse;

class CicloFormativoImportController extends BaseImportController
{
    protected string $modelClass = CicloFormativo::class;
    protected string $resourceName = 'CicloFormativo';
    
    /**
     * Muestra formulario de importación para CicloFormativo anidado
     */
    public function show(FamiliaProfesional $familiaprofesional): JsonResponse
    {
        $fields = $this->modelClass::getImportableFields();
        
        return response()->json([
            'resource' => $this->resourceName,
            'parent' => $familiaprofesional,
            'fields' => $fields,
            'template_url' => route('api.import.template', [
                'resource' => $this->resourceName,
                'parent_id' => $familiaprofesional->id
            ])
        ]);
    }
    
    /**
     * Procesa importación para CicloFormativo anidado
     */
    public function store(CicloFormativoImportRequest $request, FamiliaProfesional $familiaprofesional): JsonResponse
    {
        try {
            $results = $this->modelClass::importFromCsv($request->file('file'), [
                'familia_profesional_id' => $familiaprofesional->id
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'CicloFormativo importados correctamente',
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
