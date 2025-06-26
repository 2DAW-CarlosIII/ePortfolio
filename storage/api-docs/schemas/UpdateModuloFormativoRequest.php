<?php

/**
 * @OA\Schema(
 *     schema="UpdateModuloFormativoRequest",
 *     type="object",
 *     title="Update ModuloFormativo Request",
 *     description="Request body for updating a ModuloFormativo",
 *         @OA\Property(
 *             property="ciclo_formativo_id",
 *             type="integer",
 *             description="Ciclo Formativo Id"
 *         ),
 *         @OA\Property(
 *             property="nombre",
 *             type="string",
 *             description="Name"
 *         ),
 *         @OA\Property(
 *             property="codigo",
 *             type="string",
 *             description="Code"
 *         ),
 *         @OA\Property(
 *             property="horas_totales",
 *             type="integer",
 *             description="Total hours"
 *         ),
 *         @OA\Property(
 *             property="curso_escolar",
 *             type="string",
 *             description="School year"
 *         ),
 *         @OA\Property(
 *             property="centro",
 *             type="string",
 *             description="Educational center"
 *         ),
 *         @OA\Property(
 *             property="docente_id",
 *             type="integer",
 *             description="Docente Id"
 *         ),
 *         @OA\Property(
 *             property="descripcion",
 *             type="string",
 *             description="Description"
 *         ),
 * )
 */
class UpdateModuloFormativoRequestSchema
{
    // This class is used only for OpenAPI documentation
}
