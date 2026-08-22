<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriaRequest extends FormRequest
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
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            'slug' => 'required|string|max:255|unique:categorias,slug',
            'descripcion' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.string' => 'El nombre de la categoría debe ser una cadena de texto.',
            'nombre.max' => 'El nombre de la categoría no puede tener más de 255 caracteres.',
            'nombre.unique' => 'El nombre de la categoría ya existe.',
            'slug.required' => 'El slug de la categoría es obligatorio.',
            'slug.string' => 'El slug de la categoría debe ser una cadena de texto.',
            'slug.max' => 'El slug de la categoría no puede tener más de 255 caracteres.',
            'slug.unique' => 'El slug de la categoría ya existe.',
            'descripcion.string' => 'La descripción de la categoría debe ser una cadena de texto.',
            'descripcion.max' => 'La descripción de la categoría no puede tener más de 255 caracteres.',
        ];
    }
}
