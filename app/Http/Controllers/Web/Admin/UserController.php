<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserContract $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->findByFilter();
        return view('admin.users.index',compact('users'));
    }

    /**
     * @return Renderable
     */
    public function create() : Renderable
    {
        return view('admin.users.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->user->new($this->getValidatedData($request));
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.users.index');
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function show($id) : Renderable
    {
        $user = $this->user->findOneById($id);
        return view('admin.users.show',compact('user'));
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id) : Renderable
    {
        $user = $this->user->findOneById($id);
        return view('admin.users.edit',compact('user'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id,Request $request): RedirectResponse
    {
        $this->user->update($id,$this->getValidatedData($request));
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.users.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->user->delete($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.users.index');
    }

    private function getValidatedData(Request $request): array
    {
        return $request->validate([]);
    }
}
