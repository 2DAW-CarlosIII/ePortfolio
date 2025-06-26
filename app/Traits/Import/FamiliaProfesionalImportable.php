<?php

namespace App\Traits\Import;

trait FamiliaProfesionalImportable
{
    /**
     * Obtiene los campos importables para FamiliaProfesional
     */
    public static function getImportableFields(): array
    {
        return [
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
                'name' => 'descripcion',
                'type' => 'text',
                'required' => true,
                'foreign_key' => false,
                'validation' => ['required', 'string']
            ],
        ];
    }
}
