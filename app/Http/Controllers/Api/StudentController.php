<?php

namespace App\Http\Controllers\Api;

use App\Contracts\StudentContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function show($id,$student,StudentContract $s)
    {
        $st = $s->findOneById($id,['evaluations' => function($ev) use($student){
            $ev->where('evaluations.id',$student);
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


}
