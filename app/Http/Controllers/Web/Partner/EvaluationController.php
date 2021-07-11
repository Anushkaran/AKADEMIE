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

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update($id, Request $request)
    {

    }

    public function destroy($id)
    {

    }
}
