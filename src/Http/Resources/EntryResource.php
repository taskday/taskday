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
            'content' => $this->content,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at->format('M d, Y'),
            'updated_at' => $this->updated_at->format('M d, Y'),
            'fields' => FieldResource::collection($this->whenLoaded('fields')),
            'comments_count' => $this->comments_count,
            'user' => UserResource::make($this->whenLoaded('user')),
            'board' => BoardResource::make($this->whenLoaded('board')),
            'activities' => ActivityResource::collection($this->whenLoaded('activities')),
        ];
    }
}
