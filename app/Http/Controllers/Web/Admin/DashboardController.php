<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * @return Renderable
     */
    public function index() : Renderable
    {
        return view('admin.dashboard');
    }
}
