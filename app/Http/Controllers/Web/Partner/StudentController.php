<?php

namespace App\Http\Controllers\Web\Partner;

use App\Contracts\StudentContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $student;

    public function __construct(StudentContract $student)
    {
        $this->student = $student;
    }

    public function index(Request $request)
    {
        if ($request->wantsJson())
        {
            return response()->json([
                'success'   => true,
                'students'  => $this->student->findByFilter(
                    10,
                    [],
                    ['id','first_name','last_name','partner_id'],
                    ['perPartner:'.auth('partner')->id()]
                ),
            ]);
        }

        $students = $this->student->findByFilter(
            10,
            [],
            ['*'],
            ['perPartner:'.auth('partner')->id()]
        );
        return view('partner.students.index',compact('students'));
    }

    public function create()
    {
        return view('partner.students.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email',
            'phone'      => 'required|string|max:20',
            'address'    => 'required|string|max:200'
        ]);

        $data['partner_id'] = auth('partner')->id();

        $this->student->new($data);
        session()->flash('success',__('messages.create'));
        return redirect()->route('partner.students.index');
    }

    public function show($id)
    {
        $student = $this->student->findOneById($id);
        return view('partner.students.show',compact('student'));
    }

    public function edit($id)
    {
        $student = $this->student->findOneById($id);
        return view('partner.students.edit',compact('student'));
    }

    public function update($id,Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email',
            'phone'      => 'required|string|max:20',
            'address'    => 'required|string|max:200'
        ]);

        $this->student->update($id,$data);
        session()->flash('success',__('messages.update'));
        return redirect()->route('partner.students.index');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $this->student->delete($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('partner.students.index');
    }
}
