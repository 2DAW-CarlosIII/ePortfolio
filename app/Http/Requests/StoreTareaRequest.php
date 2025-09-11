<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreTareaRequest",
 *     type="object",
 *     title="Store Tarea Request",
 *     description="Datos requeridos para crear una Tarea de un CriterioEvaluacion",
 *     required={"fecha_apertura", "fecha_cierre", "activo"},
 *     @OA\Property(property="fecha_apertura", type="string", format="date", description="Fecha de apertura"),
 *     @OA\Property(property="fecha_cierre", type="string", format="date", description="Fecha de cierre"),
 *     @OA\Property(property="activo", type="boolean", description="Estado activo"),
 *     @OA\Property(property="observaciones", type="string", description="Observaciones"),
 * )
 */

class StoreTareaRequest extends FormRequest
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
            'fecha_apertura' => ['required', 'date'],
            'fecha_cierre' => ['required', 'date', 'after_or_equal:fecha_apertura'],
            'activo' => ['required', 'boolean'],
            'observaciones' => ['string', 'max:65535']
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
            'fecha_apertura' => 'fecha de apertura',
            'fecha_cierre' => 'fecha de cierre',
            'activo' => 'activo',
            'observaciones' => 'observaciones'
        ];
    }
}
