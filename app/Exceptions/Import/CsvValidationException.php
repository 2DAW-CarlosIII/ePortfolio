<?php

namespace App\Exceptions\Import;

class CsvValidationException extends CsvImportException
{
    protected array $errors = [];
    
    public function __construct(string $message = "", array $errors = [])
    {
        parent::__construct($message);
        $this->errors = $errors;
    }
    
    public function getErrors(): array
    {
        return $this->errors;
    }
}
