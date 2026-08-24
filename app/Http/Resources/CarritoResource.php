<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarritoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $items = $this->items;

        return [
            'usuario_id' => $this->usuario_id,
            'estado' => $this->estado,
            'items' => CarritoitemResource::collection($items),
            'total_items' => $items->sum('cantidad'),
            'total' => $items->sum(function ($item): float {
                return (float) $item->cantidad * (float) $item->precio_unitario;
            }),
        ];
    }
}
