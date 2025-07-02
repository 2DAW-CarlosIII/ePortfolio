<?php

/**
 * @OA\Schema(
 *     schema="Comentario",
 *     type="object",
 *     title="Comentario",
 *     description="Comentario model",
 *     @OA\Xml(name="Comentario"),
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="Unique identifier"
 *         ),
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
class ComentarioSchema
{
    // This class is used only for OpenAPI documentation
}
