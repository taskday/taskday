<?php

namespace Taskday\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntryResource extends JsonResource
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
            'created_at' => $this->created_at->format('M d, Y'),
            'updated_at' => $this->updated_at,
            'fields' => $this->fields->map(fn ($field) => [
                'field_id' => $field->pivot->field_id,
                'value' => $field->pivot->value,
            ]),
            'comments_count' => $this->comments()->count(),
            'user' => UserResource::make($this->whenLoaded('user')),
            'activities' => ActivityResource::collection($this->whenLoaded('activities')),
        ];
    }
}
