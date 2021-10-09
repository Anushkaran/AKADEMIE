<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\EvaluationContract;
use App\Contracts\EvaluationSessionContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

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
        $ev = $this->ev->findOneById($evaluation,['sessions']);
        $title = __('labels.list',['name' => trans_choice('labels.evaluation-session',3)]);
        return view('admin.evaluations.tabs.show',compact('ev','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $session = $this->s->findOneBy(['id' => $session,'evaluation_id' => $evaluation]);
        return  view('admin.evaluations.sessions.show',compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function attachUser($evaluation,$session,Request $request)
    {
        $data = $request->validate([
            'users' => 'required|array',
            'users.*' => 'required|integer',
        ]);

        $this->s->attachUser($evaluation,$session,$data);
        session()->flash('success',__('messages.create'));
        return redirect()->back();
    }

    public function detachUser($evaluation,$session,$user)
    {
        $this->s->detachUser($evaluation,$session,$user);
        session()->flash('success',__('messages.delete'));
        return redirect()->back();
    }
}
