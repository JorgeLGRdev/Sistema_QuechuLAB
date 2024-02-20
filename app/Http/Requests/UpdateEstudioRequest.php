<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstudioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'nombre' => 'required|string|max:100',
            'precio' => 'required',
            'contenedor' => 'required|string|max:40',
            'metodo' => 'required|string|max:50',
            'abreviatura' => 'required|string|max:20',
            'unidades' => 'required|string|max:20',
            'tipo_muestra' => 'required|string|max:45',
            'sexo' => 'required|in:M,F,G',
            'horas_proceso' => 'required',
            'dias_entrega' => 'required',
            'reporte_especial' => 'required|in:S,N',
        ];
    }
}
