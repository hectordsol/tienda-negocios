<?php

namespace App\DTO;

class CarritoitemDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $producto_id,
        public readonly string $producto_nombre,
        public readonly int $cantidad,
        public readonly float $precio_unitario,
        public readonly float $subtotal,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'producto_id' => $this->producto_id,
            'producto_nombre' => $this->producto_nombre,
            'cantidad' => $this->cantidad,
            'precio_unitario' => $this->precio_unitario,
            'subtotal' => $this->subtotal,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],
            producto_id: (int) $data['producto_id'],
            producto_nombre: $data['producto_nombre'],
            cantidad: (int) $data['cantidad'],
            precio_unitario: (float) $data['precio_unitario'],
            subtotal: (float) $data['subtotal'],
        );
    }

    public function toDTO(): CarritoitemDTO
    {
        return new CarritoitemDTO(
            id : $this->id,
            producto_id : $this->producto_id,
            producto_nombre : $this->producto_nombre,
            cantidad : $this->cantidad,
            precio_unitario : $this->precio_unitario,
            subtotal : $this->subtotal,
        );
    }
}
