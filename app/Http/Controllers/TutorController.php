<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Tutor;
use App\Models\Subject;

use App\Http\Requests\CreateTutorRequest;
use App\Http\Requests\UpdateTutorRequest;
use App\Services\TutorService;

class TutorController extends Controller
{

    public function __construct(protected TutorService $tutorService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->tutorService->getTutors());
        } else {
            return view('tutor/view');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('tutor/create', array('subjects' => $subjects));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTutorRequest $request)
    {
        $tutor = $this->tutorService->saveTutor($request);
        return redirect('/tutor' . $tutor->profile_status)->with('status', 'Tutor Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subjects = Subject::all();
        $datas = Tutor::find($id);
        return view('tutor/edit', array('formAction' => route('tutor.update', ['tutor' => $id]), 'data' => $datas, 'subjects' => $subjects));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTutorRequest $request, string $id)
    {

        $tutor = $this->tutorService->saveTutor($request, $id);
        return redirect('/tutor_view/' . $tutor->profile_status)->with('status', 'Tutor Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tutor = Tutor::find($id);
        $profile_status = $tutor->profile_status;
        if (!empty($tutor)) {
            $tutor->delete();
            return redirect('/tutor_view/' . $profile_status)->with('status', 'Tutor Deleted Successfully');
        } else {
            return redirect('/tutor_view/incompelte');
        }
    }
}
