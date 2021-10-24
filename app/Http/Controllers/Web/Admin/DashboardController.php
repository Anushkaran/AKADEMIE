<?php

namespace App\Http\Controllers\Web\Admin;

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
        $students_count = DB::table('students')->count();
        $users_count = DB::table('users')->count();
        $partner_count = DB::table('partners')->count();
        $skill_count = DB::table('skills')->count();
        $tasks_count = DB::table('tasks')->count();
        $centers_count = DB::table('centers')->count();
        $evaluations_count = DB::table('evaluations')->count();
        $sessions_count = DB::table('evaluation_sessions')->count();


        $new_students = DB::table('students')->where('created_at','>=',Carbon::now()->subWeeks(1))->count();



        $week_sessions = DB::table('evaluations')->whereBetween('date_exam',[now()->startOfWeek(),now()->endOfWeek()])->count();

        return view('admin.dashboard',compact(
            'sessions_count',
            'users_count',
            'students_count',
            'tasks_count',
            'centers_count',
            'skill_count',
            'evaluations_count',
            'new_students',
            'partner_count',
            'week_sessions'
        ));
    }
}
