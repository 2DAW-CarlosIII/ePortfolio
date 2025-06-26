<?php

/**
 * @OA\Schema(
 *     schema="UpdateUserRolRequest",
 *     type="object",
 *     title="Update UserRol Request",
 *     description="Request body for updating a UserRol",
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
 * )
 */
class UpdateUserRolRequestSchema
{
    // This class is used only for OpenAPI documentation
}
