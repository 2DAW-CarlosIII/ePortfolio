<?php

/**
 * @OA\Schema(
 *     schema="StoreModuloFormativoRequest",
 *     type="object",
 *     title="Store ModuloFormativo Request",
 *     description="Request body for creating a new ModuloFormativo",
 *     required={"nombre", "codigo", "horas_totales", "curso_escolar", "centro", "descripcion"},
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
class StoreModuloFormativoRequestSchema
{
    // This class is used only for OpenAPI documentation
}
