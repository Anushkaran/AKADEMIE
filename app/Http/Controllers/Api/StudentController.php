<?php

namespace App\Http\Controllers\Api;

use App\Contracts\EvaluationSessionContract;
use App\Contracts\StudentContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\SessionStudentResource;
use App\Http\Resources\StudentResource;
use App\Models\SessionStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function show($id,$student,StudentContract $s)
    {
        $st = $s->findOneById($student,['evaluations' => function($ev) use($id){
            $ev->where('evaluations.id',$id)->active();
        }]);

        if ($st->evaluations->count() === 0)
        {
            return response()->json([
                'success' => false,
                'message' => 'Object Not Found'
            ]);
        }
        $st->load(['tasks' => function($t) use($id){
            $t->where('session_student_task.evaluation_id',$id);
        }]);
        return response()->json([
            'success' => true,
            'student' => new StudentResource($st)
        ]);
    }

    public function startSession($session,$student,StudentContract $s,EvaluationSessionContract $ev)
    {
        $evaluationSession = $ev->findOneById($session);
        $st = $s->findOneById($student);
        if ($st->evaluations()->where('evaluations.id',$evaluationSession->evaluation_id)->count() === 0)
        {
            return response()->json([
                'success' => false,
                'message' => 'Object Not Found'
            ],404);
        }

        $session_student = SessionStudent::firstOrCreate([
            'evaluation_session_id' => $session,
            'student_id' => $student,
        ]);

        if ($evaluationSession->is_final)
        {
            $session_students = SessionStudent::wherehas('session',function ($sess) use ($evaluationSession){
                $sess->where('id','<>',$evaluationSession->id)->where('evaluation_sessions.evaluation_id',$evaluationSession->evaluation_id);
            })->where('student_id',$student)->pluck('id');
            DB::table('session_student_task')->whereIn('session_student_id',$session_students)->delete();
        }


        return response()->json([
            'success' => true,
            'session_student' => new SessionStudentResource($session_student)
        ]);
    }


    public function attachTask($session_student,Request $request)
    {
        $data = $request->validate([
            'task_id' => 'required|integer|exists:tasks,id',
            'state'   => 'required|boolean'
        ]);

        $session_student = SessionStudent::with(['session','tasks'])->findOrFail($session_student);
        if (!$session_student->tasks->contains($data['task_id']))
        {
            $session_student->tasks()->attach($data['task_id'],[
                'student_id' => $session_student->student_id,
                'evaluation_id' => $session_student->session->evaluation_id,
                'user_id' => auth('api')->id(),
                'state' => $data['state']
            ]);
        }else{
            $session_student->tasks()->syncWithoutDetaching([$data['task_id'] => [
                'student_id' => $session_student->student_id,
                'user_id' => auth('api')->id(),
                'evaluation_id' => $session_student->session->evaluation_id,
                'state' => $data['state']
            ]]);
        }

        return response()->json([
            'success' => true,
            'message' => 'task has been attached successfully'
        ]);
    }

    public function detachTask($session_student_id,Request $request)
    {
        $data = $request->validate(['task_id' => 'required|integer|exists:tasks,id']);
        $session_student = SessionStudent::with(['tasks' => function($t) use($data){
            $t->where('tasks.id',$data['task_id']);
        }])->findOrFail($session_student_id);

        if ($session_student->tasks->count() === 0)
        {
            return response()->json([
                'success' => false,
                'message' => 'task : '.$data['id'].' not found in list of tasks for session '.$session_student
            ],404);
        }
        $task = $session_student->tasks->first();

        if ($task->pivot->user_id !== auth('api')->id())
        {
            return response()->json([
                'success' => false,
                'message' => 'the user that attached the task to the student and the auth user are mismatched'
            ],403);
        }


        $session_student->tasks()->detach($task);

        return response()->json([
            'success' => true,
            'message' => 'task has been detached successfully'
        ]);
    }

    public function updateNote($session_student_id,Request $request)
    {
        $data = $request->validate(['note' => 'sometimes|nullable|string|max:200']);
        $session_student = SessionStudent::findOrFail($session_student_id);

        $session_student->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Note Has Been Updated successfully'
        ]);
    }

}
