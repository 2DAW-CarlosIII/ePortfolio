<?php

namespace App\Services\Import;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\Import\CsvImportException;
use App\Exceptions\Import\CsvValidationException;

class BaseImportService
{
    protected array $requiredHeaders = [];
    protected array $validationRules = [];
    protected string $modelClass;
    
    /**
     * Procesa un archivo CSV
     */
    public function process(UploadedFile $file, array $options = []): array
    {
        $this->validateFile($file);
        
        $data = $this->parseCSV($file);
        $this->validateHeaders($data->first());
        
        $results = [
            'success' => 0,
            'errors' => 0,
            'skipped' => 0,
            'details' => []
        ];
        
        foreach ($data->skip(1) as $index => $row) {
            try {
                $this->processRow($row, $index + 2, $results);
            } catch (\Exception $e) {
                $results['errors']++;
                $results['details'][] = [
                    'row' => $index + 2,
                    'error' => $e->getMessage(),
                    'data' => $row
                ];
            }
        }
        
        return $results;
    }
    
    /**
     * Valida el archivo CSV
     */
    protected function validateFile(UploadedFile $file): void
    {
        if (!$file->isValid()) {
            throw new CsvImportException('Archivo inválido');
        }
        
        if ($file->getClientOriginalExtension() !== 'csv') {
            throw new CsvImportException('El archivo debe ser CSV');
        }
        
        if ($file->getSize() > 50 * 1024 * 1024) { // 50MB
            throw new CsvImportException('El archivo es demasiado grande (máximo 50MB)');
        }
    }
    
    /**
     * Parsea el archivo CSV
     */
    protected function parseCSV(UploadedFile $file): Collection
    {
        $content = file_get_contents($file->getPathname());
        
        // Detectar encoding
        $encoding = mb_detect_encoding($content, ['UTF-8', 'ISO-8859-1', 'Windows-1252']);
        if ($encoding !== 'UTF-8') {
            $content = mb_convert_encoding($content, 'UTF-8', $encoding);
        }
        
        $lines = str_getcsv($content, "\n");
        $data = collect();
        
        foreach ($lines as $line) {
            if (trim($line)) {
                $data->push(str_getcsv($line, ';'));
            }
        }
        
        return $data;
    }
    
    /**
     * Valida las cabeceras del CSV
     */
    protected function validateHeaders(array $headers): void
    {
        $headers = array_map('trim', $headers);
        $missing = array_diff($this->requiredHeaders, $headers);
        
        if (!empty($missing)) {
            throw new CsvImportException(
                'Faltan columnas requeridas: ' . implode(', ', $missing)
            );
        }
    }
    
    /**
     * Procesa una fila individual
     */
    protected function processRow(array $row, int $rowNumber, array &$results): void
    {
        $data = $this->mapRowToData($row);
        $this->validateRowData($data, $rowNumber);
        
        $model = $this->createOrUpdateModel($data);
        
        if ($model) {
            $results['success']++;
        } else {
            $results['skipped']++;
        }
    }
    
    /**
     * Mapea una fila a datos del modelo
     */
    protected function mapRowToData(array $row): array
    {
        // Implementar en clases hijas
        return [];
    }
    
    /**
     * Valida los datos de una fila
     */
    protected function validateRowData(array $data, int $rowNumber): void
    {
        $validator = Validator::make($data, $this->validationRules);
        
        if ($validator->fails()) {
            throw new CsvValidationException(
                "Fila {$rowNumber}: " . implode(', ', $validator->errors()->all())
            );
        }
    }
    
    /**
     * Crea o actualiza el modelo
     */
    protected function createOrUpdateModel(array $data)
    {
        return $this->modelClass::create($data);
    }
    
    /**
     * Genera template CSV para descarga
     */
    public function generateTemplate(): string
    {
        $headers = $this->requiredHeaders;
        $exampleRow = $this->getExampleRow();
        
        $csv = implode(';', $headers) . "\n";
        $csv .= implode(';', $exampleRow) . "\n";
        
        return $csv;
    }
    
    /**
     * Obtiene fila de ejemplo para template
     */
    protected function getExampleRow(): array
    {
        // Implementar en clases hijas
        return [];
    }
}
