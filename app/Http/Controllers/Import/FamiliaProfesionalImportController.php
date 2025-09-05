<?php

namespace App\Http\Controllers\Import;

use App\Models\FamiliaProfesional;

class FamiliaProfesionalImportController extends BaseImportController
{
    protected string $modelClass = FamiliaProfesional::class;
    protected string $resourceName = 'familias_profesionales';
}
