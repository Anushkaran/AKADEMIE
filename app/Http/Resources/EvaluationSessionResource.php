<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluationSessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'date'      => $this->date->format('d-m-Y'),
            'note'      => $this->note,
            'center'    => new CenterResource($this->whenLoaded('center')),
            'evaluation'=> new EvaluationResource($this->whenLoaded('evaluation')),
            'created_at'=> $this->created_at->format('d-m-Y'),
        ];
    }
}
