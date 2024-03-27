<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Grades;

use App\Services\GradesService;
use App\Http\Requests\GradesRequest;


class GradesController extends Controller
{

    public function __construct(protected GradesService $gradesService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->gradesService->getGrades());
        } else {
            return view('grade/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('grade/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GradesRequest $request)
    {
        Grades::create(['grade_name' => $request->grade_name, 'price' => $request->price]);
        return redirect('/grade')->with('status', 'Grade Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $datas = Grades::find($id);
        return view('grade/edit', array('formAction' => route('grade.update', ['grade' => $id]), 'data' => $datas));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GradesRequest $request, string $id)
    {
        Grades::where('id', $id)->update([
            'grade_name' => $request->grade_name,            'price' => $request->price
        ]);
        return redirect('/grade')->with('status', 'Grade Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grade = Grades::find($id);
        if (!empty($grade)) {
            $grade->delete();
            return redirect('/grade')->with('status', 'Grade Deleted Successfully');
        } else {
            return redirect('/grade');
        }
    }
}
