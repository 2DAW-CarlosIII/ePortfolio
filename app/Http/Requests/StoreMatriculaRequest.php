<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreMatriculaRequest",
 *     type="object",
 *     title="Store Matrícula Request",
 *     description="Datos requeridos para crear una Matrícula",
 *     required={"estudiante_id", "modulo_formativo_id", "fecha_matricula", "estado"},
 *     @OA\Property(property="estudiante_id", type="integer", description="ID del estudiante"),
 *     @OA\Property(property="modulo_formativo_id", type="integer", description="ID del módulo formativo"),
 *     @OA\Property(property="fecha_matricula", type="string", format="date", description="Fecha de matrícula"),
 *     @OA\Property(property="estado", type="string", enum={"activa", "inactiva", "finalizada"}, description="Estado de la matrícula"),
 * )
 */

class StoreMatriculaRequest extends FormRequest
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
            'fecha_matricula' => ['required', 'date', 'before_or_equal:today'],
            'estado' => ['required', 'in:activa,suspendida,finalizada']
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
            'fecha_matricula' => 'fecha de matrícula',
            'estado' => 'estado'
        ];
    }
}
