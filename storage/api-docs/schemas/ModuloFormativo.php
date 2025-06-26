<?php

/**
 * @OA\Schema(
 *     schema="ModuloFormativo",
 *     type="object",
 *     title="ModuloFormativo",
 *     description="ModuloFormativo model",
 *     @OA\Xml(name="ModuloFormativo"),
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="Unique identifier"
 *         ),
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
class ModuloFormativoSchema
{
    // This class is used only for OpenAPI documentation
}
