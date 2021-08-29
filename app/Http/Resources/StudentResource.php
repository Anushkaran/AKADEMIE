<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'address'   => $this->address,
            'is_evaluated'   => $this->whenLoaded('sessionStudents',$this->sessionStudents->count() > 0),
            'is_canceled' => $this->whenPivotLoaded('evaluation_student',function (){
                return (bool)$this->pivot->is_canceled;
            }),
            'partner'   => new PartnerResource($this->whenLoaded('partner')),
            'tasks'   =>  TaskResource::collection($this->whenLoaded('tasks')),
        ];
    }
}
