<?php

/**
 * @OA\Schema(
 *     schema="CicloFormativo",
 *     type="object",
 *     title="CicloFormativo",
 *     description="CicloFormativo model",
 *     @OA\Xml(name="CicloFormativo"),
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="Unique identifier"
 *         ),
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
class CicloFormativoSchema
{
    // This class is used only for OpenAPI documentation
}
