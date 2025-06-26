<?php

/**
 * @OA\Schema(
 *     schema="StoreMatriculaRequest",
 *     type="object",
 *     title="Store Matricula Request",
 *     description="Request body for creating a new Matricula",
 *     required={"fecha_matricula", "estado"},
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
class StoreMatriculaRequestSchema
{
    // This class is used only for OpenAPI documentation
}
