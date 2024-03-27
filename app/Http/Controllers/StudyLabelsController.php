<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\StudyLabelsModel;

use App\Http\Requests\StudyLabelsRequest;
use App\Services\StudyLabelsService;


class StudyLabelsController extends Controller
{

    public function __construct(protected StudyLabelsService $studyLabelsService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->studyLabelsService->getStudyLavels());
        } else {
            return view('study_label/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('study_label/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudyLabelsRequest $request)
    {

        StudyLabelsModel::create(['label_name' => $request->label_name, 'price' => $request->price]);
        return redirect('/studylabel')->with('status', 'Study Label Created Successfully');
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
        $datas = StudyLabelsModel::where('id', $id)->first();
        return view('study_label/edit', array('formAction' => route('studylabel.update', ['studylabel' => $id]), 'data' => $datas));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudyLabelsRequest $request, string $id)
    {
        StudyLabelsModel::where('id', $id)->update([
            'label_name' => $request->label_name, 'price' => $request->price
        ]);
        return redirect('/studylabel')->with('status', 'Study Label Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $label = StudyLabelsModel::find($id);
        if (!empty($label)) {
            $label->delete();
            return redirect('/studylabel')->with('status', 'Study Label Deleted Successfully');
        } else {
            return redirect('/studylabel');
        }
    }
}
