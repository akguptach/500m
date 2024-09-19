<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Response;

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
        if (isset($_GET) && (!empty($_GET['columns']) || !empty($_GET['search']['value']))) {

            $query = Student::orderBy('first_name','asc');
            if($_GET['search']['value']){
                $query->where(function($q){
                    $q->orWhere('first_name', 'LIKE', '%' . $_GET['search']['value'] . '%');
                    $q->orWhere('last_name', 'LIKE', '%' . $_GET['search']['value'] . '%');
                    $q->orWhere('email', 'LIKE', '%' . $_GET['search']['value'] . '%');
                    $q->orWhere('phone_number', 'LIKE', '%' . $_GET['search']['value'] . '%');
                });
            }

            $datatable =  DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('website', function($row) {
                return $row->website?->website_type;
            })
            ->addColumn('action', function($row) {
                return '<a href="'.route('students.student.edit',['student'=>$row->id]).'" class="edit-link"><i class="fas fa-edit"></i></a>';
            })
            ->addColumn('view', function($row) {
                return '<a href="'.route('orders.new', $row->id).'" class="btn-sm btn btn-primary">View Orders<i class="fas fa-arrow-right"></i></a>';
            });

            $datatable->filterColumn('website', function($query, $keyword) {
                $query->whereHas('website', function($q){
                    $q->where('website_type',$_GET['columns'][5]['search']['value']);
                });
            });
            $datatable->rawColumns(['action','view']);
            return $datatable->make(true);
            ;
        }else{
            return view('student/view');
        }
        /*$website = '';
        if ($request->has('website')) {
            $website = $request->input('website');
        }

        $query = Student::orderBy('first_name','asc');
        if($website){
            $query->where('website_id', $website);
        }
        $students = $query->paginate(15);
        return view('student/view', compact('students','website'));*/
        
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


    public function StudentsExport(Request $request)
{

    $from = $request->from;
    $to = $request->to;

    $headers = array(
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=students.csv",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    );
    

    if($from && $to)
        $enquery = Student::whereBetween('created_at', [$from, $to])->get();
    elseif($from)
        $enquery = Student::whereDate('created_at', '>=', $from)->get();
    elseif($to)
        $enquery = Student::whereDate('created_at', '<=', $to)->get();
    else
        $enquery = Student::get();


    $columns = array('First Name', 'Last Name', 'Email', 'Mobile Number', 'Website', 'Member Since');
    $callback = function() use ($enquery, $columns)
    {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);
        foreach($enquery as $row) {
            $mobileNumber = (string) $row->phone_number;
            fputcsv($file, array($row->first_name,$row->last_name,  $row->email, $mobileNumber, $row?->website?->website_type, $row->created_at));
        }
        fclose($file);
    };
    return Response::stream($callback, 200, $headers);
}


    
}