<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\SkillContract;
use App\Contracts\TaskContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
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
     * @param Request $request
     * @return Renderable|JsonResponse
     */
    public function index(Request $request)
    {
        $skills = $this->skill->findByFilter();
        if ($request->wantsJson())
        {
            return response()->json([
                'success' => true,
                'skills' => $skills
            ]);
        }
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
        $s = $this->skill->findOneById($id,['tasks'=> function($q){
            $q->latest();
        }]);

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

    public function taskStore($id,Request $request,TaskContract $contract)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'sometimes|nullable|string',
        ]);

        $data['skill_id'] = $id;
        $contract->new($data);
        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.skills.show',$id);
    }

}
