<?php

/**
 * @OA\Schema(
 *     schema="UserRol",
 *     type="object",
 *     title="UserRol",
 *     description="UserRol model",
 *     @OA\Xml(name="UserRol"),
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="Unique identifier"
 *         ),
 *         @OA\Property(
 *             property="user_id",
 *             type="integer",
 *             description="User Id"
 *         ),
 *         @OA\Property(
 *             property="role_id",
 *             type="integer",
 *             description="Role Id"
 *         ),
 *         @OA\Property(
 *             property="modulo_formativo_id",
 *             type="integer",
 *             description="Modulo Formativo Id"
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
class UserRolSchema
{
    // This class is used only for OpenAPI documentation
}
