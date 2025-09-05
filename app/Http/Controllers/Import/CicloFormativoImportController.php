<?php

namespace App\Http\Controllers\Import;

use App\Models\CicloFormativo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CicloFormativoImportController extends BaseImportController
{
    protected string $modelClass = CicloFormativo::class;
    protected string $resourceName = 'ciclos_formativos';
}
