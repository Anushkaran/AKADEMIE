<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\PartnerContract;
use App\Contracts\StudentContract;
use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\Partner;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * @var StudentContract
     */
    protected $student;

    /**
     * EvaluationController constructor.
     * @param StudentContract $student
     */
    public function __construct(StudentContract $student)
    {
        $this->student = $student;
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
                'students'=> $this->student->findByFilter(10,[],['id','first_name','last_name'])
            ]);
        }
        $partner = null;
        if ($request->has('partner'))
        {
            $partner = Partner::find($request->input('partner'));
        }

        $students = $this->student->findByFilter();
        return view('admin.students.index',compact('students','partner'));
    }

    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('admin.students.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->getValidatedData($request);

        $this->student->new($data);

        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.students.index');
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $student = $this->student->findOneById($id);
        $evaluations = Evaluation::whereHas('students',function ($query) use ($student){
            $query->where('students.id',$student->id);
        })->paginate(10);
        return view('admin.students.show',compact('student','evaluations'));
    }

    /**
     * @param $id
     * @param PartnerContract $p
     * @return Renderable
     */
    public function edit($id,PartnerContract $p) : Renderable
    {
        $student = $this->student->findOneById($id);
        $partners = $p->findByFilter(-1,[],['id','name']);

        return view('admin.students.edit',compact('student','partners'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id, Request $request): RedirectResponse
    {
        $data =$this->getValidatedData($request);

        $this->student->update($id,$data);
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.students.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->student->delete($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.students.index');
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
