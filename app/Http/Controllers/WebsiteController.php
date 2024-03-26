<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Website;
use App\Models\CountriesModel;
use App\Services\WebsiteService;
use App\Http\Requests\CreateWebsiteRequest;
use App\Http\Requests\UpdateWebsiteRequest;


class WebsiteController extends Controller
{

    public function __construct(protected WebsiteService $websiteService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->websiteService->getWebsites());
        } else {
            return view('website/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['currencies'] = CountriesModel::all();
        return view('website/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateWebsiteRequest $request)
    {
        $this->websiteService->saveWebsite($request);
        return redirect('/website')->with('status', 'Website Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $datas = Website::find($id);
        $currencies = CountriesModel::all();
        return view('website/edit', array('formAction' => route('website.update', ['website' => $id]), 'data' => $datas, 'currencies' => $currencies));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWebsiteRequest $request, string $id)
    {
        $this->websiteService->saveWebsite($request, $id);
        return redirect('/website')->with('status', 'Website Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $website = Website::find($id);
        if (!empty($website)) {
            $website->delete();
            return redirect('/website')->with('status', 'Website Deleted Successfully');
        } else {
            return redirect('/website');
        }
    }
}
