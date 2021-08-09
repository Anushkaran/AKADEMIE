<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SessionStudentResource extends JsonResource
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
            'student_id' => $this->student_id,
            'evaluation_session_id' => $this->evaluation_session_id,
            'note' => $this->note,
            'student' => new StudentResource($this->whenLoaded('student')),
            'evaluation_session' => new EvaluationSessionResource($this->whenLoaded('evaluationSession')),
            'tasks' =>  TaskResource::collection($this->whenLoaded('tasks')),
        ];
    }
}
