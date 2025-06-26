<?php

/**
 * @OA\Schema(
 *     schema="StoreComentarioParRequest",
 *     type="object",
 *     title="Store ComentarioPar Request",
 *     description="Request body for creating a new ComentarioPar",
 *     required={"contenido", "tipo_comentario"},
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
class StoreComentarioParRequestSchema
{
    // This class is used only for OpenAPI documentation
}
