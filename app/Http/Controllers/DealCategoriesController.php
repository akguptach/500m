<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DealCategory;
use Illuminate\Http\Request;
use Exception;

class DealCategoriesController extends Controller
{

    /**
     * Display a listing of the deal categories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $dealCategories = DealCategory::paginate(25);

        return view('deal_categories.index', compact('dealCategories'));
    }

    /**
     * Show the form for creating a new deal category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('deal_categories.create');
    }

    /**
     * Store a new deal category in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $data = $this->getData($request);
        
        DealCategory::create($data);

        return redirect()->route('deal_categories.deal_category.index')
            ->with('success_message', 'Deal Category was successfully added.');
    }

    /**
     * Display the specified deal category.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $dealCategory = DealCategory::findOrFail($id);

        return view('deal_categories.show', compact('dealCategory'));
    }

    /**
     * Show the form for editing the specified deal category.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $dealCategory = DealCategory::findOrFail($id);
        

        return view('deal_categories.edit', compact('dealCategory'));
    }

    /**
     * Update the specified deal category in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $data = $this->getData($request);
        
        $dealCategory = DealCategory::findOrFail($id);
        $dealCategory->update($data);

        return redirect()->route('deal_categories.deal_category.index')
            ->with('success_message', 'Deal Category was successfully updated.');  
    }

    /**
     * Remove the specified deal category from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $dealCategory = DealCategory::findOrFail($id);
            $dealCategory->delete();

            return redirect()->route('deal_categories.deal_category.index')
                ->with('success_message', 'Deal Category was successfully deleted.');
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
                'category_name' => 'string|min:1|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
