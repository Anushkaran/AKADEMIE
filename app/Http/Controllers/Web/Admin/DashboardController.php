<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
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
        $skill_count = DB::table('skills')->count();
        $centers_count = DB::table('centers')->count();
        $evaluations_count = DB::table('evaluations')->count();
        $sessions_count = DB::table('evaluation_sessions')->count();

        return view('admin.dashboard',compact(
            'sessions_count',
            'users_count',
            'students_count',
            'centers_count',
            'skill_count',
            'evaluations_count'
        ));
    }
}
