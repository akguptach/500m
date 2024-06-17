<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use Illuminate\Http\Request;
use Exception;
use App\Http\Requests\ExpertRequest;
use App\Models\Subject;
use App\Models\ExpertSubject;

class ExpertsController extends Controller
{

    /**
     * Display a listing of the experts.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $experts = Expert::paginate(25);
        return view('experts.index', compact('experts'));
    }

    /**
     * Show the form for creating a new expert.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $subjects  =   Subject::all();
        return view('experts.create',compact('subjects'));
    }


    public function addreview()
    {
        return view('experts.addreview');
    }

    

    /**
     * Store a new expert in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(ExpertRequest $request)
    {
        $data = $request->all();

        

        $image = '';
        if ($request->has("image")) {
            $image = request()->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/uploads/attachment/'), $imageName);
            $image = env('APP_URL') . '/images/uploads/attachment/' . $imageName;
        }
        $data['image'] = $image;
        $expert = Expert::create($data);
        foreach ($request->expert_subject as $subject) {
            ExpertSubject::Create([
                'expert_id' => $expert->id,
                'subject_id' => $subject
            ]);
        }
        return redirect()->route('experts.expert.index')
            ->with('success_message', 'Expert was successfully added.');
    }

    /**
     * Display the specified expert.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $expert = Expert::findOrFail($id);

        return view('experts.show', compact('expert'));
    }

    /**
     * Show the form for editing the specified expert.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $expert = Expert::findOrFail($id);
        $subjects  =   Subject::all();
        return view('experts.edit', compact('expert','subjects'));
    }

    /**
     * Update the specified expert in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $data = $request->all();
        $expert = Expert::findOrFail($id);

        $image = $expert->image;
        if ($request->has("image")) {
            $image = request()->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/uploads/attachment/'), $imageName);
            $image = env('APP_URL') . '/images/uploads/attachment/' . $imageName;
        }
        $data['image'] = $image;

        ExpertSubject::where('expert_id',$expert->id)->delete();
        foreach ($request->expert_subject as $subject) {
            ExpertSubject::Create([
                'expert_id' => $expert->id,
                'subject_id' => $subject
            ]);
        }

        $expert->update($data);

        return redirect()->route('experts.expert.index')
            ->with('success_message', 'Expert was successfully updated.');  
    }

    /**
     * Remove the specified expert from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $expert = Expert::findOrFail($id);
            $expert->delete();

            return redirect()->route('experts.expert.index')
                ->with('success_message', 'Expert was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function change($id, Request $request)
    {
        try {
            $expert = Expert::findOrFail($id);
            $expert->status = $request->status;
            $expert->save();
            return redirect()->route('experts.expert.index')
                ->with('status', 'Expert was successfully activated.');
        } catch (\Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    
    

}