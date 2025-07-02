<?php

/**
 * @OA\Schema(
 *     schema="UpdateEvaluacionEvidenciaRequest",
 *     type="object",
 *     title="Update EvaluacionEvidencia Request",
 *     description="Request body for updating a EvaluacionEvidencia",
 *         @OA\Property(
 *             property="evidencia_id",
 *             type="integer",
 *             description="Evidencia Id"
 *         ),
 *         @OA\Property(
 *             property="user_id",
 *             type="integer",
 *             description="Docente Id"
 *         ),
 *         @OA\Property(
 *             property="puntuacion",
 *             type="number",
 *             description="Score"
 *         ),
 *         @OA\Property(
 *             property="estado",
 *             type="string",
 *             enum={"pendiente", "aprobada", "rechazada"},
 *             description="Status"
 *         ),
 *         @OA\Property(
 *             property="observaciones",
 *             type="string",
 *             description="Observations"
 *         ),
 *         @OA\Property(
 *             property="fecha_evaluacion",
 *             type="string",
 *             description="Evaluation date"
 *         ),
 * )
 */
class UpdateEvaluacionEvidenciaRequestSchema
{
    // This class is used only for OpenAPI documentation
}
