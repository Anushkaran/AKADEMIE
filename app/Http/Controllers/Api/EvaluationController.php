<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EvaluationSession;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    protected $ev;

    public function __construct(EvaluationSession $ev)
    {
        $this->ev = $ev;
    }

    public function index()
    {

    }

    public function getSessions($id)
    {

    }
}
