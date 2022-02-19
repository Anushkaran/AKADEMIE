<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\EvaluationSession;
use Illuminate\Http\Request;

class EvaluationSessionController extends Controller
{
    public function index()
    {
        $sessions = EvaluationSession::with(['evaluation'=>function($query){
            $query->withCount('students');
        }])->whereHas('users',function ($query){
            $query->where('users.id',auth()->id());
        })->paginate(10);

        return view('user.evaluation-sessions.index',compact('sessions'));
    }

    public function generate($session)
    {
        $session = EvaluationSession::with(['evaluation.students'])->whereHas('users',function ($query){
            $query->where('users.id',auth()->id());
        })->where('id',$session)->firstOrFail();
        $setting = $session->evaluation->partner->settingSheet;

        $pdf = app('dompdf.wrapper');
        $pdf = $pdf->loadView('user.evaluation-sessions.absence-sheet',compact('session','setting'));
        return $pdf->download($session->name.'-absence_sheet.pdf');
    }
}
