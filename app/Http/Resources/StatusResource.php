<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'quiz_score' => $this->quiz_score,
            'is_complete' => $this->is_complete,
            'user_id' => $this->user_id,
            'material_id' => $this->material_id,
        ];
    }
}
