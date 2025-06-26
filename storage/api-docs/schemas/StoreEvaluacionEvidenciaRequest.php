<?php

/**
 * @OA\Schema(
 *     schema="StoreEvaluacionEvidenciaRequest",
 *     type="object",
 *     title="Store EvaluacionEvidencia Request",
 *     description="Request body for creating a new EvaluacionEvidencia",
 *     required={"puntuacion", "estado", "observaciones", "fecha_evaluacion"},
 *         @OA\Property(
 *             property="evidencia_id",
 *             type="integer",
 *             description="Evidencia Id"
 *         ),
 *         @OA\Property(
 *             property="docente_id",
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
class StoreEvaluacionEvidenciaRequestSchema
{
    // This class is used only for OpenAPI documentation
}
