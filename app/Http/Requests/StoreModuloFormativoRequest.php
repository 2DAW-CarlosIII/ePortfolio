<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreModuloFormativoRequest",
 *     type="object",
 *     title="Store Módulo Formativo Request",
 *     description="Datos requeridos para crear un Módulo Formativo",
 *     required={"nombre", "codigo", "horas_totales", "curso_escolar", "centro"},
 *     @OA\Property(property="ciclo_formativo_id", type="integer", description="ID del ciclo formativo"),
 *     @OA\Property(property="nombre", type="string", maxLength=255, description="Nombre del módulo formativo"),
 *     @OA\Property(property="codigo", type="string", maxLength=50, description="Código del módulo formativo"),
 *     @OA\Property(property="horas_totales", type="integer", minimum=1, description="Horas totales del módulo"),
 *     @OA\Property(property="curso_escolar", type="string", maxLength=20, description="Curso escolar (ej: 2024-2025)"),
 *     @OA\Property(property="centro", type="string", maxLength=255, description="Centro educativo"),
 *     @OA\Property(property="docente_id", type="integer", description="ID del docente"),
 *     @OA\Property(property="descripcion", type="string", description="Descripción del módulo"),
 * )
 */

class StoreModuloFormativoRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'max:255'],
            'codigo' => ['required', 'string', 'string', 'max:50', 'regex:/^[A-Z0-9_-]+$/i'],
            'horas_totales' => ['required', 'integer', 'min:1', 'max:2000'],
            'curso_escolar' => ['required', 'string', 'max:255'],
            'centro' => ['required', 'string', 'max:255'],
            'descripcion' => ['string', 'max:65535']
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
            'nombre' => 'nombre',
            'codigo' => 'código',
            'horas_totales' => 'horas totales',
            'curso_escolar' => 'curso escolar',
            'centro' => 'centro',
            'descripcion' => 'descripción'
        ];
    }
}
