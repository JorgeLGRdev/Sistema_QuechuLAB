<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstudioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Aquí puedes definir la lógica de autorización si es necesario.
        // Por ejemplo, puedes verificar si el usuario tiene permiso para crear estudios.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:45',
            'precio' => 'required|string',
            'contenedor' => 'required|string|max:45',
            'metodo' => 'required|string|max:50',
            'abreviatura' => 'required|string|max:15',
            'area_id' => 'required|int',
        ];
    }
}
