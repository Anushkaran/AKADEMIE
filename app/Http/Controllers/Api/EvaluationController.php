<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EvaluationResource;
use App\Http\Resources\EvaluationSessionResource;
use App\Http\Resources\SkillResource;
use App\Http\Resources\StudentResource;
use App\Models\Evaluation;
use App\Models\EvaluationSession;
use App\Models\Skill;
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
        return EvaluationResource::collection(Evaluation::with('center')->whereHas('sessions',function ($s){
            $s->whereHas('users',function ($user){
                $user->where("users.id",auth('api')->id());
            });
        })->active()->latest()->get());
    }

    public function getSessions($id)
    {
        return new EvaluationResource(
            Evaluation::whereHas('sessions',function ($s){
                $s->whereHas('users',function ($user){
                    $user->where("users.id",auth('api')->id());
                });
            })->with(['sessions' => function($q){
                $q->whereHas('users',function ($user){
                    $user->where("users.id",auth('api')->id());
                });
            }])->active()->findOrFail($id)
        );
    }

    public function students($id,$session)
    {
        $evaluation = Evaluation::with([
            'students.sessionStudents' => function($sst) use($id){
                $sst->whereHas('session',function ($s)use($id){
                    $s->where('evaluation_sessions.evaluation_id',$id);
                })->where('note','<>',null);
            }
        ])
            ->whereHas('sessions',function ($s) use ($session){
                $s->whereHas('users',function ($user){
                    $user->where("users.id",auth('api')->id());
                })->where('id',$session);
            })
            ->active()
            ->findOrFail($id);

        return StudentResource::collection($evaluation->students);
    }

    public function tasks($id)
    {
        $sessions = EvaluationSession::with('tasks:id')
            ->whereHas('users',function ($user){
                $user->where('users.id',auth('api')->id());
            })->withCount('tasks')
            ->findOrFail($id);

        $tasks_ids = $sessions->tasks->pluck('id')->all();
        $skills = Skill::whereHas('tasks',function ($t) use ($tasks_ids){
            $t->whereIn('tasks.id',$tasks_ids);
        })->with(['tasks' => function ($task) use($tasks_ids){
            $task->whereIn('tasks.id',$tasks_ids);
        }])->get();

        return response()->json([
            'skills' => SkillResource::collection(
                $skills
            ),
            'tasks_count' => $sessions->tasks_count
        ]);
    }
}
