<?php

namespace App\Http\Controllers\Web\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    /**
     * @return Renderable
     */
    public function index() : Renderable
    {
        $students_count = DB::table('students')->where('partner_id',auth('partner')->id())->count();
        $evaluations_count = DB::table('evaluations')->where('partner_id',auth('partner')->id())->count();
        $new_students = DB::table('students')->where('partner_id',auth('partner')->id())->where('created_at','>=',Carbon::now()->subWeeks(1))->count();
        $week_sessions = DB::table('evaluations')->where('partner_id',auth('partner')->id())->whereBetween('date_exam',[now()->startOfWeek(),now()->endOfWeek()])->count();

        return view('partner.dashboard',compact(
            'students_count',
            'evaluations_count',
            'new_students',
            'week_sessions'
        ));

    }
}
