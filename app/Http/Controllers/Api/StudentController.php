<?php

namespace App\Http\Controllers\Api;

use App\Contracts\EvaluationSessionContract;
use App\Contracts\StudentContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\SessionStudentResource;
use App\Http\Resources\StudentResource;
use App\Http\Resources\TaskResource;
use App\Models\SessionStudent;
use App\Models\Student;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function show($id,$session,$student,StudentContract $s): \Illuminate\Http\JsonResponse
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

        /*$st->load(['tasks' => function($t) use($id , $session){
            $t->wherePivot('session_student_task.evaluation_id',$id)->whereDoesntHave('sessionStudents',function ($ss) use ($session){
                $ss->where('session_students.evaluation_session_id','<>',$session);
            });
        }]);*/

        $tasks = Task::whereHas('evaluationSessions',function ($ev) use ($session,$student){
            $ev->where('evaluation_sessions.id',$session);
        })->with(['sessionStudents' => function ($s) use($student){
            $s->where("session_students.student_id",$student);
        }])->get();

        return response()->json([
            'success' => true,
            'student' => new StudentResource($st),
            'tasks'     => TaskResource::collection($tasks)
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

        $session_student = SessionStudent::with(['session'])->findOrFail($session_student);

        $tasks = DB::table('session_student_task')
            ->where('student_id',$session_student->student_id)
            ->where('session_student_id',$session_student->id)->pluck('task_id');

        if (!$tasks->contains($data['task_id']))
        {
            $session_student->student->tasks()->attach($data['task_id'],[
                'student_id' => $session_student->student_id,
                'evaluation_id' => $session_student->session->evaluation_id,
                'user_id' => auth('api')->id(),
                'session_student_id' => $session_student->id,
                'state' => $data['state']
            ]);
        }else{
            $session_student->student->tasks()
                ->wherePivot('session_student_task.session_student_id',$session_student->id)
                ->syncWithoutDetaching([$data["task_id"] => [
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

        $session_student = SessionStudent::with(['session' => function($ss){
            $ss->withCount('tasks')->with('tasks:id');
        }])->findOrFail($session_student_id);

        $student = Student::withCount(['tasks' => function ($ts) use($session_student){
            $ts->where('session_student_task.evaluation_id',$session_student->session->evaluation_id)
                ->whereIn('tasks.id',$session_student->session->tasks->pluck('id')->all());
        }])->findOrFail($session_student->student_id);

        dd($session_student->session->tasks_count,$student->tasks_count);
        if ($session_student->session->tasks_count !== $student->tasks_count)
        {
            return response()->json([
                'success' => false,
                'message' => 'number of tasks attached to student must be equal to number of tasks attached to this session'
            ],422);
        }

        $session_student->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Note Has Been Updated successfully',
        ]);
    }

}
