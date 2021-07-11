<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EvaluationSessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
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
