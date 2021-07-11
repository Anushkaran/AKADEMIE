<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\PartnerContract;
use App\Contracts\StudentContract;
use App\Http\Controllers\Controller;
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
        $students = $this->student->findByFilter();
        return view('admin.students.index',compact('students'));
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
        return view('admin.students.show',compact('student'));
    }

    /**
     * @param $id
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
        return $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:200',
        ]);
    }
}
