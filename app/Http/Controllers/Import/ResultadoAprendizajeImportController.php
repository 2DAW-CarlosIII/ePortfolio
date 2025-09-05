<?php

namespace App\Http\Controllers\Import;

use App\Models\ResultadoAprendizaje;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResultadoAprendizajeImportController extends BaseImportController
{
    protected string $modelClass = ResultadoAprendizaje::class;
    protected string $resourceName = 'resultados_aprendizaje';

}
