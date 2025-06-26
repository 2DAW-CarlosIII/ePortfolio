<?php

/**
 * @OA\Schema(
 *     schema="CriteriosEvaluacion",
 *     type="object",
 *     title="CriteriosEvaluacion",
 *     description="CriteriosEvaluacion model",
 *     @OA\Xml(name="CriteriosEvaluacion"),
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="Unique identifier"
 *         ),
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
class CriteriosEvaluacionSchema
{
    // This class is used only for OpenAPI documentation
}
