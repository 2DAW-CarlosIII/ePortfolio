<?php

/**
 * @OA\Schema(
 *     schema="UpdateResultadoAprendizajeRequest",
 *     type="object",
 *     title="Update ResultadoAprendizaje Request",
 *     description="Request body for updating a ResultadoAprendizaje",
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
 * )
 */
class UpdateResultadoAprendizajeRequestSchema
{
    // This class is used only for OpenAPI documentation
}
