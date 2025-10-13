<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreEvaluacionEvidenciaRequest",
 *     type="object",
 *     title="Store Evaluación Evidencia Request",
 *     description="Datos requeridos para crear una Evaluación de Evidencia",
 *     required={"puntuacion", "estado"},
 *     @OA\Property(property="evidencia_id", type="integer", description="ID de la evidencia"),
 *     @OA\Property(property="user_id", type="integer", description="ID del usuario que comenta"),
 *     @OA\Property(property="puntuacion", type="number", format="decimal", description="Puntuación asignada a la evidencia", example=8.5),
 *     @OA\Property(property="estado", type="string", enum={"pendiente", "aprobada", "rechazada"}, description="Estado de la evaluación", example="aprobada"),
 *     @OA\Property(property="observaciones", type="string", description="Observaciones adicionales sobre la evaluación", example="Buen trabajo, pero se pueden mejorar algunos aspectos.")
 * )
 */

class StoreEvaluacionEvidenciaRequest extends FormRequest
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
            'puntuacion' => ['required', 'numeric', 'between:0,10'],
            'estado' => ['required', 'in:pendiente,aprobada,rechazada'],
            'observaciones' => ['string', 'max:65535'],
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
            'unique' => 'El valor del campo :attribute ya existe.',
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
            'observaciones' => 'observaciones'
        ];
    }
}
