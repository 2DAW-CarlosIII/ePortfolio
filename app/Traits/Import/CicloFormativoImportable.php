<?php

namespace App\Traits\Import;

trait CicloFormativoImportable
{
    /**
     * Obtiene los campos importables para CicloFormativo
     */
    public static function getImportableFields(): array
    {
        return [
            [
                'name' => 'familia_profesional_id',
                'type' => 'bigint',
                'required' => false,
                'foreign_key' => true,
                'validation' => ['required', 'integer', 'exists:familias_profesionales,id']
            ],
            [
                'name' => 'nombre',
                'type' => 'varchar',
                'required' => true,
                'foreign_key' => false,
                'validation' => ['required', 'string', 'max:255']
            ],
            [
                'name' => 'codigo',
                'type' => 'varchar',
                'required' => true,
                'foreign_key' => false,
                'validation' => ['required', 'string', 'max:255']
            ],
            [
                'name' => 'grado',
                'type' => 'enum',
                'required' => true,
                'foreign_key' => false,
                'validation' => ['required', 'in:value1,value2']
            ],
            [
                'name' => 'descripcion',
                'type' => 'text',
                'required' => true,
                'foreign_key' => false,
                'validation' => ['required', 'string']
            ],
        ];
    }
}
