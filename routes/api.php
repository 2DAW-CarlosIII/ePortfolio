<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ePortfolio API Routes - Generated automatically
// Do not modify this section manually

Route::prefix('v1')->middleware(['auth:sanctum'])->group(function () {

    // Health check endpoint
    Route::get('/health', function () {
        return response()->json([
            'status' => 'healthy',
            'timestamp' => now()->toISOString(),
            'version' => 'v1.0'
        ]);
    });

    // Statistics endpoints
    Route::prefix('stats')->controller(App\Http\Controllers\Api\StatsController::class)->group(function () {
        Route::get('/', 'index')->name('api.stats.index');
        Route::get('/estudiantes', 'estudiantes')->name('api.stats.estudiantes');
        Route::get('/evidencias', 'evidencias')->name('api.stats.evidencias');
    });

    // Standard API Resource routes
    Route::apiResource('familias-profesionales', App\Http\Controllers\Api\FamiliaProfesionalController::class);
    Route::apiResource('roles', App\Http\Controllers\Api\RolController::class);

    // Nested API Resource routes
    Route::apiResource('familias-profesionales.ciclos-formativos', App\Http\Controllers\Api\CicloFormativoController::class)->parameters(['familias-profesionales' => 'familias_profesionale']);
    Route::apiResource('users.modulos-formativos', App\Http\Controllers\Api\ModuloFormativoController::class)->parameters(['users' => 'user']);
    Route::apiResource('modulos-formativos.resultados-aprendizaje', App\Http\Controllers\Api\ResultadoAprendizajeController::class)->parameters(['modulos-formativos' => 'modulos_formativo']);
    Route::apiResource('resultados-aprendizaje.criterios-evaluacion', App\Http\Controllers\Api\CriteriosEvaluacionController::class)->parameters(['resultados-aprendizaje' => 'resultados_aprendizaje']);
    Route::apiResource('modulos-formativos.user-roles', App\Http\Controllers\Api\UserRolController::class)->parameters(['modulos-formativos' => 'modulos_formativo']);
    Route::apiResource('modulos-formativos.matriculas', App\Http\Controllers\Api\MatriculaController::class)->parameters(['modulos-formativos' => 'modulos_formativo']);
    Route::apiResource('modulos-formativos.planificacion-criterios', App\Http\Controllers\Api\PlanificacionCriteriosController::class)->parameters(['modulos-formativos' => 'modulos_formativo']);
    Route::apiResource('criterios-evaluacion.evidencias', App\Http\Controllers\Api\EvidenciaController::class)->parameters(['criterios-evaluacion' => 'criterios_evaluacion']);
    Route::apiResource('users.evaluaciones-evidencias', App\Http\Controllers\Api\EvaluacionEvidenciaController::class)->parameters(['users' => 'user']);
    Route::apiResource('users.comentarios', App\Http\Controllers\Api\ComentarioController::class)->parameters(['users' => 'user']);
    Route::apiResource('users.asignaciones-revision', App\Http\Controllers\Api\AsignacionRevisionController::class)->parameters(['users' => 'user']);
    Route::apiResource('users.evaluaciones-pares', App\Http\Controllers\Api\EvaluacionParController::class)->parameters(['users' => 'user']);
    Route::apiResource('users.comentarios-pares', App\Http\Controllers\Api\ComentarioParController::class)->parameters(['users' => 'user']);

    // User management routes (if needed)
    Route::apiResource('users', App\Http\Controllers\Api\UserController::class)
        ->only(['index', 'show', 'update']);

});

// Public routes (no authentication required)
Route::prefix('v1')->group(function () {
    // Public health check
    Route::get('/ping', function () {
        return response()->json(['message' => 'pong']);
    });
});
