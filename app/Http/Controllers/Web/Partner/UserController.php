<?php

namespace App\Http\Controllers\Web\Partner;

use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserContract $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        if ($request->wantsJson())
        {
            return response()->json([
                'success' => true,
                'users' => $this->user->findByFilter(10,[],['id','first_name','last_name'])
            ]);
        }
        $users = $this->user->findByFilter();
        return view('admin.users.index',compact('users'));
    }
}
