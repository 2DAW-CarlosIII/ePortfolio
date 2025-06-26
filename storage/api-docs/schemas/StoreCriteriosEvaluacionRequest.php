<?php

/**
 * @OA\Schema(
 *     schema="StoreCriteriosEvaluacionRequest",
 *     type="object",
 *     title="Store CriteriosEvaluacion Request",
 *     description="Request body for creating a new CriteriosEvaluacion",
 *     required={"codigo", "descripcion", "peso_porcentaje", "orden"},
 *         @OA\Property(
 *             property="resultado_aprendizaje_id",
 *             type="integer",
 *             description="Resultado Aprendizaje Id"
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
class StoreCriteriosEvaluacionRequestSchema
{
    // This class is used only for OpenAPI documentation
}
