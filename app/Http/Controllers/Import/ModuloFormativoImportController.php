<?php

namespace App\Http\Controllers\Import;

use App\Models\ModuloFormativo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ModuloFormativoImportController extends BaseImportController
{
    protected string $modelClass = ModuloFormativo::class;
    protected string $resourceName = 'modulos_formativos';

}
