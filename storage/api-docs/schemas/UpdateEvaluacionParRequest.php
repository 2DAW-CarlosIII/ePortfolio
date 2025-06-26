<?php

/**
 * @OA\Schema(
 *     schema="UpdateEvaluacionParRequest",
 *     type="object",
 *     title="Update EvaluacionPar Request",
 *     description="Request body for updating a EvaluacionPar",
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
 *             description="Evaluation date"
 *         ),
 * )
 */
class UpdateEvaluacionParRequestSchema
{
    // This class is used only for OpenAPI documentation
}
