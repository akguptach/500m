<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use Illuminate\Http\Request;
use Exception;

class DealsController extends Controller
{

    /**
     * Display a listing of the deals.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $deals = Deal::paginate(25);

        return view('deals.index', compact('deals'));
    }

    /**
     * Show the form for creating a new deal.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('deals.create');
    }

    /**
     * Store a new deal in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $data = $this->getData($request);
        
        Deal::create($data);

        return redirect()->route('deals.deal.index')
            ->with('success_message', 'Deal was successfully added.');
    }

    /**
     * Display the specified deal.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $deal = Deal::findOrFail($id);

        return view('deals.show', compact('deal'));
    }

    /**
     * Show the form for editing the specified deal.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $deal = Deal::findOrFail($id);
        

        return view('deals.edit', compact('deal'));
    }

    /**
     * Update the specified deal in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $data = $this->getData($request);
        
        $deal = Deal::findOrFail($id);
        $deal->update($data);

        return redirect()->route('deals.deal.index')
            ->with('success_message', 'Deal was successfully updated.');  
    }

    /**
     * Remove the specified deal from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $deal = Deal::findOrFail($id);
            $deal->delete();

            return redirect()->route('deals.deal.index')
                ->with('success_message', 'Deal was successfully deleted.');
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
                'title' => 'string|min:1|max:255|nullable',
            'image' => 'image|numeric|nullable',
            'short_description' => 'string|min:1|nullable',
            'long_description' => 'string|min:1|nullable',
            'url' => 'string|min:1|nullable',
            'price' => 'string|min:1|nullable',
            'other_price' => 'string|min:1|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
