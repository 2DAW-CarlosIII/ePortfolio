<?php

/**
 * @OA\Schema(
 *     schema="Rol",
 *     type="object",
 *     title="Rol",
 *     description="Rol model",
 *     @OA\Xml(name="Rol"),
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="Unique identifier"
 *         ),
 *         @OA\Property(
 *             property="name",
 *             type="string",
 *             description="Name"
 *         ),
 *         @OA\Property(
 *             property="description",
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
class RolSchema
{
    // This class is used only for OpenAPI documentation
}
