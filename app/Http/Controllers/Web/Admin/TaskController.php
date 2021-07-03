<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $task;

    public function __construct(SkillContract $task)
    {
        $this->task = $task;
    }

    /**
     * @return Renderable
     */
    public function index() :Renderable
    {
        $tasks = $this->task->findByFilter();
        return view('admin.tasks.index',compact('tasks'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:200|unique:tasks,name',
            'skill_id' => 'required|integer|exists:skills,id',
            'description' => 'sometimes|nullable|string',
        ]);

        $this->task->new($data);

        session()->flash('success',__('messages.create'));
        return redirect()->back();
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $s = $this->task->findOneById($id,['tasks']);
        return view('admin.tasks.show',compact('s'));
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id): Renderable
    {
        $s = $this->task->findOneById($id);
        return view('admin.tasks.edit',compact('s'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id,Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:200|unique:tasks,name,'.$id,
            'skill_id' => 'required|integer|exists:skills,id',
            'description' => 'sometimes|nullable|string',
        ]);

        $this->task->update($id,$data);

        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.tasks.show',$id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->task->delete($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->back();
    }

}
