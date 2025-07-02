<?php

/**
 * @OA\Schema(
 *     schema="EvaluacionEvidencia",
 *     type="object",
 *     title="EvaluacionEvidencia",
 *     description="EvaluacionEvidencia model",
 *     @OA\Xml(name="EvaluacionEvidencia"),
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="Unique identifier"
 *         ),
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
class EvaluacionEvidenciaSchema
{
    // This class is used only for OpenAPI documentation
}
