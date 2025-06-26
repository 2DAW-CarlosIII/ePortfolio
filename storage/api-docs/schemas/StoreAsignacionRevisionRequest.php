<?php

/**
 * @OA\Schema(
 *     schema="StoreAsignacionRevisionRequest",
 *     type="object",
 *     title="Store AsignacionRevision Request",
 *     description="Request body for creating a new AsignacionRevision",
 *     required={"fecha_asignacion", "fecha_limite", "estado"},
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
class StoreAsignacionRevisionRequestSchema
{
    // This class is used only for OpenAPI documentation
}
