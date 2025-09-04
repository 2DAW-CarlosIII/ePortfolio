<?php

/**
 * @OA\Schema(
 *     schema="StoreTareasRequest",
 *     type="object",
 *     title="Store Tareas Request",
 *     description="Request body for creating a new Tareas",
 *     required={"fecha_apertura", "fecha_cierre", "activo", "observaciones"},
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
 *             description="Opening date"
 *         ),
 *         @OA\Property(
 *             property="fecha_cierre",
 *             type="string",
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
 * )
 */
class StoreTareasRequestSchema
{
    // This class is used only for OpenAPI documentation
}
