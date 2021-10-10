<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\EvaluationContract;
use App\Contracts\StudentContract;
use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\Skill;
use App\Models\Student;
use App\Models\Task;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{

    /**
     * @var EvaluationContract
     */
    protected $ev;

    /**
     * EvaluationController constructor.
     * @param EvaluationContract $ev
     */
    public function __construct(EvaluationContract $ev)
    {
        $this->ev = $ev;
    }

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $evaluations = $this->ev->findByFilter(10,['partner:id,name']);
        return view('admin.evaluations.index',compact('evaluations'));
    }

    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('admin.evaluations.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'          => 'required|string|max:100',
            'center_id'    => 'required|integer|exists:centers,id',
            'partner_id'    => 'required|integer|exists:partners,id',
            'start_date'    => 'required|date',
            'date_exam'    => 'required|date',
            'end_date'      => 'required|date|after:start_date',
        ]);
        $data['state'] = $request->has('state');

        $this->ev->new($data);
        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.evaluations.index');
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $ev = $this->ev->findOneById($id,['sessions']);
        $title = __('labels.list',['name' => trans_choice('labels.evaluation-session',3)]);
        return view('admin.evaluations.tabs.show',compact('ev','title'));
    }

    public function skillsList($id)
    {
        $ev = $this->ev->findOneById($id,['skills.tasks.level']);
        $title = __('labels.list',['name' => trans_choice('labels.skill',3)]);
        return view('admin.evaluations.tabs.skills',compact('ev','title'));
    }

    public function studentsList($id)
    {
        $ev = $this->ev->findOneById($id,['students']);
        $title = __('labels.list',['name' => trans_choice('labels.student',3)]);
        return view('admin.evaluations.tabs.students',compact('ev','title'));
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id) : Renderable
    {
        $ev = $this->ev->findOneById($id);
        return view('admin.evaluations.edit',compact('ev'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'          => 'required|string|max:100',
            'center_id'    => 'required|integer|exists:centers,id',
            'start_date'    => 'required|date',
            'date_exam'    => 'required|date',
            'end_date'      => 'required|date|after:start_date',
        ]);
        $data['state'] = $request->has('state');
        $this->ev->update($id,$data);
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.evaluations.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->ev->delete($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.evaluations.index');
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

        $ev = $this->ev->findOneById($id,[],['id'],[],['students' => function($s) use($student){
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

    public function removeStudents($id,$student)
    {
        $this->ev->detachStudent($id,$student);
        session()->flash('success',__('messages.removed'));
        return redirect()->back();
    }



    public function deleteSession($id,$session): RedirectResponse
    {

    }

    public function studentDetails($id,$student)
    {
        $student  = Student::whereHas('evaluations',function ($ev) use ($id){
            $ev->where('evaluations.id',$id);
        })->with([
            'sessionStudents' => function($es) use($id){
                $es->with('tasks','session.user')->whereHas('session',function ($s) use($id){
                    $s->where('evaluation_sessions.evaluation_id',$id);
                });
            }
        ])->findOrFail($student);

        $tasks = Task::whereHas('skill',function ($s) use ($id){
            $s->whereHas('evaluations',function ($e) use ($id){
                $e->where('evaluations.id',$id);
            });
        })->get();

        return view('admin.evaluations.student',compact('student','id','tasks'));
    }
}
