<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Website;
use App\Models\Pages;
use App\Http\Requests\PageRequest;
use App\Services\PageService;

class PageController extends Controller
{

    public function __construct(protected PageService $pageService)
    {
    }

    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->pageService->getPages());
        } else {
            return view('pages/view');
        }
    }
    /**     * Show the form for creating a new resource.     */
    public function create()
    {
        $data['websites']   = Website::all();
        return view('pages/create', $data);
    }




    /**     * Store a newly created resource in storage.     */
    public function store(PageRequest $request)
    {
        $this->pageService->savePage($request);
        return redirect('/pages')->with('status', 'Page Created Successfully');
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data = Pages::find($id);
        $websites   = Website::all();
        return view('pages/edit', array('formAction' => route('pages.update', ['pages' => $id]), 'data' => $data, 'websites' => $websites));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, string $id)
    {
        try {
            $this->pageService->savePage($request, $id);
            return redirect('/pages')->with('status', 'Page Updated Successfully');
        } catch (\Exception $e) {
            echo $e;
            die;
        }
    }

    /**

     * Remove the specified resource from storage.

     */

    public function destroy(string $id)
    {

        $page = Pages::find($id);
        if (!empty($page)) {
            $page->delete();
            return redirect('/pages')->with('status', 'Page Deleted Successfully');
        } else {
            return redirect('/pages');
        }
    }

    public function showPage(string $seo_url_slug)
    {
        $page = Pages::where('seo_url_slug', $seo_url_slug)->first();
        return view('pages/show_page', compact('page'));
    }
}
