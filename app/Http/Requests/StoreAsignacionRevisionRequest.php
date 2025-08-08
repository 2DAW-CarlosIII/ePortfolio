<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreAsignacionRevisionRequest",
 *     type="object",
 *     title="Store Asignación Revisión Request",
 *     description="Datos requeridos para crear una Asignación de Revisión",
 *     required={"revisor_id", "fecha_limite", "estado"},
 *     @OA\Property(property="evidencia_id", type="integer", description="ID de la evidencia"),
 *     @OA\Property(property="revisor_id", type="integer", description="ID del revisor"),
 *     @OA\Property(property="asignado_por_id", type="integer", description="ID del usuario que asigna"),
 *     @OA\Property(property="fecha_limite", type="string", format="date", description="Fecha límite para la revisión"),
 *     @OA\Property(property="estado", type="string", enum={"pendiente", "en_revision", "completada"}, description="Estado de la revisión"),
 * )
 */

class StoreAsignacionRevisionRequest extends FormRequest
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
            // 'evidencia_id' => ['required', 'integer', 'exists:evidencias,id'],
            'revisor_id' => ['required', 'integer', 'exists:users,id'],
            // 'asignado_por_id' => ['required', 'integer', 'exists:users,id'],
            'fecha_limite' => ['required', 'date', 'after:today'],
            'estado' => ['required', 'in:pendiente,completada,expirada']
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
            'fecha_limite' => 'fecha límite',
            'estado' => 'estado'
        ];
    }
}
