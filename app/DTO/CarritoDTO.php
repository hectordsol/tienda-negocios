<?php

namespace App\DTO;

class CarritoDTO
{
    public function __construct(
        public readonly int $usuario_id,
        public readonly array $items, // Arreglo de CarritoitemDTO
        public readonly int $total_items,
        public readonly float $total,
    ) {}

    public function toArray(): array
    {
        return [
            'usuario_id' => $this->usuario_id,
            'items' => array_map(fn ($item) => $item->toArray(), $this->items),
            'total_items' => $this->total_items,
            'total' => $this->total,
        ];
    }

    public static function fromArray(array $data): self
    {
        $items = array_map(fn ($item) => CarritoitemDTO::fromArray($item), $data['items']);

        return new self(
            usuario_id: (int) $data['usuario_id'],
            items: $items,
            total_items: (int) $data['total_items'],
            total: (float) $data['total'],
        );
    }

    public function toDTO(): CarritoDTO
    {
        return new CarritoDTO(
            usuario_id : $this->usuario_id,
            items: $this->items,
            total_items: $this->total_items,
            total : $this->total,
        );
    }
}
