<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'title' => $this->title,
            'description' => $this->description,
            'attachment' => $this->attachment,
            'completed' => $this->completed == 0 ? "Not completed yet" : "Completed",
            'dt_created' => $this->dt_created,
            'dt_completed' => $this->dt_completed,
            'dt_updated' => $this->dt_updated,
            'deleted_at' => $this->deleted_at,
            'user_id' => $this->user_id,
        ];
    }
}
