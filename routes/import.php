<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - Import
|--------------------------------------------------------------------------
|
| Rutas para funcionalidad de importación CSV
|
*/


// Importación de FamiliaProfesional
Route::prefix('familias-profesionales')->group(function () {
    Route::get('import', [App\Http\Controllers\Import\FamiliaProfesionalImportController::class, 'show'])
        ->name('api.familias-profesionales.import.show');
    Route::post('import', [App\Http\Controllers\Import\FamiliaProfesionalImportController::class, 'store'])
        ->name('api.familias-profesionales.import.store');
    Route::get('import/template', [App\Http\Controllers\Import\FamiliaProfesionalImportController::class, 'template'])
        ->name('api.familias-profesionales.import.template');
});

// Importación de CicloFormativo (anidado en FamiliaProfesional)
Route::prefix('familias-profesionales/{parent}/ciclos-formativos')->group(function () {
    Route::get('import', [App\Http\Controllers\Import\CicloFormativoImportController::class, 'show'])
        ->name('api.familias-profesionales.ciclos-formativos.import.show');
    Route::post('import', [App\Http\Controllers\Import\CicloFormativoImportController::class, 'store'])
        ->name('api.familias-profesionales.ciclos-formativos.import.store');
    Route::get('import/template', [App\Http\Controllers\Import\CicloFormativoImportController::class, 'template'])
        ->name('api.familias-profesionales.ciclos-formativos.import.template');
});

// Importación de ModuloFormativo (anidado en CicloFormativo)
Route::prefix('ciclos-formativos/{parent}/modulos-formativos')->group(function () {
    Route::get('import', [App\Http\Controllers\Import\ModuloFormativoImportController::class, 'show'])
        ->name('api.ciclos-formativos.modulos-formativos.import.show');
    Route::post('import', [App\Http\Controllers\Import\ModuloFormativoImportController::class, 'store'])
        ->name('api.ciclos-formativos.modulos-formativos.import.store');
    Route::get('import/template', [App\Http\Controllers\Import\ModuloFormativoImportController::class, 'template'])
        ->name('api.ciclos-formativos.modulos-formativos.import.template');
});

// Importación de ResultadoAprendizaje (anidado en ModuloFormativo)
Route::prefix('modulos-formativos/{parent}/resultados-aprendizaje')->group(function () {
    Route::get('import', [App\Http\Controllers\Import\ResultadoAprendizajeImportController::class, 'show'])
        ->name('api.modulos-formativos.resultados-aprendizaje.import.show');
    Route::post('import', [App\Http\Controllers\Import\ResultadoAprendizajeImportController::class, 'store'])
        ->name('api.modulos-formativos.resultados-aprendizaje.import.store');
    Route::get('import/template', [App\Http\Controllers\Import\ResultadoAprendizajeImportController::class, 'template'])
        ->name('api.modulos-formativos.resultados-aprendizaje.import.template');
});

// Importación de CriteriosEvaluacion (anidado en ResultadoAprendizaje)
Route::prefix('resultados-aprendizaje/{parent}/criterios-evaluacion')->group(function () {
    Route::get('import', [App\Http\Controllers\Import\CriteriosEvaluacionImportController::class, 'show'])
        ->name('api.resultados-aprendizaje.criterios-evaluacion.import.show');
    Route::post('import', [App\Http\Controllers\Import\CriteriosEvaluacionImportController::class, 'store'])
        ->name('api.resultados-aprendizaje.criterios-evaluacion.import.store');
    Route::get('import/template', [App\Http\Controllers\Import\CriteriosEvaluacionImportController::class, 'template'])
        ->name('api.resultados-aprendizaje.criterios-evaluacion.import.template');
});

// Importación de User
Route::prefix('users')->group(function () {
    Route::get('import', [App\Http\Controllers\Import\UserImportController::class, 'show'])
        ->name('api.users.import.show');
    Route::post('import', [App\Http\Controllers\Import\UserImportController::class, 'store'])
        ->name('api.users.import.store');
    Route::get('import/template', [App\Http\Controllers\Import\UserImportController::class, 'template'])
        ->name('api.users.import.template');
});

// Importación de Matricula (anidado en ModuloFormativo)
Route::prefix('modulos-formativos/{parent}/matriculas')->group(function () {
    Route::get('import', [App\Http\Controllers\Import\MatriculaImportController::class, 'show'])
        ->name('api.modulos-formativos.matriculas.import.show');
    Route::post('import', [App\Http\Controllers\Import\MatriculaImportController::class, 'store'])
        ->name('api.modulos-formativos.matriculas.import.store');
    Route::get('import/template', [App\Http\Controllers\Import\MatriculaImportController::class, 'template'])
        ->name('api.modulos-formativos.matriculas.import.template');
});

// Ruta genérica para templates
Route::get('import/template/{resource}', function($resource) {
    $controllers = [
        'familias_profesionales' => App\Http\Controllers\Import\FamiliaProfesionalImportController::class,
        'ciclos_formativos' => App\Http\Controllers\Import\CicloFormativoImportController::class,
        'modulos_formativos' => App\Http\Controllers\Import\ModuloFormativoImportController::class,
        'resultados_aprendizaje' => App\Http\Controllers\Import\ResultadoAprendizajeImportController::class,
        'criterios_evaluacion' => App\Http\Controllers\Import\CriteriosEvaluacionImportController::class,
        'users' => App\Http\Controllers\Import\UserImportController::class,
        'matriculas' => App\Http\Controllers\Import\MatriculaImportController::class,
    ];
    
    if (!isset($controllers[$resource])) {
        abort(404, 'Resource not found');
    }
    
    $controller = new $controllers[$resource]();
    return $controller->template();
})->name('api.import.template');
