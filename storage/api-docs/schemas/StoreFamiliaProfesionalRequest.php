<?php

/**
 * @OA\Schema(
 *     schema="StoreFamiliaProfesionalRequest",
 *     type="object",
 *     title="Store FamiliaProfesional Request",
 *     description="Request body for creating a new FamiliaProfesional",
 *     required={"nombre", "codigo", "descripcion"},
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
 * )
 */
class StoreFamiliaProfesionalRequestSchema
{
    // This class is used only for OpenAPI documentation
}
