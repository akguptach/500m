<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Http\Requests\SubjectRequest;
use App\Services\SubjectService;


class SubjectController extends Controller
{

    public function __construct(protected SubjectService $subjectService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->subjectService->getSubjects());
        } else {
            return view('subject/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subject/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        Subject::create(
            [
                'subject_name' => $request->subject_name, 'price' => $request->price, 'additional_word_rate' => $request->additional_word_rate
            ]
        );
        return redirect('/subject')->with('status', 'Subject Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $datas = Subject::where('id', $id)->first();
        return view('subject/edit', array('formAction' => route('subject.update', ['subject' => $id]), 'data' => $datas));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Subject::where('id', $id)->update([
            'subject_name' => $request->subject_name,
            'price' => $request->price,
            'additional_word_rate' => $request->additional_word_rate,

        ]);
        return redirect('/subject')->with('status', 'Subject Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::find($id);
        if (!empty($subject)) {
            $subject->delete();
            return redirect('/subject')->with('status', 'Subject Deleted Successfully');
        } else {
            return redirect('/subject');
        }
    }
}
