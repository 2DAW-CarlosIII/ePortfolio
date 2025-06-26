<?php

/**
 * @OA\Schema(
 *     schema="AsignacionRevision",
 *     type="object",
 *     title="AsignacionRevision",
 *     description="AsignacionRevision model",
 *     @OA\Xml(name="AsignacionRevision"),
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
 *             format="date",
 *             description="Assignment date"
 *         ),
 *         @OA\Property(
 *             property="fecha_limite",
 *             type="string",
 *             format="date",
 *             description="Deadline"
 *         ),
 *         @OA\Property(
 *             property="estado",
 *             type="string",
 *             enum={"pendiente", "completada", "expirada"},
 *             description="Status"
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
class AsignacionRevisionSchema
{
    // This class is used only for OpenAPI documentation
}
