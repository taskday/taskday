<?php

namespace Taskday\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Taskday\Plugin\Contracts\Groupable;
use Illuminate\Http\Resources\MissingValue;

class FieldResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = '';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'value' => $this->pivot?->value ?? new MissingValue(),
            'values' => $this->getFieldType() instanceof Groupable
                ? $this->getFieldType()->values($this->resource)->map->toArray()
                : new MissingValue()
        ];
    }
}
