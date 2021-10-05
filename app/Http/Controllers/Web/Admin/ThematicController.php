<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\ThematicContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ThematicController extends Controller
{
    protected $thematic;

    public function __construct(ThematicContract $thematic)
    {
        $this->thematic = $thematic;
    }

    /**
     * @return Renderable
     */
    public function index() :Renderable
    {
        $thematics = $this->thematic->findByFilter(10,['skill','level']);
        return view('admin.thematics.index',compact('thematics'));
    }

    /**
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('admin.thematics.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:200',
        ]);

        $this->thematic->new($data);

        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.thematics.index');
    }



    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id): Renderable
    {
        $t = $this->thematic->findOneById($id);
        return view('admin.thematics.edit',compact('t'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id,Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:200',
        ]);

        $this->thematic->update($id,$data);

        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.thematics.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->thematic->delete($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.thematics.index');
    }

}
