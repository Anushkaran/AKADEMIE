<?php

namespace App\Http\Controllers\Web\Partner;

use App\Contracts\EvaluationContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
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
        $evaluations = $this->ev->findByPartner(auth('partner')->id(),10,[],['*']);
        $evaluations->loadCount(['sessions','students']);
        return view('partner.evaluations.index',compact('evaluations'));
    }

    public function create()
    {
        return view('partner.evaluations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:100',
            'center_id'     => 'required|integer|exists:centers,id',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after:start_date',
        ]);
        $data['partner_id'] = auth('partner')->id();
        $e = $this->ev->new($data);
        session()->flash(__('messages.create'));
        return redirect()->route('partner.evaluations.show',$e->id);
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $ev = $this->ev->findOneById($id);
        if ($ev->partner_id !== auth('partner')->id())
        {
            abort(404);
        }
        $title = __('labels.list',['name' => trans_choice('labels.evaluation-session',3)]);
        return view('partner.evaluations.tabs.show',compact('ev','title'));
    }
    public function edit($id)
    {
        $ev = $this->ev->findOneById($id,['sessions']);

        if ($ev->partner_id !== auth('partner')->id())
        {
            abort(404);
        }

        return view('partner.evaluations.edit',compact('ev'));
    }

    public function update($id, Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'name'          => 'required|string|max:100',
            'start_date'    => 'required|date',
            'center_id'     => 'required|integer|exists:centers,id',
            'end_date'      => 'required|date|after:start_date',
        ]);
        $this->ev->update($id,$data);
        session()->flash(__('messages.update'));
        return redirect()->route('partner.evaluations.show',$id);
    }

    public function destroy($id)
    {
        $ev = $this->ev->findOneById($id);

        if ($ev->partner_id !== auth('partner')->id())
        {
            abort(404);
        }

        $ev->delete();
        session()->flash(__('messages.delete'));

        return redirect()->route('partner.evaluations.index');
    }

    public function skillsList($id)
    {
        $ev = $this->ev->findOneById($id,['skills.tasks.level']);
        if ($ev->partner_id !== auth('partner')->id())
        {
            abort(404);
        }
        $title = __('labels.list',['name' => trans_choice('labels.skill',3)]);
        return view('partner.evaluations.tabs.skills',compact('ev','title'));
    }

    public function studentsList($id)
    {
        $ev = $this->ev->findOneById($id,['students']);

        if ($ev->partner_id !== auth('partner')->id())
        {
            abort(404);
        }

        $title = __('labels.list',['name' => trans_choice('labels.student',3)]);
        return view('partner.evaluations.tabs.students',compact('ev','title'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function attachSkills($id,Request $request): RedirectResponse
    {
        $data = $request->validate([
            'skills'    => 'required|array',
            'skills.*'  => 'required|integer'
        ]);

        $this->ev->attachSkill($id,$data);
        session()->flash('success',__('messages.attach'));
        return redirect()->back();
    }

    public function removeSkills($id,$skill)
    {
        $this->ev->detachSkill($id,$skill);
        session()->flash('success',__('messages.removed'));
        return redirect()->back();
    }

    public function attachStudents($id,Request $request)
    {
        $data = $request->validate([
            'students'    => 'required|array',
            'students.*'  => 'required|integer'
        ]);

        $this->ev->attachStudent($id,$data);
        session()->flash('success',__('messages.attach'));
        return redirect()->back();
    }

    public function removeStudents($id,$student)
    {
        $this->ev->detachStudent($id,$student);
        session()->flash('success',__('messages.removed'));
        return redirect()->back();
    }

    public function addSession($id,Request $request)
    {
        $data = $request->validate([
            'user_id'       => 'required|integer|exists:users,id',
            'name'          => 'required|string|max:150',
            'date'          => 'required|date',
            'note'          => 'sometimes|nullable|string|max:200',
        ]);

        $this->ev->createSession($id,$data);
        session()->flash('success',__('messages.create'));
        return redirect()->back();
    }

    public function deleteSession($id,$session): RedirectResponse
    {
        $this->ev->deleteSession($id,$session);
        session()->flash('success',__('messages.delete'));
        return redirect()->back();
    }

    public function disableStudent($id,$student)
    {
        $ev = $this->ev->findOneById($id,[],['id'],[],['students' => function($s) use($student){
            $s->where('students.id',$student);
        }]);

        if ($ev->students->count() === 0){
            return response()->json([
                'success' => false,
                'message' => 'student not found',
            ],404);
        }

        $ev->students()->updateExistingPivot($student, array('is_canceled' => true), true);
        return response()->json([
            'success' => true,
            'message' => 'student status was updated successfully',
            'is_canceled' => true

        ],201);
    }

    public function enableStudent($id,$student)
    {

        $ev = $this->ev->findOneByPartner(auth('partner')->id(),$id,[],['id','partner_id'],[],['students' => function($s) use($student){
            $s->where('students.id',$student);
        }]);

        if ($ev->students->count() === 0){
            return response()->json([
                'success' => false,
                'message' => 'student not found',
            ],404);
        }

        $ev->students()->updateExistingPivot($student, array('is_canceled' => false), true);
        return response()->json([
            'success' => true,
            'message' => 'student status was updated successfully',
            'is_canceled' => false
        ],201);
    }
}
