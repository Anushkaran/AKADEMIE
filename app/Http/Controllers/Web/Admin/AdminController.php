<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\AdminContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $admin;

    public function __construct(AdminContract $admin)
    {
        $this->admin = $admin;
    }

    /**
     * @return Renderable
     */
    public function index() : Renderable
    {
        $admins = $this->admin->findByFilter();
        return view('admin.admins.index',compact('admins'));
    }

    /**
     * @return Renderable
     */
    public function create() : Renderable
    {
        return view('admin.admins.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->getValidatedDate($request);
        $this->admin->new($data);
        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.admins.index');
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function show($id) : Renderable
    {
        $admin = $this->admin->findOneById($id);
        return view('admin.admins.show',compact('admin'));
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id) : Renderable
    {
        $admin = $this->admin->findOneById($id);
        return view('admin.admins.edit',compact('admin'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id, Request $request): RedirectResponse
    {
        $data = $this->getValidatedDate($request);
        $this->admin->update($id,$data);
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.admins.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->admin->delete($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.admins.index');
    }

    private function getValidatedDate(Request $request): array
    {
        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:admins,email',
            'image' => 'sometimes|nullable|file|image|max:3000',
            'password' => 'required|string|min:8|max:24|confirmed',
        ];

        if ($request->method() === 'put')
        {
            $rules['password'] = 'sometimes|nullable|string|min:8|max:24|confirmed';
            $rules['email'] = 'required|email|unique:admins,email,'.$request->route('admin');
        }

        return $request->validate($rules);
    }

}
