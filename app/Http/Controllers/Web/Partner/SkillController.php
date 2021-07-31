<?php

namespace App\Http\Controllers\Web\Partner;

use App\Contracts\SkillContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    protected $skill;

    public function __construct(SkillContract $skill)
    {
        $this->skill = $skill;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $skills = $this->skill->findByFilter();
        return response()->json([
            'success' => true,
            'skills' => $skills
        ]);
    }
}
