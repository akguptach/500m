<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ServiceKeyword;
use Illuminate\Http\Request;
use Exception;
use App\Http\Requests\ServiceKeywordRequest;

class ServiceKeywordsController extends Controller
{

    /**
     * Display a listing of the service keywords.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $serviceKeywords = ServiceKeyword::orderBy('id', 'desc')->paginate(10);

        return view('service_keywords.index', compact('serviceKeywords'));
    }

    /**
     * Show the form for creating a new service keyword.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('service_keywords.create');
    }

    /**
     * Store a new service keyword in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(ServiceKeywordRequest $request)
    {
        
        $data = $this->getData($request);
        
        ServiceKeyword::create($data);

        return redirect()->route('service_keywords.service_keyword.index')
            ->with('success_message', 'Service Keyword was successfully added.');
    }

    /**
     * Display the specified service keyword.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $serviceKeyword = ServiceKeyword::findOrFail($id);

        return view('service_keywords.show', compact('serviceKeyword'));
    }

    /**
     * Show the form for editing the specified service keyword.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $serviceKeyword = ServiceKeyword::findOrFail($id);
        

        return view('service_keywords.edit', compact('serviceKeyword'));
    }

    /**
     * Update the specified service keyword in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, ServiceKeywordRequest $request)
    {
        
        $data = $this->getData($request);
        
        $serviceKeyword = ServiceKeyword::findOrFail($id);
        if(!isset($data['status'])){
            $data['status'] = 0;
        }
        $serviceKeyword->update($data);

        return redirect()->route('service_keywords.service_keyword.index')
            ->with('success_message', 'Service Keyword was successfully updated.');  
    }

    /**
     * Remove the specified service keyword from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $serviceKeyword = ServiceKeyword::findOrFail($id);
            $serviceKeyword->delete();

            return redirect()->route('service_keywords.service_keyword.index')
                ->with('success_message', 'Service Keyword was successfully deleted.');
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
        $data = $request->all();
        return $data;
    }

    public function change($id, Request $request)
    {
        try {
            $ServiceKeyword = ServiceKeyword::findOrFail($id);
            $ServiceKeyword->status = $request->status;
            $ServiceKeyword->save();
            return redirect()->route('service_keywords.service_keyword.index')
                ->with('status', 'Service Keyword status changed');
        } catch (\Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

}
