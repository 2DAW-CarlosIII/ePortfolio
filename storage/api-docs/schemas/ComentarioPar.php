<?php

/**
 * @OA\Schema(
 *     schema="ComentarioPar",
 *     type="object",
 *     title="ComentarioPar",
 *     description="ComentarioPar model",
 *     @OA\Xml(name="ComentarioPar"),
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="Unique identifier"
 *         ),
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
class ComentarioParSchema
{
    // This class is used only for OpenAPI documentation
}
