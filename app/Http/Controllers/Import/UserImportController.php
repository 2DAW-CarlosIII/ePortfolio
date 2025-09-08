<?php

namespace App\Http\Controllers\Import;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserImportController extends BaseImportController
{
    protected string $modelClass = User::class;
    protected string $resourceName = 'users';

/**
 * @OA\Get(
 *     path="/users/import",
 *     summary="Obtener información para importar Usuarios",
 *     description="Devuelve los campos importables y la URL del template para Usuarios",
 *     security={{"sanctum":{}}},
 *     tags={"Import"},
 *     @OA\Response(
 *         response=200,
 *         description="Información de importación obtenida correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="resource", type="string", example="User"),
 *             @OA\Property(
 *                 property="fields",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="name", type="string", example="codigo"),
 *                     @OA\Property(property="type", type="string", example="varchar"),
 *                     @OA\Property(property="required", type="boolean", example=true),
 *                     @OA\Property(property="foreign_key", type="boolean", example=false),
 *                     @OA\Property(
 *                         property="validation",
 *                         type="array",
 *                         @OA\Items(type="string", example="required")
 *                     )
 *                 )
 *             ),
 *             @OA\Property(property="template_url", type="string", example="http://eportfolio.test/api/v1/import/template/users")
 *         )
 *     )
 * )
 */

    public function show(): JsonResponse {
        return parent::show();
    }

/**
 * @OA\Post(
 *     path="/users/import",
 *     summary="Importar Usuarios desde CSV",
 *     description="Procesa un archivo CSV e importa los Usuarios contenidos en él",
 *     security={{"sanctum":{}}},
 *     tags={"Import"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 required={"file"},
 *                 @OA\Property(
 *                     property="file",
 *                     type="string",
 *                     format="binary",
 *                     description="Archivo CSV con los datos a importar (máximo 50MB)"
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Importación procesada correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Importación completada"),
 *             @OA\Property(
 *                 property="results",
 *                 type="object",
 *                 @OA\Property(property="success", type="integer", example=15),
 *                 @OA\Property(property="errors", type="integer", example=2),
 *                 @OA\Property(property="skipped", type="integer", example=1),
 *                 @OA\Property(
 *                     property="details",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="row", type="integer", example=5),
 *                         @OA\Property(property="error", type="string", example="El campo código es requerido"),
 *                         @OA\Property(
 *                             property="data",
 *                             type="array",
 *                             @OA\Items(type="string")
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación en el archivo o datos",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Faltan columnas requeridas: codigo, descripcion")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error en el archivo enviado",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="El archivo debe ser CSV"),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="file",
 *                     type="array",
 *                     @OA\Items(type="string", example="El archivo debe ser de tipo CSV")
 *                 )
 *             )
 *         )
 *     )
 * )
 */

    public function store(Request $request): JsonResponse {
        return parent::store($request);
    }

/**
 * @OA\Get(
 *     path="/users/import/template",
 *     summary="Descargar template CSV para Usuarios",
 *     description="Descarga un archivo CSV de ejemplo con la estructura correcta para importar Usuarios",
 *     security={{"sanctum":{}}},
 *     tags={"Import"},
 *     @OA\Response(
 *         response=200,
 *         description="Template CSV descargado correctamente",
 *         @OA\MediaType(
 *             mediaType="text/csv",
 *             @OA\Schema(
 *                 type="string",
 *                 format="binary"
 *             )
 *         ),
 *         @OA\Header(
 *             header="Content-Disposition",
 *             description="Indica el nombre del archivo",
 *             @OA\Schema(type="string", example="attachment; filename='users_template.csv'")
 *         ),
 *         @OA\Header(
 *             header="Content-Type",
 *             description="Tipo de contenido del archivo",
 *             @OA\Schema(type="string", example="text/csv; charset=UTF-8")
 *         )
 *     )
 * )
 */

    public function template(): StreamedResponse {
        return parent::template();
    }

}
