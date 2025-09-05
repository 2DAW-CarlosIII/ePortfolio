<?php

namespace App\Http\Controllers\Import;

use App\Models\CriterioEvaluacion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CriteriosEvaluacionImportController extends BaseImportController
{
    protected string $modelClass = CriterioEvaluacion::class;
    protected string $resourceName = 'criterios_evaluacion';

}
