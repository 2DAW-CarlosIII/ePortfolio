<?php

/**
 * @OA\Schema(
 *     schema="UpdateCicloFormativoRequest",
 *     type="object",
 *     title="Update CicloFormativo Request",
 *     description="Request body for updating a CicloFormativo",
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
class UpdateCicloFormativoRequestSchema
{
    // This class is used only for OpenAPI documentation
}
