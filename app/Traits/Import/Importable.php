<?php

namespace App\Traits\Import;

use Illuminate\Http\UploadedFile;

trait Importable
{
    /**
     * Importa datos desde un archivo CSV
     */
    public static function importFromCsv(UploadedFile $file, array $options = []): array
    {
        $serviceName = 'App\\Services\\Import\\' . class_basename(static::class) . 'ImportService';
        
        if (!class_exists($serviceName)) {
            throw new \Exception("Servicio de importación no encontrado: {$serviceName}");
        }
        
        $service = new $serviceName();
        return $service->process($file, $options);
    }
    
    /**
     * Genera template CSV para importación
     */
    public static function generateImportTemplate(): string
    {
        $serviceName = 'App\\Services\\Import\\' . class_basename(static::class) . 'ImportService';
        
        if (!class_exists($serviceName)) {
            throw new \Exception("Servicio de importación no encontrado: {$serviceName}");
        }
        
        $service = new $serviceName();
        return $service->generateTemplate();
    }
    
    /**
     * Obtiene los campos importables
     */
    public static function getImportableFields(): array
    {
        // Override en cada modelo si es necesario
        return [];
    }
}
