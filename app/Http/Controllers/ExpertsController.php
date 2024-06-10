<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use Illuminate\Http\Request;
use Exception;

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
        
        
        return view('experts.create');
    }

    /**
     * Store a new expert in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $data = $this->getData($request);
        
        Expert::create($data);

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
        

        return view('experts.edit', compact('expert'));
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
        
        $data = $this->getData($request);
        
        $expert = Expert::findOrFail($id);
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

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
                'name' => 'string|min:1|max:255|nullable',
            'first_name' => 'string|min:1|nullable',
            'last_name' => 'string|min:1|nullable',
            'email' => 'nullable',
            'dob' => 'string|min:1|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
