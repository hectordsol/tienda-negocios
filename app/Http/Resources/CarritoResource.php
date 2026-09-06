<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class CarritoResource extends JsonResource
{
    public function __construct(
        private readonly Collection $items,
        private readonly array $resumen)
    {
        parent::__construct($items);
    }

    public function toArray(Request $request): array
    {
        return [
            'items' => CarritoitemResource::collection($this->items),
            'resumen' => new ResumenCarritoResource(
                $this->items,
                $this->resumen,
            ),
        ];
    }
}
