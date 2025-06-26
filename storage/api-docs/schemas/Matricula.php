<?php

/**
 * @OA\Schema(
 *     schema="Matricula",
 *     type="object",
 *     title="Matricula",
 *     description="Matricula model",
 *     @OA\Xml(name="Matricula"),
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="Unique identifier"
 *         ),
 *         @OA\Property(
 *             property="estudiante_id",
 *             type="integer",
 *             description="Estudiante Id"
 *         ),
 *         @OA\Property(
 *             property="modulo_formativo_id",
 *             type="integer",
 *             description="Modulo Formativo Id"
 *         ),
 *         @OA\Property(
 *             property="fecha_matricula",
 *             type="string",
 *             format="date",
 *             description="Enrollment date"
 *         ),
 *         @OA\Property(
 *             property="estado",
 *             type="string",
 *             enum={"activa", "suspendida", "finalizada"},
 *             description="Status"
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
class MatriculaSchema
{
    // This class is used only for OpenAPI documentation
}
