<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ResumenCarritoResource extends JsonResource
{
    public function __construct(
        private readonly Collection $items,
        private readonly array $resumen,
    ) {
        parent::__construct($items);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cantidad_productos' => $this->items->count(),
            'cantidad_unidades' => $this->items->sum('cantidad'),
            'subtotal' => $this->resumen['subtotal'],
            'impuestos' => $this->resumen['impuestos'],
            'envio' => $this->resumen['envio'],
            'total' => $this->resumen['total'],
        ];
    }
}
