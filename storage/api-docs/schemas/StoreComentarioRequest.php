<?php

/**
 * @OA\Schema(
 *     schema="StoreComentarioRequest",
 *     type="object",
 *     title="Store Comentario Request",
 *     description="Request body for creating a new Comentario",
 *     required={"contenido", "tipo"},
 *         @OA\Property(
 *             property="evidencia_id",
 *             type="integer",
 *             description="Evidencia Id"
 *         ),
 *         @OA\Property(
 *             property="user_id",
 *             type="integer",
 *             description="Docente Id"
 *         ),
 *         @OA\Property(
 *             property="contenido",
 *             type="string",
 *             description="Content"
 *         ),
 *         @OA\Property(
 *             property="tipo",
 *             type="string",
 *             enum={"feedback", "mejora", "felicitacion"},
 *             description="Type"
 *         ),
 * )
 */
class StoreComentarioRequestSchema
{
    // This class is used only for OpenAPI documentation
}
