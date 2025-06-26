<?php

/**
 * @OA\Schema(
 *     schema="StoreCicloFormativoRequest",
 *     type="object",
 *     title="Store CicloFormativo Request",
 *     description="Request body for creating a new CicloFormativo",
 *     required={"nombre", "codigo", "grado", "descripcion"},
 *         @OA\Property(
 *             property="familia_profesional_id",
 *             type="integer",
 *             description="Familia Profesional Id"
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
 *             property="grado",
 *             type="string",
 *             enum={"basico", "medio", "superior"},
 *             description="Grade level"
 *         ),
 *         @OA\Property(
 *             property="descripcion",
 *             type="string",
 *             description="Description"
 *         ),
 * )
 */
class StoreCicloFormativoRequestSchema
{
    // This class is used only for OpenAPI documentation
}
