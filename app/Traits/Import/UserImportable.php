<?php

namespace App\Traits\Import;

trait UserImportable
{
    /**
     * Obtiene los campos importables para User
     */
    public static function getImportableFields(): array
    {
        return [
            [
                'name' => 'name',
                'type' => 'varchar',
                'required' => true,
                'foreign_key' => false,
                'validation' => ['required', 'string', 'max:255']
            ],
            [
                'name' => 'email',
                'type' => 'varchar',
                'required' => true,
                'foreign_key' => false,
                'validation' => ['required', 'string', 'max:255', 'email']
            ],
            [
                'name' => 'email_verified_at',
                'type' => 'timestamp',
                'required' => false,
                'foreign_key' => false,
                'validation' => ['nullable']
            ],
            [
                'name' => 'password',
                'type' => 'varchar',
                'required' => true,
                'foreign_key' => false,
                'validation' => ['required', 'string', 'max:255']
            ],
        ];
    }
}
