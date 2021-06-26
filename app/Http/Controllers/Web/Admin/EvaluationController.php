<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\EvaluationContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{

    /**
     * @var EvaluationContract
     */
    protected $ev;

    /**
     * EvaluationController constructor.
     * @param EvaluationContract $ev
     */
    public function __construct(EvaluationContract $ev)
    {
        $this->ev = $ev;
    }

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $evaluations = $this->ev->findByFilter();
        return view('admin.evaluations.index',compact('evaluations'));
    }

    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('admin.evaluations.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'          => 'required|string|max:100',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after:start_date',
        ]);

        $this->ev->create($data);
        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.evaluations.index');
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $ev = $this->ev->findOneById($id);
        return view('admin.evaluations.show',compact('ev'));
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id) : Renderable
    {
        $ev = $this->ev->findOneById($id);
        return view('admin.evaluations.edit',compact('ev'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id, Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:100',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after:start_date',
        ]);

        $this->ev->update($id,$data);
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.evaluations.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->ev->delete($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.evaluations.index');
    }
}
