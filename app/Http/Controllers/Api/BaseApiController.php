<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     title="ePortfolio API",
 *     version="1.0.0",
 *     description="API para el sistema de portfolio electrónico de estudiantes",
 *     @OA\Contact(
 *         email="admin@eportfolio.com",
 *         name="ePortfolio Support"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000/api/v1",
 *     description="Local development server"
 * )
 *
 * @OA\Server(
 *     url="http://eportfolio.test/api/v1",
 *     description="Local development server"
 * )
 *
 * @OA\Server(
 *     url="http://eportfolio.cifpcarlos3.es/api/v1",
 *     description="Production server"
 * )
 *
 * @OA\Server(
 *     url="http://eportfolio.juezlti.eu/api/v1",
 *     description="Production server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Laravel Sanctum authentication"
 * )
 *
 * @OA\Tag(
 *     name="Authentication",
 *     description="Authentication endpoints"
 * )
 *
 * @OA\Tag(
 *     name="Statistics",
 *     description="Statistics and analytics endpoints"
 * )
 *
 * @OA\Tag(
 *     name="Health",
 *     description="Health check endpoints"
 * )
 */
class BaseApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/health",
     *     tags={"Health"},
     *     summary="Health check endpoint",
     *     description="Returns the health status of the API",
     *     @OA\Response(
     *         response=200,
     *         description="API is healthy",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="healthy"),
     *             @OA\Property(property="timestamp", type="string", format="date-time"),
     *             @OA\Property(property="version", type="string", example="v1.0")
     *         )
     *     )
     * )
     */
    public function health()
    {
        return response()->json([
            'status' => 'healthy',
            'timestamp' => now()->toISOString(),
            'version' => 'v1.0'
        ]);
    }
}
