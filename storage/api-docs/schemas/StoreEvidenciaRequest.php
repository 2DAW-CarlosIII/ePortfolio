<?php

/**
 * @OA\Schema(
 *     schema="StoreEvidenciaRequest",
 *     type="object",
 *     title="Store Evidencia Request",
 *     description="Request body for creating a new Evidencia",
 *     required={"url", "descripcion", "estado_validacion", "fecha_creacion"},
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
 *             description="Creation date"
 *         ),
 * )
 */
class StoreEvidenciaRequestSchema
{
    // This class is used only for OpenAPI documentation
}
