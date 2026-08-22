<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCarritoRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'usuario_id' => ['required', 'exists:usuarios,id'],
            'producto_id' => [
                'required',
                Rule::exists('productos', 'id')->where(function ($query): void {
                    $query->where('stock', '>=', $this->input('cantidad'));
                }),
            ],
            'cantidad' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'usuario_id.required' => 'El campo usuario_id es obligatorio.',
            'usuario_id.exists' => 'El usuario especificado no existe.',
            'producto_id.required' => 'El campo producto_id es obligatorio.',
            'producto_id.exists' => 'El producto no existe o no tiene stock suficiente.',
            'cantidad.required' => 'El campo cantidad es obligatorio.',
            'cantidad.integer' => 'El campo cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad mínima permitida es 1.',
        ];
    }
}
