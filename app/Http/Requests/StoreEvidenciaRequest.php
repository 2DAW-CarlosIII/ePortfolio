<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreEvidenciaRequest",
 *     type="object",
 *     title="Store Evidencia Request",
 *     description="Datos requeridos para crear una Evidencia",
 *     required={"url", "descripcion", "estado_validacion"},
 *     @OA\Property(property="estudiante_id", type="integer", description="ID del estudiante"),
 *     @OA\Property(property="tarea_id", type="integer", description="ID de la tarea"),
 *     @OA\Property(property="url", type="string", format="url", description="URL de la evidencia"),
 *     @OA\Property(property="descripcion", type="string", description="Descripción de la evidencia"),
 *     @OA\Property(property="estado_validacion", type="string", enum={"pendiente", "validada", "rechazada"}, description="Estado de validación"),
 * )
 */

class StoreEvidenciaRequest extends FormRequest
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
            'url' => ['required', 'string', 'url', 'max:2048'],
            'descripcion' => ['required', 'string', 'max:65535'],
            'estado_validacion' => ['required', 'in:pendiente,validada,rechazada'],
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
            'url' => 'URL',
            'descripcion' => 'descripción',
            'estado_validacion' => 'estado de validación',
        ];
    }
}
