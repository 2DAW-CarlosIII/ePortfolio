<?php

namespace App\Traits\Import;

trait ModuloFormativoImportable
{
    /**
     * Obtiene los campos importables para ModuloFormativo
     */
    public static function getImportableFields(): array
    {
        return [
            [
                'name' => 'ciclo_formativo_id',
                'type' => 'bigint',
                'required' => false,
                'foreign_key' => true,
                'validation' => ['required', 'integer', 'exists:ciclos_formativos,id']
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
                'name' => 'horas_totales',
                'type' => 'int',
                'required' => true,
                'foreign_key' => false,
                'validation' => ['required', 'integer']
            ],
            [
                'name' => 'curso_escolar',
                'type' => 'varchar',
                'required' => true,
                'foreign_key' => false,
                'validation' => ['required', 'string', 'max:255']
            ],
            [
                'name' => 'centro',
                'type' => 'varchar',
                'required' => true,
                'foreign_key' => false,
                'validation' => ['required', 'string', 'max:255']
            ],
            [
                'name' => 'docente_id',
                'type' => 'bigint',
                'required' => false,
                'foreign_key' => true,
                'validation' => ['required', 'integer', 'exists:users,id']
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
