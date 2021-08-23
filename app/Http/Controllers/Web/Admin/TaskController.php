<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\SkillContract;
use App\Contracts\TaskContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $task;

    public function __construct(TaskContract $task)
    {
        $this->task = $task;
    }

    /**
     * @return Renderable
     */
    public function index() :Renderable
    {
        $tasks = $this->task->findByFilter(10,['skill','level']);
        return view('admin.tasks.index',compact('tasks'));
    }

    /**
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('admin.tasks.create');
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
            'level_id' => 'required|integer|exists:levels,id',
            'description' => 'sometimes|nullable|string',
        ]);

        $this->task->new($data);

        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.tasks.index');
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $t = $this->task->findOneById($id,['skill:id,name']);
        return view('admin.tasks.show',compact('t'));
    }

    /**
     * @param $id
     * @param SkillContract $skill
     * @return Renderable
     */
    public function edit($id,SkillContract $skill): Renderable
    {
        $t = $this->task->findOneById($id);
        return view('admin.tasks.edit',compact('t'));
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
            'level_id' => 'required|integer|exists:levels,id',
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
        return redirect()->route('admin.tasks.index');
    }

}
