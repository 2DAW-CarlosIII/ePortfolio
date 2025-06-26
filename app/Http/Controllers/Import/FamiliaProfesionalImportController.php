<?php

namespace App\Http\Controllers\Import;

use App\Models\FamiliaProfesional;
use App\Http\Requests\Import\FamiliaProfesionalImportRequest;

class FamiliaProfesionalImportController extends BaseImportController
{
    protected string $modelClass = FamiliaProfesional::class;
    protected string $resourceName = 'FamiliaProfesional';
}
