<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\CenterContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    protected $center;

    public function __construct(CenterContract $center)
    {
        $this->center = $center;
    }

    public function index()
    {
        $centers = $this->center->findByFilter();
        return view('admin.centers.index',compact('centers'));
    }

    public function create()
    {
        return view('admin.centers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->center->new($this->getValidatedData($request));
        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.centers.index');
    }

    public function show($id) : Renderable
    {
        $center = $this->center->findOneById($id);
        return view('admin.centers.show',compact('center'));
    }


    public function edit($id) : Renderable
    {
        $center = $this->center->findOneById($id);
        return view('admin.centers.edit',compact('center'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id,Request $request): RedirectResponse
    {
        $this->center->update($id,$this->getValidatedData($request));
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.centers.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->center->delete($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.centers.index');
    }

    private function getValidatedData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:100',
            'note' => 'sometimes|nullable|string|max:250',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:200',
        ]);
    }
}
