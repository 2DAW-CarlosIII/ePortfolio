<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateMatriculaRequest",
 *     type="object",
 *     title="Update Matrícula Request",
 *     description="Datos para actualizar una Matrícula",
 *     @OA\Property(property="estudiante_id", type="integer", description="ID del estudiante"),
 *     @OA\Property(property="modulo_formativo_id", type="integer", description="ID del módulo formativo"),
 *     @OA\Property(property="estado", type="string", enum={"activa", "inactiva", "finalizada"}, description="Estado de la matrícula"),
 * )
 */

class UpdateMatriculaRequest extends FormRequest
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
        return [];
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
        return [];
    }
}
