<?php

/**
 * @OA\Schema(
 *     schema="UpdateComentarioParRequest",
 *     type="object",
 *     title="Update ComentarioPar Request",
 *     description="Request body for updating a ComentarioPar",
 *         @OA\Property(
 *             property="asignacion_revision_id",
 *             type="integer",
 *             description="Asignacion Revision Id"
 *         ),
 *         @OA\Property(
 *             property="revisor_id",
 *             type="integer",
 *             description="Revisor Id"
 *         ),
 *         @OA\Property(
 *             property="contenido",
 *             type="string",
 *             description="Content"
 *         ),
 *         @OA\Property(
 *             property="tipo_comentario",
 *             type="string",
 *             enum={"positivo", "mejora", "critico"},
 *             description="Comment type"
 *         ),
 * )
 */
class UpdateComentarioParRequestSchema
{
    // This class is used only for OpenAPI documentation
}
