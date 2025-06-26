<?php

/**
 * @OA\Schema(
 *     schema="EvaluacionPar",
 *     type="object",
 *     title="EvaluacionPar",
 *     description="EvaluacionPar model",
 *     @OA\Xml(name="EvaluacionPar"),
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="Unique identifier"
 *         ),
 *         @OA\Property(
 *             property="asignacion_revision_id",
 *             type="integer",
 *             description="Asignacion Revision Id"
 *         ),
 *         @OA\Property(
 *             property="revisor_id",
 *             type="integer",
 *             description="Revisor Id"
 *         ),
 *         @OA\Property(
 *             property="puntuacion_sugerida",
 *             type="number",
 *             description="Suggested score"
 *         ),
 *         @OA\Property(
 *             property="recomendacion",
 *             type="string",
 *             enum={"aprobar", "mejorar", "rechazar"},
 *             description="Recommendation"
 *         ),
 *         @OA\Property(
 *             property="justificacion",
 *             type="string",
 *             description="Justification"
 *         ),
 *         @OA\Property(
 *             property="fecha_evaluacion",
 *             type="string",
 *             format="date-time",
 *             description="Evaluation date"
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
class EvaluacionParSchema
{
    // This class is used only for OpenAPI documentation
}
