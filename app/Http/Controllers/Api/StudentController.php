<?php

namespace App\Http\Controllers\Api;

use App\Contracts\EvaluationSessionContract;
use App\Contracts\StudentContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\SessionStudentResource;
use App\Http\Resources\StudentResource;
use App\Models\EvaluationSession;
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
            ]);
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


}
