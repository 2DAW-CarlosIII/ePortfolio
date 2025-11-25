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
    Route::apiResource('familias-profesionales', App\Http\Controllers\Api\FamiliaProfesionalController::class)->parameters([
        'familias-profesionales' => 'familiaProfesional'
    ]);
    Route::apiResource('roles', App\Http\Controllers\Api\RolController::class)
        ->parameters(['roles' => 'rol']);
    // Nested API Resource routes

    Route::apiResource('familias-profesionales.ciclos-formativos', App\Http\Controllers\Api\CicloFormativoController::class)->parameters([
        'familias-profesionales' => 'familiaProfesional',
        'ciclos-formativos' => 'cicloFormativo'
    ]);
    Route::apiResource('ciclos-formativos.modulos-formativos', App\Http\Controllers\Api\ModuloFormativoController::class)->parameters([
        'ciclos-formativos' => 'cicloFormativo',
        'modulos-formativos' => 'moduloFormativo'
    ]);
    Route::apiResource('modulos-formativos.resultados-aprendizaje', App\Http\Controllers\Api\ResultadoAprendizajeController::class)
        ->parameters([
            'modulos-formativos' => 'moduloFormativo',
            'resultados-aprendizaje' => 'resultadoAprendizaje'
        ]);
    Route::apiResource('resultados-aprendizaje.criterios-evaluacion', App\Http\Controllers\Api\CriteriosEvaluacionController::class)->parameters([
        'resultados-aprendizaje' => 'resultadoAprendizaje',
        'criterios-evaluacion' => 'criterioEvaluacion'
    ]);
    Route::apiResource('evidencias.asignaciones-revision', App\Http\Controllers\Api\AsignacionRevisionController::class)
        ->parameters(['asignaciones-revision' => 'asignacionRevision']);
    Route::apiResource('evidencias.evaluaciones-evidencias', App\Http\Controllers\Api\EvaluacionEvidenciaController::class)->parameters(['evaluaciones-evidencias' => 'evaluacionEvidencia']);
    Route::apiResource('evidencias.comentarios', App\Http\Controllers\Api\ComentarioController::class);
    Route::apiResource('users.modulos-formativos', App\Http\Controllers\Api\ModuloFormativoController::class)->parameters(['users' => 'user']);
    Route::apiResource('modulos-formativos.matriculas', App\Http\Controllers\Api\MatriculaController::class)->parameters(['modulos-formativos' => 'moduloFormativo']);
    Route::post('matriculas', [App\Http\Controllers\Api\MatriculaController::class, 'batchStore'])
        ->name('api.matriculas.batchStore');
    Route::apiResource('criterios-evaluacion.tareas', App\Http\Controllers\Api\TareaController::class)
        ->except(['store', 'update', 'destroy'])
        ->parameters([
            'criterios-evaluacion' => 'criterioEvaluacion',
            'tareas' => 'tarea'
        ]);
    Route::post('tareas', [App\Http\Controllers\Api\TareaController::class, 'store'])
        ->name('api.tareas.store');
    Route::put('tareas/{tarea}', [App\Http\Controllers\Api\TareaController::class, 'update'])
        ->name('api.tareas.update');
    Route::delete('tareas/{tarea}', [App\Http\Controllers\Api\TareaController::class, 'destroy'])
        ->name('api.tareas.destroy');
    Route::post('tareas/{tarea}/asignacion-aleatoria', [App\Http\Controllers\Api\TareaController::class, 'asignacionAleatoria'])
        ->name('api.tareas.asignacion-aleatoria');
    Route::get('resultados-aprendizaje/{parent_id}/tareas', [App\Http\Controllers\Api\TareaController::class, 'tareasPorResultadoAprendizaje'])
        ->name('api.resultados-aprendizaje.tareas');
    Route::apiResource('tareas.evidencias', App\Http\Controllers\Api\EvidenciaController::class);

    // User management routes (if needed)
    Route::apiResource('users', App\Http\Controllers\Api\UserController::class)
        ->only(['index', 'show', 'update']);
    Route::get('modulos-matriculados', [App\Http\Controllers\Api\MatriculaController::class, 'modulosMatriculados'])
        ->name('api.matriculas.modulos-matriculados');
    Route::get('modulos-impartidos', [App\Http\Controllers\Api\ModuloFormativoController::class, 'modulosImpartidos'])
        ->name('api.modulos-formativos.modulos-impartidos');
    Route::get('docentes', [App\Http\Controllers\Api\UserController::class, 'getDocentes'])
        ->name('api.users.getDocentes');
    Route::get('estudiantes', [App\Http\Controllers\Api\UserController::class, 'getEstudiantes'])
        ->name('api.users.estudiantes');
    Route::get('user', [App\Http\Controllers\Api\UserController::class, 'profile'])
        ->name('api.users.profile');
    Route::get('users/{user}/evidencias', [App\Http\Controllers\Api\EvidenciaController::class, 'userEvidencias'])
        ->name('api.users.evidencias');
    Route::get('users/{user}/asignaciones-revision', [App\Http\Controllers\Api\AsignacionRevisionController::class, 'userAsignacionesRevision'])
        ->name('api.users.asignaciones-revision');

    require __DIR__.'/import.php';
});

// Public routes (no authentication required)
Route::prefix('v1')->group(function () {
    // Public health check
    Route::get('/ping', function () {
        return response()->json(['message' => 'pong']);
    });
});
