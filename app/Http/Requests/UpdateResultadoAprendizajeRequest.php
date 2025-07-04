<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateResultadoAprendizajeRequest",
 *     type="object",
 *     title="Update Resultado Aprendizaje Request",
 *     description="Datos para actualizar un Resultado de Aprendizaje",
 *     @OA\Property(property="modulo_formativo_id", type="integer", description="ID del módulo formativo"),
 *     @OA\Property(property="codigo", type="string", maxLength=50, description="Código del resultado de aprendizaje"),
 *     @OA\Property(property="descripcion", type="string", description="Descripción del resultado de aprendizaje"),
 *     @OA\Property(property="peso_porcentaje", type="number", format="float", minimum=0, maximum=100, description="Peso en porcentaje"),
 *     @OA\Property(property="orden", type="integer", minimum=1, description="Orden de presentación"),
 * )
 */

class UpdateResultadoAprendizajeRequest extends FormRequest
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
            'codigo' => ['sometimes', 'required', 'string', 'string', 'max:50', 'regex:/^[A-Z0-9_-]+$/i'],
            'descripcion' => ['sometimes', 'required', 'string', 'max:65535'],
            'peso_porcentaje' => ['sometimes', 'required', 'numeric', 'between:0,100'],
            'orden' => ['sometimes', 'required', 'integer', 'min:1', 'max:999']
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
            'codigo' => 'código',
            'descripcion' => 'descripción',
            'peso_porcentaje' => 'peso porcentaje',
            'orden' => 'orden'
        ];
    }
}
