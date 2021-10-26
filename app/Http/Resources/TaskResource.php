<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'description'=> $this->description,
            'skill'=> new SkillResource($this->whenLoaded('skill')),
            'state' => $this->whenPivotLoaded('session_student_task',function (){
                dd($this->pivot->state);
                return (bool)$this->pivot->state;
            }),
        ];
    }
}
