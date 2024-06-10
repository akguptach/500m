<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\Request;

class StudentsController extends Controller
{

    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $website = '';
        if ($request->has('website')) {
            $website = $request->input('website');
        }

        $query = Student::orderBy('first_name','asc');
        if($website){
            $query->where('website_id', $website);
        }
        $students = $query->paginate(15);
        return view('student/view', compact('students','website'));
        
    }



    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('student/edit',compact('student'));
    }

    public function update($id, StudentRequest $request)
    {
        $data = $request->all();
        $student = Student::findOrFail($id);
        $student->update($data);
        return redirect()->route('students.student.index')
            ->with('status', 'Student was successfully updated.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('student/create');
    }

    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();

            return redirect()->route('students.student.index')
                ->with('status', 'Student was successfully deleted.');
        } catch (\Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function change($id, Request $request)
    {
        try {
            $student = Student::findOrFail($id);
            $student->status = $request->status;
            $student->save();
            return redirect()->route('students.student.index')
                ->with('status', 'Student was successfully activated.');
        } catch (\Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    
}