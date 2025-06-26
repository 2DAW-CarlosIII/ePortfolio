<?php

/**
 * @OA\Schema(
 *     schema="FamiliaProfesional",
 *     type="object",
 *     title="FamiliaProfesional",
 *     description="FamiliaProfesional model",
 *     @OA\Xml(name="FamiliaProfesional"),
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="Unique identifier"
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
class FamiliaProfesionalSchema
{
    // This class is used only for OpenAPI documentation
}
