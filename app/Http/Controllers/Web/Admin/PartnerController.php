<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\PartnerContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    protected $partner;

    public function __construct(PartnerContract $partner)
    {
        $this->partner = $partner;
    }

    /**
     * @param Request $request
     * @return Renderable|JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->wantsJson())
        {
            return response()->json([
                'success' => true,
                'partners' => $this->partner->findByFilter(10,[],['id','name'])
            ]);
        }

        $partners = $this->partner->findByFilter();
        return view('admin.partners.index',compact('partners'));
    }

    /**
     * @return Renderable
     */
    public function create() : Renderable
    {
        return view('admin.partners.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->getValidatedDate($request);
        $this->partner->new($data);
        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.partners.index');
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function show($id) : Renderable
    {
        $partner = $this->partner->findOneById($id);
        return view('admin.partners.show',compact('partner'));
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id) : Renderable
    {
        $partner = $this->partner->findOneById($id);
        return view('admin.partners.edit',compact('partner'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id, Request $request): RedirectResponse
    {
        $data = $this->getValidatedDate($request);
        $this->partner->update($id,$data);
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.partners.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->partner->delete($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.partners.index');
    }


    public function editPassword($id)
    {
        $partner = $this->partner->findOneById($id,[],['id']);
        return view('admin.partners.edit-password',compact('partner'));
    }

    public function updatePassword($id,Request $request)
    {
        $data = $request->validate([
            'password' => 'required|string|max:24|min:8|confirmed'
        ]);

        $this->partner->update($id,$data);
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.partners.show',$id);
    }
    private function getValidatedDate(Request $request): array
    {
        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:partners,email',
            'leader'  => 'required|string|max:200',
            'leader_phone'=> 'required|string|max:20',
            'department'=> 'required|string|max:200',
            'state'=> 'required|integer|in:'.implode(',',config('settings.account_states')),
            'legal_referent'=> 'required|string|max:200',
            'legal_referent_phone'=> 'required|string|max:20',
            'administrative_referent'=> 'required|string|max:200',
            'administrative_referent_phone'=> 'required|string|max:20',
            'phone' => 'required|string|max:20|unique:partners,phone',
            'password' => 'required|string|min:8|max:24|confirmed',
        ];

        if ($request->method() === 'PUT')
        {
            $rules['password'] = 'sometimes|nullable|string|min:8|max:24|confirmed';
            $rules['email'] = 'required|email|unique:partners,email,'.$request->route('partner');
            $rules['phone'] = 'required|string|max:20|unique:partners,phone,'.$request->route('partner');
        }

        return $request->validate($rules);
    }

}
