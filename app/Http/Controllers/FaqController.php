<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Faq;
use App\Models\Website;
use App\Http\Requests\FaqRequest;
use App\Services\FaqService;

class FaqController extends Controller
{

    public function __construct(protected FaqService $faqService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->faqService->getFaqs());
        } else {
            return view('faq/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['faqs'] = Faq::all();
        $data['websites']   = Website::all();
        return view('faq/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqRequest $request)
    {
        $this->faqService->saveFaq($request);
        return redirect('/faq')->with('status', 'FAQ Created Successfully');
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
        $datas = Faq::find($id);
        $websites   = Website::all();
        return view('faq/edit', array('formAction' => route('faq.update', ['faq' => $id]), 'data' => $datas, 'websites' => $websites));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqRequest $request, string $id)
    {
        $this->faqService->saveFaq($request, $id);
        return redirect('/faq')->with('status', 'FAQ Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = Faq::find($id);
        if (!empty($faq)) {
            $faq->delete();
            return redirect('/faq')->with('status', 'FAQ Deleted Successfully');
        } else {
            return redirect('/faq');
        }
    }
}
