<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="BatchStoreMatriculaRequest",
 *     type="object",
 *     title="Batch Store Matrícula Request",
 *     description="Datos requeridos para crear Matrículas en masa de usuarios en módulos formativos",
 *     @OA\Property(property="estudiantes_id", type="array", description="Array de IDs de estudiantes", @OA\Items(type="integer")),
 *     @OA\Property(property="modulos_formativos_id", type="array", description="Array de IDs de módulos formativos", @OA\Items(type="integer")),
 * )
 */

class BatchStoreMatriculaRequest extends FormRequest
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
        // Necesitamos un array de estudiantes y un array de módulos formativos
        return [
            'estudiantes_id' => 'required|array|min:1',
            'estudiantes_id.*' => 'integer|exists:users,id',
            'modulos_formativos_id' => 'required|array|min:1',
            'modulos_formativos_id.*' => 'integer|exists:modulos_formativos,id',
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
        ];
    }
}
