<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\SkillContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    protected $skill;

    public function __construct(SkillContract $skill)
    {
        $this->skill = $skill;
    }

    /**
     * @return Renderable
     */
    public function index() :Renderable
    {
        $skills = $this->skill->findByFilter();
        return view('admin.skills.index',compact('skills'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:200|unique:skills,name',
            'description' => 'sometimes|nullable|string',
        ]);

        $this->skill->new($data);

        session()->flash('success',__('messages.create'));
        return redirect()->back();
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $s = $this->skill->findOneById($id,['tasks']);
        return view('admin.skills.show',compact('s'));
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id): Renderable
    {
        $s = $this->skill->findOneById($id);
        return view('admin.skills.edit',compact('s'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id,Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:200|unique:skills,name,'.$id,
            'description' => 'sometimes|nullable|string',
        ]);

        $this->skill->update($id,$data);

        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.skills.show',$id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->skill->delete($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.skills.index');
    }

}
