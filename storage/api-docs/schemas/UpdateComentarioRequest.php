<?php

/**
 * @OA\Schema(
 *     schema="UpdateComentarioRequest",
 *     type="object",
 *     title="Update Comentario Request",
 *     description="Request body for updating a Comentario",
 *         @OA\Property(
 *             property="evidencia_id",
 *             type="integer",
 *             description="Evidencia Id"
 *         ),
 *         @OA\Property(
 *             property="docente_id",
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
class UpdateComentarioRequestSchema
{
    // This class is used only for OpenAPI documentation
}
