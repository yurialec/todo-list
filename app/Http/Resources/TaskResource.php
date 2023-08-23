<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'attachment' => $this->attachment,
            'completed' => $this->completed,
            'dt_created' => $this->dt_created,
            'dt_completed' => $this->dt_completed,
            'dt_updated' => $this->dt_updated,
            'dt_deleted' => $this->dt_deleted,
            'user_id' => $this->user_id,
        ];
    }
}
