<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateEvaluacionEvidenciaRequest",
 *     type="object",
 *     title="Update Evaluación Evidencia Request",
 *     description="Datos para actualizar una Evaluación de Evidencia",
 *     @OA\Property(property="evidencia_id", type="integer", description="ID de la evidencia"),
 *     @OA\Property(property="user_id", type="integer", description="ID del evaluador"),
 *     @OA\Property(property="puntuacion", type="number", format="float", minimum=0, maximum=10, description="Puntuación otorgada (0-10)"),
 *     @OA\Property(property="estado", type="string", enum={"pendiente", "completada", "revisada"}, description="Estado de la evaluación"),
 *     @OA\Property(property="observaciones", type="string", description="Observaciones de la evaluación"),
 *     @OA\Property(property="fecha_evaluacion", type="string", format="date-time", description="Fecha de evaluación"),
 * )
 */

class UpdateEvaluacionEvidenciaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // TODO: Implementar autorización específica
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'puntuacion' => ['sometimes', 'required', 'numeric', 'between:0,10'],
            'estado' => ['sometimes', 'required', 'in:pendiente,aprobada,rechazada'],
            'observaciones' => ['sometimes', 'required', 'string', 'max:65535'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'numeric' => 'El campo :attribute debe ser numérico.',
            'decimal' => 'El campo :attribute debe ser un número decimal.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'boolean' => 'El campo :attribute debe ser verdadero o falso.',
            'email' => 'El campo :attribute debe ser un email válido.',
            'url' => 'El campo :attribute debe ser una URL válida.',
            'exists' => 'El valor seleccionado en :attribute no es válido.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
            'between' => 'El campo :attribute debe estar entre :min y :max.',
            'in' => 'El valor seleccionado en :attribute no es válido.',
            'regex' => 'El formato del campo :attribute no es válido.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'puntuacion' => 'puntuación',
            'estado' => 'estado',
            'observaciones' => 'observaciones',
            'fecha_evaluacion' => 'fecha de evaluación'
        ];
    }
}
