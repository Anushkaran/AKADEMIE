<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EvaluationResource extends JsonResource
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
            'start_date'=> $this->start_date->format('d-m-Y'),
            'end_date'  => $this->end_date->format('d-m-Y'),
            'partner'   => new PartnerResource($this->whenLoaded('partner')),
            'sessions'  => EvaluationSessionResource::collection($this->whenLoaded('sessions')),
            'students'  => StudentResource::collection($this->whenLoaded('students'))
        ];
    }
}
