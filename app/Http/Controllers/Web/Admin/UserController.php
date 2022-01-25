<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\PartnerContract;
use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserContract $user)
    {
        $this->user = $user;
    }

    public function index(Request $request,PartnerContract $p)
    {
        if ($request->wantsJson())
        {
            return response()->json([
                'success' => true,
                'users' => $this->user->findByFilter(10,[],['id','first_name','last_name'])
            ]);
        }

        $partner = null;
        if ($request->has('partner_id'))
        {
            $partner =  $p->findOneById($request->input('partner_id'));
        }

        $users = $this->user->findByFilter(10,['evaluationSessions' => function($query){
            $query->with('evaluation')->latest()->limit(1);
        }]);
        return view('admin.users.index',compact('users','partner'));
    }

    /**
     * @return Renderable
     */
    public function create() : Renderable
    {
        return view('admin.users.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->user->new($this->getValidatedData($request));
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.users.index');
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function show($id) : Renderable
    {
        $user = $this->user->findOneById($id,['evaluationSessions:id']);
        $evaluations = Evaluation::whereHas('sessions',function ($query) use ($user){
            $query->whereIn('evaluation_sessions.id',$user->evaluationSessions->pluck('id')->all());
        })->paginate(10);
        return view('admin.users.show',compact('user','evaluations'));
    }

    /**
     * @param $id
     * @param PartnerContract $p
     * @return Renderable
     */
    public function edit($id,PartnerContract $p) : Renderable
    {
        $user = $this->user->findOneById($id);
        $partners = $p->findByFilter(-1,[],['id','name']);
        return view('admin.users.edit',compact('user'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id,Request $request): RedirectResponse
    {
        $this->user->update($id,$this->getValidatedData($request));
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.users.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->user->delete($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.users.index');
    }

    public function editPassword($id)
    {
        $user = $this->user->findOneById($id,[],['id']);
        return view('admin.users.edit-password',compact('user'));
    }

    public function updatePassword($id,Request $request)
    {
        $data = $request->validate([
            'password' => 'required|string|max:24|min:8|confirmed'
        ]);

        $this->user->update($id,$data);
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.users.show',$id);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function getValidatedData(Request $request): array
    {
        $rules = [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'department'=> 'required|string|max:200',
            'organization'=> 'required|string|max:200',
            'type'  =>'required|string|in:'.implode(',',config('settings.user_types')),
            'phone' => 'sometimes|nullable|string|max:20',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|max:24|confirmed',
            'image' => 'sometimes|nullable|file|image|max:3000',
            'state' => 'required|integer|in:1,2',
            'partner_id' => 'required|integer|exists:partners,id',
            'thematics' => 'required|array',
        ];

        if ($request->method() === 'PUT' )
        {
            $rules['email'] = 'required|string|email|unique:users,email,'.$request->route('user');
            unset($rules['password']);
        }

        return $request->validate($rules);
    }
}
