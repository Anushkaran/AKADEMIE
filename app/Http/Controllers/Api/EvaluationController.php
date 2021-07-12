<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EvaluationResource;
use App\Http\Resources\EvaluationSessionResource;
use App\Http\Resources\SkillResource;
use App\Http\Resources\StudentResource;
use App\Models\Evaluation;
use App\Models\EvaluationSession;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluationController extends Controller
{
    protected $ev;

    public function __construct(EvaluationSession $ev)
    {
        $this->ev = $ev;
    }

    public function index()
    {
        return EvaluationResource::collection(Evaluation::whereHas('sessions',function ($s){
            $s->where('user_id',auth('api')->id());
        })->latest()->get());
    }

    public function getSessions($id)
    {
        return new EvaluationResource(
            Evaluation::whereHas('sessions',function ($s){
                $s->where('user_id',auth('api')->id());
            })->with(['sessions' => function($q){
                $q->where('user_id',auth('api')->id())->latest();
            }])->findOrFail($id)
        );
    }

    public function students($id)
    {
        $evaluation = Evaluation::with('students')
            ->whereHas('sessions',function ($s){
                $s->where('user_id',auth('api')->id());
            })
            ->findOrFail($id);

        return StudentResource::collection($evaluation->students);
    }

    public function skills($id)
    {
        $evaluation = Evaluation::with('skills.tasks')
            ->whereHas('sessions',function ($s){
                $s->where('user_id',auth('api')->id());
            })
            ->findOrFail($id);
        return SkillResource::collection(
            $evaluation->skills
        );
    }
}
