<?php

namespace App\Http\Requests;

use App\DTO\CarritoitemDTO;
use App\Models\Carritoitem;
use App\Models\Producto;
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

    protected function prepareForValidation(): void
    {
        $producto = Producto::query()
            ->whereKey($this->input('producto_id'))
            ->where('stock', '>=', (int) $this->input('cantidad'))
            ->first(['id', 'nombre', 'precio']);

        if ($producto !== null) {
            $this->merge([
                'producto_nombre' => $producto->nombre,
                'precio_unitario' => (float) $producto->precio,
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $usuarioId = auth('api')->user()?->id ?? 0;

        return [
            'producto_id' => [
                'required',
                Rule::exists('productos', 'id')->where(function ($query) use ($usuarioId): void {
                    $cantidadEnCarrito = Carritoitem::query()
                        ->whereHas('carrito', function ($carritoQuery) use ($usuarioId): void {
                            $carritoQuery->where('usuario_id', $usuarioId)
                                ->where('estado', 'activo');
                        })
                        ->where('producto_id', $this->input('producto_id'))
                        ->value('cantidad') ?? 0;

                    $query->where('stock', '>=', $cantidadEnCarrito + (int) $this->input('cantidad'));
                }),
            ],
            'cantidad' => ['required', 'integer', 'min:1'],
            'producto_nombre' => ['required', 'string'],
            'precio_unitario' => ['required', 'numeric'],
        ];
    }

    public function messages(): array
    {
        return [
            'producto_id.required' => 'El campo producto_id es obligatorio.',
            'producto_id.exists' => 'El producto no existe o no tiene stock suficiente.',
            'cantidad.required' => 'El campo cantidad es obligatorio.',
            'cantidad.integer' => 'El campo cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad mínima permitida es 1.',
            'producto_nombre.required' => 'No se pudo obtener el nombre del producto.',
            'precio_unitario.required' => 'No se pudo obtener el precio del producto.',
        ];
    }

    public function toDTO(): CarritoitemDTO
    {
        return new CarritoitemDTO(
            id: 0,
            producto_id: $this->input('producto_id'),
            producto_nombre: $this->input('producto_nombre'),
            cantidad: $this->input('cantidad'),
            precio_unitario: $this->input('precio_unitario'),
            subtotal: $this->input('cantidad') * $this->input('precio_unitario'),
        );
    }
}
