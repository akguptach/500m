<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Website;
use App\Models\Pages;
use App\Models\PageFaq;
use App\Models\PageRating;
use App\Http\Requests\PageRequest;
use App\Services\PageService;
use App\Http\Requests\FaqPageRequest;
use App\Http\Requests\PageRatingRequest;

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
        $page = $this->pageService->savePage($request);
        return redirect("/pages/$page->id/edit/#faq")->with('status', 'Page Created Successfully');
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
            return redirect("/pages/$id/edit/#faq")->with('status', 'Page Updated Successfully');
        } catch (\Exception $e) {
            echo $e;
            die;
        }
    }


    public function storeFaq(FaqPageRequest $faqPageRequest)
    {
        $data = $faqPageRequest->all();
        $oldValues = PageFaq::where('page_id', $faqPageRequest->page_id)->get();
        foreach ($data['addMoreInputFields'] as $fields) {
            PageFaq::Create([
                'page_id' => $faqPageRequest->page_id,
                'question' => $fields['question'],
                'answer' => $fields['answer'],
            ]);
        }
        foreach ($oldValues as $obj) {
            $obj->delete();
        }
        return redirect("/pages/$faqPageRequest->page_id/edit/#ratings")->with('status', 'Page Updated Successfully');
    }

    public function storeRatings(PageRatingRequest $pageRatingRequest)
    {
        $this->pageService->storeRatings($pageRatingRequest);
        return redirect("/pages/")->with('status', 'Page Updated Successfully');
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
    public function dataStore()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->pageService->getReferencingStyle1());
        } else {
            return view('style/form');
        }
    }
}
