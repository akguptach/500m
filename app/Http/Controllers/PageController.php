<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\Website;
use App\Models\Pages;
use App\Models\PageFaq;
use App\Models\PageRating;
use App\Http\Requests\PageRequest;
use App\Services\PageService;
use App\Http\Requests\FaqPageRequest;
use App\Http\Requests\PageRatingRequest;
use Illuminate\Http\Request;
use App\Models\ContactUs;
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

    public function dataStore($type)
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return $this->pageService->contactUsEnquiry($type);
        } else {
            return view('style/form',compact('type'));
        }
    }

    public function customerAttendant($id){
        try{
        $contactUs = ContactUs::find($id);
        $contactUs->customer_attendant=1;
        $contactUs->save();
        return redirect(route('contact.form.store','pending'))->with('success', 'Customer Attendanted successfully');
        }catch(\Exception $e){
            return redirect(route('contact.form.store','pending'))->with('error', 'There is an error');
        }
    }


public function EnqueryExport(Request $request, $type)
{

    $from = $request->from;
    $to = $request->to;
    

    $headers = array(
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$type Enquery Form List.csv",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    );

    $customerAttendant = 0;
    if($type == 'completed'){
        $customerAttendant = 1;
    }
    $query = ContactUs::where('customer_attendant',$customerAttendant);
    if($from && $to)
        $query->whereBetween('created_at', [$from, $to]);
    elseif($from)
        $query->whereDate('created_at', '>=', $from);
    elseif($to)
        $query->whereDate('created_at', '<=', $to);
    
    
    $enquery = $query->get();
    $columns = array('Name', 'Email', 'Mobile Number', 'Service', 'Date');
    $callback = function() use ($enquery, $columns)
    {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);
        foreach($enquery as $row) {
            $mobileNumber = (string) '+'.$row->mobile_number;
            fputcsv($file, array($row->name, $row->email, $mobileNumber, $row->service, $row->created_at));
        }
        fclose($file);
    };
    return Response::stream($callback, 200, $headers);
}
}