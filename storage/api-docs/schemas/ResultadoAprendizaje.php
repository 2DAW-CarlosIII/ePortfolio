<?php

/**
 * @OA\Schema(
 *     schema="ResultadoAprendizaje",
 *     type="object",
 *     title="ResultadoAprendizaje",
 *     description="ResultadoAprendizaje model",
 *     @OA\Xml(name="ResultadoAprendizaje"),
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="Unique identifier"
 *         ),
 *         @OA\Property(
 *             property="modulo_formativo_id",
 *             type="integer",
 *             description="Modulo Formativo Id"
 *         ),
 *         @OA\Property(
 *             property="codigo",
 *             type="string",
 *             description="Code"
 *         ),
 *         @OA\Property(
 *             property="descripcion",
 *             type="string",
 *             description="Description"
 *         ),
 *         @OA\Property(
 *             property="peso_porcentaje",
 *             type="number",
 *             description="Weight percentage"
 *         ),
 *         @OA\Property(
 *             property="orden",
 *             type="integer",
 *             description="Order"
 *         ),
 *         @OA\Property(
 *             property="created_at",
 *             type="string",
 *             format="date-time",
 *             description="Creation timestamp"
 *         ),
 *         @OA\Property(
 *             property="updated_at",
 *             type="string",
 *             format="date-time",
 *             description="Last update timestamp"
 *         ),
 * )
 */
class ResultadoAprendizajeSchema
{
    // This class is used only for OpenAPI documentation
}
