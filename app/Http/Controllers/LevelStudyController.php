<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Level_study;

use App\Http\Requests\LevelStudyRequest;
use App\Services\LevelStudyService;

class LevelStudyController extends Controller
{

    public function __construct(protected LevelStudyService $levelStudyService)
    {
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->levelStudyService->getLavelStudy());
        } else {
            return view('level_study/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('level_study/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LevelStudyRequest $request)
    {

        Level_study::create([
            'website_type' => $request->website_type,
            'level_name'  => $request->level_name,
            'price'       => $request->price,
            'website_type' => $request->website_type

        ]);
        return redirect('/level_study')->with('status', 'Level Created Successfully');
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
        $datas = Level_study::find($id);
        return view('level_study/edit', array('formAction' => route('level_study.update', ['level_study' => $id]), 'data' => $datas));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LevelStudyRequest $request, string $id)
    {



        Level_study::where('id', $id)->update([
            'level_name' => $request->level_name,
            'price' => $request->price,
            'website_type' => $request->website_type
        ]);
        return redirect('/level_study')->with('status', 'Level Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $level = Level_study::find($id);
        if (!empty($level)) {
            $level->delete();
            return redirect('/level_study')->with('status', 'Level Deleted Successfully');
        } else {
            return redirect('/level_study');
        }
    }
}
