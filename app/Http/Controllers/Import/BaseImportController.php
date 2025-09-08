<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\Import\CsvValidationException;
use App\Exceptions\Import\CsvImportException;

/**
 * @OA\Tag(
 *     name="Import",
 *     description="Endpoints para importación masiva de datos mediante archivos CSV"
 * )
 */

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
            $results = $this->importFromCSV($request->file('file'));

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
     * Procesa importación CSV de forma centralizada
     */
    protected function importFromCSV(\Illuminate\Http\UploadedFile $file): array
    {
        $this->validateFile($file);

        $data = $this->parseCSV($file);
        $fields = $this->modelClass::getImportableFields();
        $this->validateHeaders($data->first(), $fields);

        $results = [
            'success' => 0,
            'errors' => 0,
            'skipped' => 0,
            'details' => []
        ];

        foreach ($data->skip(1) as $index => $row) {
            try {
                $this->processRow($row, $index + 2, $fields, $results);
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
    protected function validateFile(\Illuminate\Http\UploadedFile $file): void
    {
        if (!$file->isValid()) {
            throw new CsvImportException('Archivo inválido');
        }

        if (!in_array($file->getClientOriginalExtension(), ['csv', 'txt'])) {
            throw new CsvImportException('El archivo debe ser CSV');
        }

        if ($file->getSize() > 50 * 1024 * 1024) { // 50MB
            throw new CsvImportException('El archivo es demasiado grande (máximo 50MB)');
        }
    }

    /**
     * Parsea el archivo CSV
     */
    protected function parseCSV(\Illuminate\Http\UploadedFile $file): \Illuminate\Support\Collection
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
    protected function validateHeaders(array $headers, array $fields): void
    {
        $headers = array_map('trim', $headers);
        $requiredHeaders = collect($fields)
            ->filter(fn($field) => $field['required'])
            ->pluck('name')
            ->toArray();

        $missing = array_diff($requiredHeaders, $headers);

        if (!empty($missing)) {
            throw new CsvImportException(
                'Faltan columnas requeridas: ' . implode(', ', $missing)
            );
        }
    }

    /**
     * Procesa una fila individual del CSV
     */
    protected function processRow(array $row, int $rowNumber, array $fields, array &$results): void
    {
        $data = $this->mapRowToData($row, $fields);
        $this->validateRowData($data, $fields, $rowNumber);

        $model = $this->createModel($data);

        if ($model) {
            $results['success']++;
        } else {
            $results['skipped']++;
        }
    }

    /**
     * Mapea una fila CSV a datos del modelo
     */
    protected function mapRowToData(array $row, array $fields): array
    {
        $data = [];

        foreach ($fields as $index => $field) {
            $fieldName = $field['name'];
            $fieldType = $field['type'];
            $value = $row[$index] ?? null;

            // Convertir valor según tipo
            $data[$fieldName] = $this->convertValue($value, $fieldType);
        }

        return $data;
    }

    /**
     * Convierte valor según el tipo de campo
     */
    protected function convertValue($value, string $type)
    {
        if (empty($value)) {
            return null;
        }

        return match($type) {
            'int', 'integer', 'bigint' => (int) $value,
            'decimal', 'float', 'double' => (float) $value,
            'boolean' => filter_var($value, FILTER_VALIDATE_BOOLEAN),
            'date' => date('Y-m-d', strtotime($value)),
            'datetime', 'timestamp' => date('Y-m-d H:i:s', strtotime($value)),
            default => trim($value)
        };
    }

    /**
     * Valida los datos de una fila
     */
    protected function validateRowData(array $data, array $fields, int $rowNumber): void
    {
        $rules = [];

        foreach ($fields as $field) {
            $rules[$field['name']] = $field['validation'] ?? [];
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new CsvValidationException(
                "Fila {$rowNumber}: " . implode(', ', $validator->errors()->all())
            );
        }
    }

    /**
     * Crea el modelo con los datos procesados
     */
    protected function createModel(array $data)
    {
        return $this->modelClass::create($data);
    }

/**
 * @OA\Get(
 *     path="/import/template/{resource}",
 *     summary="Descargar template CSV para el resource",
 *     description="Descarga un archivo CSV de ejemplo con la estructura correcta para importar el recurso enviado",
 *     security={{"sanctum":{}}},
 *     tags={"Import"},
 *     @OA\Parameter(
 *         name="resource",
 *         in="path",
 *         description="recurso sobre el que se quiere el template",
 *         required=true,
 *         @OA\Schema(type="string",
 *             enum={"familias_profesionales","ciclos_formativos","modulos_formativos","resultados_aprendizaje","criterios_evaluacion","users","matriculas"})
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Template CSV descargado correctamente",
 *         @OA\MediaType(
 *             mediaType="text/csv",
 *             @OA\Schema(
 *                 type="string",
 *                 format="binary"
 *             )
 *         ),
 *         @OA\Header(
 *             header="Content-Disposition",
 *             description="Indica el nombre del archivo",
 *             @OA\Schema(type="string", example="attachment; filename='resultados_aprendizaje_template.csv'")
 *         ),
 *         @OA\Header(
 *             header="Content-Type",
 *             description="Tipo de contenido del archivo",
 *             @OA\Schema(type="string", example="text/csv; charset=UTF-8")
 *         )
 *     )
 * )
 */
    public function template(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $fields = $this->modelClass::getImportableFields();
        $csv = $this->generateCSVTemplate($fields);
        $filename = strtolower($this->resourceName) . '_template.csv';

        return response()->streamDownload(function() use ($csv) {
            echo $csv;
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Content-Transfer-Encoding' => 'binary',
        ]);
    }

    /**
     * Genera plantilla CSV basada en campos importables
     */
    protected function generateCSVTemplate(array $fields): string
    {
        $headers = [];
        $exampleRow = [];

        foreach ($fields as $field) {
            // Nombre del campo como header
            $headers[] = $field['name'];

            // Generar valor de ejemplo basado en el tipo y nombre del campo
            $exampleRow[] = $this->generateExampleValue($field);
        }

        // Construir CSV con separador de punto y coma (compatible con Excel español)
        $csv = implode(';', $headers) . "\n";
        $csv .= implode(';', $exampleRow) . "\n";

        return $csv;
    }

    /**
     * Genera valor de ejemplo para un campo específico
     */
    protected function generateExampleValue(array $field): string
    {
        $fieldName = strtolower($field['name']);
        $fieldType = $field['type'];
        $isForeignKey = $field['foreign_key'] ?? false;

        // Ejemplos específicos por nombre de campo
        if (str_contains($fieldName, 'email')) {
            return 'usuario@ejemplo.com';
        }

        if (str_contains($fieldName, 'codigo')) {
            return 'COD001';
        }

        if (str_contains($fieldName, 'nombre')) {
            return 'Nombre de Ejemplo';
        }

        if (str_contains($fieldName, 'descripcion')) {
            return 'Descripción detallada del elemento';
        }

        if (str_contains($fieldName, 'telefono')) {
            return '600123456';
        }

        if (str_contains($fieldName, 'url') || str_contains($fieldName, 'web')) {
            return 'https://ejemplo.com';
        }

        // Si es clave foránea, dar ejemplo de búsqueda
        /*
        if ($isForeignKey) {
            return $this->getForeignKeyExample($fieldName);
        }
        */

        // Ejemplos por tipo de dato
        return match($fieldType) {
            'int', 'integer', 'bigint' => '123',
            'decimal', 'float', 'double' => '12.50',
            'boolean' => 'true',
            'date' => date('Y-m-d'),
            'datetime', 'timestamp' => date('Y-m-d H:i:s'),
            'enum' => 'valor1',
            'text' => 'Texto largo de ejemplo para este campo',
            default => 'Valor de ejemplo'
        };
    }

    /**
     * Genera ejemplo específico para claves foráneas
     */
    protected function getForeignKeyExample(string $fieldName): string
    {
        return match($fieldName) {
            'familia_profesional_id' => 'Informática y Comunicaciones',
            'ciclo_formativo_id' => 'Desarrollo de Aplicaciones Web',
            'modulo_formativo_id' => 'Desarrollo Web en Entorno Servidor',
            'resultado_aprendizaje_id' => 'RA01',
            'criterio_evaluacion_id' => 'CE01.1',
            'user_id' => 'usuario@ejemplo.com',
            'evidencia_id' => 'EV001',
            default => 'Buscar por nombre o código'
        };
    }
}
