<?php

namespace App\Http\Controllers\Import;

use App\Models\Matricula;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MatriculaImportController extends BaseImportController
{
    protected string $modelClass = Matricula::class;
    protected string $resourceName = 'matriculas';

}
