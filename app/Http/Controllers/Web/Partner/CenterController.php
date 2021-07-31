<?php

namespace App\Http\Controllers\Web\Partner;

use App\Contracts\CenterContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    protected $center;

    public function __construct(CenterContract $center)
    {
        $this->center = $center;
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => true,
            'centers' => $this->center->findByFilter(10,[],['id','name'])
        ]);
    }
}
