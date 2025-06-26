<?php

/**
 * @OA\Schema(
 *     schema="StoreRolRequest",
 *     type="object",
 *     title="Store Rol Request",
 *     description="Request body for creating a new Rol",
 *     required={"name", "description"},
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
 * )
 */
class StoreRolRequestSchema
{
    // This class is used only for OpenAPI documentation
}
