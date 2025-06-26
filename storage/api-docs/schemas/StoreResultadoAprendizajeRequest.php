<?php

/**
 * @OA\Schema(
 *     schema="StoreResultadoAprendizajeRequest",
 *     type="object",
 *     title="Store ResultadoAprendizaje Request",
 *     description="Request body for creating a new ResultadoAprendizaje",
 *     required={"codigo", "descripcion", "peso_porcentaje", "orden"},
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
class StoreResultadoAprendizajeRequestSchema
{
    // This class is used only for OpenAPI documentation
}
