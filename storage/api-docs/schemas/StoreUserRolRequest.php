<?php

/**
 * @OA\Schema(
 *     schema="StoreUserRolRequest",
 *     type="object",
 *     title="Store UserRol Request",
 *     description="Request body for creating a new UserRol",
 *     required={},
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
class StoreUserRolRequestSchema
{
    // This class is used only for OpenAPI documentation
}
