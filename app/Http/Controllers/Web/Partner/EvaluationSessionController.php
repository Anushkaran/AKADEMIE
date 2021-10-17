<?php

namespace App\Http\Controllers\Web\Partner;

use App\Contracts\EvaluationContract;
use App\Contracts\EvaluationSessionContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EvaluationSessionController extends Controller
{

    protected $s;
    protected $ev;

    public function __construct(EvaluationSessionContract $s,EvaluationContract $ev)
    {
        $this->s = $s;
        $this->ev = $ev;
    }


    /**
     * Display a listing of the resource.
     *
     * @param $evaluation
     * @return Renderable
     */
    public function index($evaluation) :Renderable
    {

        $ev = $this->ev->findOneById($evaluation,['sessions'],['*'],[],['finalSession']);
        $title = __('labels.list',['name' => trans_choice('labels.evaluation-session',3)]);
        return view('partner.evaluations.tabs.show',compact('ev','title'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param $evaluation
     * @param Request $request
     * @return RedirectResponse
     */
    public function store($evaluation,Request $request): RedirectResponse
    {
        $data = $request->validate([
            'users'         => 'required|array',
            'users.*'       => 'required|integer',
            'name'          => 'required|string|max:150',
            'date'          => 'required|date',
            'note'          => 'sometimes|nullable|string|max:200',
        ]);

        $data['is_final'] = $request->has('is_final');
        $this->ev->createSession($evaluation,$data);
        session()->flash('success',__('messages.create'));
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param $evaluation
     * @param $session
     * @return Renderable
     */
    public function show($evaluation,$session) : Renderable
    {
        $session = $this->s->findOneBy(['id' => $session,'evaluation_id' => $evaluation],['tasks.level','users']);
        return  view('partner.evaluations.sessions.show',compact('session'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $evaluation
     * @param $session
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($evaluation,$session,Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'          => 'required|string|max:150',
            'date'          => 'required|date',
            'note'          => 'sometimes|nullable|string|max:200',
        ]);

        $data['evaluation'] = $evaluation;
        $this->s->update($session,$data);
        session()->flash('success',__('messages.update'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $evaluation
     * @param $session
     * @return RedirectResponse
     */
    public function destroy($evaluation,$session): RedirectResponse
    {
        $this->ev->deleteSession($evaluation,$session);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('partner.evaluations.sessions.index',$evaluation);
    }

    public function attachUser($evaluation,$session,Request $request): RedirectResponse
    {
        $data = $request->validate([
            'users' => 'required|array',
            'users.*' => 'required|integer',
        ]);

        $this->s->attachUser($evaluation,$session,$data);
        session()->flash('success',__('messages.create'));
        return redirect()->back();
    }

    public function detachUser($evaluation,$session,$user): RedirectResponse
    {
        $this->s->detachUser($evaluation,$session,$user);
        session()->flash('success',__('messages.delete'));
        return redirect()->back();
    }

    public function attachTask($evaluation,$session,Request $request): RedirectResponse
    {
        $data = $request->validate([
            'tasks' => 'required|array',
            'tasks.*' => 'required|integer',
        ]);

        $this->s->attachTask($evaluation,$session,$data);
        session()->flash('success',__('messages.create'));
        return redirect()->back();
    }

    public function detachTask($evaluation,$session,$task): RedirectResponse
    {
        $this->s->detachTask($evaluation,$session,$task);
        session()->flash('success',__('messages.delete'));
        return redirect()->back();
    }
}
