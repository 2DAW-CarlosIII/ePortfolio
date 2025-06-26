<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Exceptions\Import\CsvImportException;

abstract class BaseImportController extends Controller
{
    protected string $modelClass;
    protected string $resourceName;
    
    /**
     * Muestra el formulario de importación
     */
    public function show(): JsonResponse
    {
        $fields = $this->modelClass::getImportableFields();
        
        return response()->json([
            'resource' => $this->resourceName,
            'fields' => $fields,
            'template_url' => route('api.import.template', ['resource' => $this->resourceName])
        ]);
    }
    
    /**
     * Procesa la importación
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:51200' // 50MB
        ]);
        
        try {
            $results = $this->modelClass::importFromCsv($request->file('file'));
            
            return response()->json([
                'success' => true,
                'message' => 'Importación completada',
                'results' => $results
            ]);
            
        } catch (CsvImportException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
    
    /**
     * Descarga template CSV
     */
    public function template(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $csv = $this->modelClass::generateImportTemplate();
        $filename = strtolower($this->resourceName) . '_template.csv';
        
        return response()->streamDownload(function() use ($csv) {
            echo $csv;
        }, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"'
        ]);
    }
}
