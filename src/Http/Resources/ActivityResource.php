<?php

namespace Taskday\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
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
            'event' => $this->event,
            'new_values' => $this->new_values,
            'old_values' => $this->old_values,
            'meta_data' => $this->meta_data,
            'user' => UserResource::make($this->whenLoaded('user')),
            'entry' => EntryResource::make($this->whenLoaded('entry')),
            'entry_id' => $this->entry_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
