<?php

/**
 * @OA\Schema(
 *     schema="UpdateAsignacionRevisionRequest",
 *     type="object",
 *     title="Update AsignacionRevision Request",
 *     description="Request body for updating a AsignacionRevision",
 *         @OA\Property(
 *             property="evidencia_id",
 *             type="integer",
 *             description="Evidencia Id"
 *         ),
 *         @OA\Property(
 *             property="revisor_id",
 *             type="integer",
 *             description="Revisor Id"
 *         ),
 *         @OA\Property(
 *             property="asignado_por_id",
 *             type="integer",
 *             description="Asignado Por Id"
 *         ),
 *         @OA\Property(
 *             property="fecha_asignacion",
 *             type="string",
 *             description="Assignment date"
 *         ),
 *         @OA\Property(
 *             property="fecha_limite",
 *             type="string",
 *             description="Deadline"
 *         ),
 *         @OA\Property(
 *             property="estado",
 *             type="string",
 *             enum={"pendiente", "completada", "expirada"},
 *             description="Status"
 *         ),
 * )
 */
class UpdateAsignacionRevisionRequestSchema
{
    // This class is used only for OpenAPI documentation
}
