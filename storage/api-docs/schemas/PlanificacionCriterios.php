<?php

/**
 * @OA\Schema(
 *     schema="PlanificacionCriterios",
 *     type="object",
 *     title="PlanificacionCriterios",
 *     description="PlanificacionCriterios model",
 *     @OA\Xml(name="PlanificacionCriterios"),
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="Unique identifier"
 *         ),
 *         @OA\Property(
 *             property="criterio_evaluacion_id",
 *             type="integer",
 *             description="Criterio Evaluacion Id"
 *         ),
 *         @OA\Property(
 *             property="modulo_formativo_id",
 *             type="integer",
 *             description="Modulo Formativo Id"
 *         ),
 *         @OA\Property(
 *             property="fecha_apertura",
 *             type="string",
 *             format="date",
 *             description="Opening date"
 *         ),
 *         @OA\Property(
 *             property="fecha_cierre",
 *             type="string",
 *             format="date",
 *             description="Closing date"
 *         ),
 *         @OA\Property(
 *             property="activo",
 *             type="boolean",
 *             description="Active status"
 *         ),
 *         @OA\Property(
 *             property="observaciones",
 *             type="string",
 *             description="Observations"
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
class PlanificacionCriteriosSchema
{
    // This class is used only for OpenAPI documentation
}
