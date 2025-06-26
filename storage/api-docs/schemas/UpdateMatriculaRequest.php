<?php

/**
 * @OA\Schema(
 *     schema="UpdateMatriculaRequest",
 *     type="object",
 *     title="Update Matricula Request",
 *     description="Request body for updating a Matricula",
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
 *             description="Enrollment date"
 *         ),
 *         @OA\Property(
 *             property="estado",
 *             type="string",
 *             enum={"activa", "suspendida", "finalizada"},
 *             description="Status"
 *         ),
 * )
 */
class UpdateMatriculaRequestSchema
{
    // This class is used only for OpenAPI documentation
}
