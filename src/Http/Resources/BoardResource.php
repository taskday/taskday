<?php

namespace Taskday\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Taskday\Models\Category;
use Taskday\Plugin\Contracts\Groupable;

class BoardResource extends JsonResource
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
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'views' => ViewResource::collection($this->whenLoaded('views')),
            'entries' => EntryResource::collection($this->whenLoaded('entries')),
            'fields' => FieldResource::collection($this->whenLoaded('fields')),
            'groups' => FieldResource::collection($this->fields
                ->filter(fn ($field) => $field->getFieldType() instanceof Groupable)),
            'created_at' => $this->created_at?->format('M d, Y'),
            'updated_at' => $this->updated_at?->format('M d, Y'),
        ];
    }
}
