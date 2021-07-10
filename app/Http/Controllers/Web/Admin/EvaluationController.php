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
            'partner_id'    => 'required|integer|exists:partners,id',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after:start_date',
        ]);

        $this->ev->new($data);
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
        $title = __('labels.list',['name' => trans_choice('labels.evaluation-session',3)]);
        return view('admin.evaluations.tabs.show',compact('ev','title'));
    }

    public function skillsList($id)
    {
        $ev = $this->ev->findOneById($id,['skills']);
        $title = __('labels.list',['name' => trans_choice('labels.skill',3)]);
        return view('admin.evaluations.tabs.skills',compact('ev','title'));
    }

    public function studentsList($id)
    {
        $ev = $this->ev->findOneById($id,['students']);
        $title = __('labels.list',['name' => trans_choice('labels.student',3)]);
        return view('admin.evaluations.tabs.students',compact('ev','title'));
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
    public function update($id, Request $request): RedirectResponse
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
