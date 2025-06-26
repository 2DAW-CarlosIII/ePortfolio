<?php

namespace App\Traits\Import;

trait MatriculaImportable
{
    /**
     * Obtiene los campos importables para Matricula
     */
    public static function getImportableFields(): array
    {
        return [
            [
                'name' => 'estudiante_id',
                'type' => 'bigint',
                'required' => false,
                'foreign_key' => true,
                'validation' => ['required', 'integer', 'exists:table,id']
            ],
            [
                'name' => 'modulo_formativo_id',
                'type' => 'bigint',
                'required' => false,
                'foreign_key' => true,
                'validation' => ['required', 'integer', 'exists:table,id']
            ],
            [
                'name' => 'fecha_matricula',
                'type' => 'date',
                'required' => true,
                'foreign_key' => false,
                'validation' => ['required', 'date']
            ],
            [
                'name' => 'estado',
                'type' => 'enum',
                'required' => true,
                'foreign_key' => false,
                'validation' => ['required', 'in:value1,value2']
            ],
        ];
    }
}
