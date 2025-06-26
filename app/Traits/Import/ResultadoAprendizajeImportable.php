<?php

namespace App\Traits\Import;

trait ResultadoAprendizajeImportable
{
    /**
     * Obtiene los campos importables para ResultadoAprendizaje
     */
    public static function getImportableFields(): array
    {
        return [
            [
                'name' => 'modulo_formativo_id',
                'type' => 'bigint',
                'required' => false,
                'foreign_key' => true,
                'validation' => ['required', 'integer', 'exists:table,id']
            ],
            [
                'name' => 'codigo',
                'type' => 'varchar',
                'required' => true,
                'foreign_key' => false,
                'validation' => ['required', 'string', 'max:255']
            ],
            [
                'name' => 'descripcion',
                'type' => 'text',
                'required' => true,
                'foreign_key' => false,
                'validation' => ['required', 'string']
            ],
            [
                'name' => 'peso_porcentaje',
                'type' => 'decimal',
                'required' => true,
                'foreign_key' => false,
                'validation' => ['required', 'numeric']
            ],
            [
                'name' => 'orden',
                'type' => 'int',
                'required' => true,
                'foreign_key' => false,
                'validation' => ['required', 'integer']
            ],
        ];
    }
}
