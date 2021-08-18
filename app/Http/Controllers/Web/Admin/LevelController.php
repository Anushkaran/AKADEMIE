<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\LevelContract;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LevelController extends Controller
{
    protected $level;

    public function __construct(LevelContract $level)
    {
        $this->level = $level;
    }

    /**
     *
     */
    public function index(Request $request)
    {
        if ($request->wantsJson())
        {
            return response()->json([
                'success' => true,
                'levels' => $this->level->findByFilter(10,[],['id','name'])
            ]);
        }
        $levels = $this->level->findByFilter();
        return view('admin.levels.index',compact('levels'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->getValidatedDate($request);
        $this->level->new($data);
        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.levels.index');
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id) : Renderable
    {
        $level = $this->level->findOneById($id);
        return view('admin.levels.edit',compact('level'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id, Request $request): RedirectResponse
    {
        $data = $this->getValidatedDate($request);
        $this->level->update($id,$data);
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.levels.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->level->delete($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.levels.index');
    }

    private function getValidatedDate(Request $request): array
    {
        $rules = [
            'name' => 'required|string|max:100|unique:levels,name',
        ];

        if ($request->method() === 'PUT')
        {
            $rules['name'] = 'required|string|max:100|unique:levels,name,'.$request->route('level');
        }

        return $request->validate($rules);
    }
}
