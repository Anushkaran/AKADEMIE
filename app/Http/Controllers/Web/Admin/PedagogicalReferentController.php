<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\PartnerContract;
use App\Contracts\PedagogicalReferentContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PedagogicalReferentController extends Controller
{
    /**
     * @var PedagogicalReferentContract
     */
    protected $referent;

    /**
     * EvaluationController constructor.
     * @param PedagogicalReferentContract $referent
     */
    public function __construct(PedagogicalReferentContract $referent)
    {
        $this->referent = $referent;
    }

    /**
     * @return Renderable|JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->wantsJson())
        {
            return response()->json([
                'success' => true,
                'referents'=> $this->referent->findByFilter(10,[],['id','first_name','last_name'])
            ]);
        }
        $referents = $this->referent->findByFilter();
        return view('admin.pedagogical-referents.index',compact('referents'));
    }

    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('admin.pedagogical-referents.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->getValidatedData($request);

        $this->referent->new($data);

        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.pedagogical-referents.index');
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $referent = $this->referent->findOneById($id);
        return view('admin.pedagogical-referents.show',compact('referent'));
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id,PartnerContract $p) : Renderable
    {
        $referent = $this->referent->findOneById($id);
        $partners = $p->findByFilter(-1,[],['id','name']);

        return view('admin.pedagogical-referents.edit',compact('referent','partners'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id, Request $request): RedirectResponse
    {
        $data =$this->getValidatedData($request);

        $this->referent->update($id,$data);
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.pedagogical-referents.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->referent->delete($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.pedagogical-referents.index');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getValidatedData(Request $request): array
    {
        $rules = [
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'partner_id'    => 'required|integer|exists:partners,id',
            'email'         => 'required|email',
            'phone'         => 'required|string|max:20',
            'address'       => 'required|string|max:200',
        ];

        if ($request->method() === 'PUT')
        {
            unset($rules['partner_id']);
        }
        return $request->validate($rules);
    }
}
