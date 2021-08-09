<?php

namespace App\Http\Controllers\Api;

use App\Contracts\EvaluationSessionContract;
use App\Contracts\StudentContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\SessionStudentResource;
use App\Http\Resources\StudentResource;
use App\Models\SessionStudent;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function show($id,$student,StudentContract $s)
    {

        $st = $s->findOneById($student,['evaluations' => function($ev) use($id){
            $ev->where('evaluations.id',$id);
        }]);

        if ($st->evaluations->count() === 0)
        {
            return response()->json([
                'success' => false,
                'message' => 'Object Not Found'
            ]);
        }

        return response()->json([
            'success' => true,
            'student' => new StudentResource($st->load('tasks.skill'))
        ]);
    }

    public function startSession($session,$student,StudentContract $s,EvaluationSessionContract $ev)
    {
        $evaluationSession = $ev->findOneById($session,['evaluation']);
        $st = $s->findOneById($student);

        if ($st->evaluations()->where('id',$evaluationSession->evalatuion->id)->count() === 0)
        {
            return response()->json([
                'success' => false,
                'message' => 'Object Not Found'
            ],404);
        }

        $session_student = SessionStudent::firstOrNew([
            'evaluation_session_id' => $session,
            'student_id' => $student,
        ]);

        return response()->json([
            'success' => true,
            'session_student' => new SessionStudentResource($session_student)
        ]);
    }


    public function attachTask($session_student,Request $request)
    {
        $data = $request->validate(['task_id' => 'required|integer|exists:tasks,id']);
        $session_student = SessionStudent::findOrFail($session_student);
        $session_student->tasks()->attachIfNotAttached($data['task_id'],[
            'student_id' => $session_student->student_id,
            'user_id' => auth('api')->id(),
        ]);

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
