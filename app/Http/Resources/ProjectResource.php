<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'key' => $this->key,
            'icon_color' => $this->icon_color,
            'description' => $this->description,
            'type' => $this->type,
            'tasks' => TaskResource::collection($this->tasks),
            'workflows' => WorkflowResource::collection($this->workflows),
            'accesses' => AccessResource::collection($this->accesses),
        ];
    }
}
