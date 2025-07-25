<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateCicloFormativoRequest",
 *     type="object",
 *     title="Update Ciclo Formativo Request",
 *     description="Datos para actualizar un Ciclo Formativo",
 *     @OA\Property(property="familia_profesional_id", type="integer", description="ID de la familia profesional"),
 *     @OA\Property(property="nombre", type="string", maxLength=255, description="Nombre del ciclo formativo"),
 *     @OA\Property(property="codigo", type="string", maxLength=50, description="Código único del ciclo formativo"),
 *     @OA\Property(property="grado", type="string", enum={"medio", "superior"}, description="Grado del ciclo formativo"),
 *     @OA\Property(property="descripcion", type="string", description="Descripción del ciclo formativo"),
 * )
 */

class UpdateCicloFormativoRequest extends FormRequest
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
            'nombre' => ['sometimes', 'required', 'string', 'max:255'],
            'codigo' => ['sometimes', 'required', 'string', 'string', 'max:50', 'regex:/^[A-Z0-9_-]+$/i'],
            'grado' => ['sometimes', 'required', 'in:basico,medio,superior'],
            'descripcion' => ['sometimes', 'required', 'string', 'max:65535']
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
            'nombre' => 'nombre',
            'codigo' => 'código',
            'grado' => 'grado',
            'descripcion' => 'descripción'
        ];
    }
}
