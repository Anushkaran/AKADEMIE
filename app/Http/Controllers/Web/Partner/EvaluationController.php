<?php

namespace App\Http\Controllers\Web\Partner;

use App\Contracts\EvaluationContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    protected $ev;

    public function __construct(EvaluationContract $ev)
    {
        $this->ev = $ev;
    }

    public function index()
    {
        return view('partner.evaluations.index');
    }

    public function create()
    {
        return view('partner.evaluations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:100',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after:start_date',
        ]);
        $data['partner_id'] = auth('partner')->id();
        $e = $this->ev->new($data);
        session()->flash(__('messages.create'));
        return redirect()->route('partner.evaluations.show',$e->id);
    }

    public function show($id)
    {
        $ev = $this->ev->findOneById($id,['sessions']);

        if ($ev->partner_id !== auth('partner')->id())
        {
            abort(404);
        }

        return view('partner.evaluations.show',compact('ev'));
    }

    public function edit($id)
    {
        $ev = $this->ev->findOneById($id,['sessions']);

        if ($ev->partner_id !== auth('partner')->id())
        {
            abort(404);
        }

        return view('partner.evaluations.show',compact('ev'));
    }

    public function update($id, Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'name'          => 'required|string|max:100',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after:start_date',
        ]);
        $this->ev->update($id,$data);
        session()->flash(__('messages.update'));
        return redirect()->route('partner.evaluations.show',$id);
    }

    public function destroy($id)
    {
        $ev = $this->ev->findOneById($id,['sessions']);

        if ($ev->partner_id !== auth('partner')->id())
        {
            abort(404);
        }

        $ev->delete();
        session()->flash(__('messages.delete'));

        redirect()->route('partner.evaluations.index');
    }
}
