<?php

/**
 * @OA\Schema(
 *     schema="Evidencia",
 *     type="object",
 *     title="Evidencia",
 *     description="Evidencia model",
 *     @OA\Xml(name="Evidencia"),
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="Unique identifier"
 *         ),
 *         @OA\Property(
 *             property="estudiante_id",
 *             type="integer",
 *             description="Estudiante Id"
 *         ),
 *         @OA\Property(
 *             property="criterio_evaluacion_id",
 *             type="integer",
 *             description="Criterio Evaluacion Id"
 *         ),
 *         @OA\Property(
 *             property="url",
 *             type="string",
 *             description="URL"
 *         ),
 *         @OA\Property(
 *             property="descripcion",
 *             type="string",
 *             description="Description"
 *         ),
 *         @OA\Property(
 *             property="estado_validacion",
 *             type="string",
 *             enum={"pendiente", "validada", "rechazada"},
 *             description="Validation status"
 *         ),
 *         @OA\Property(
 *             property="fecha_creacion",
 *             type="string",
 *             format="date-time",
 *             description="Creation date"
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
class EvidenciaSchema
{
    // This class is used only for OpenAPI documentation
}
