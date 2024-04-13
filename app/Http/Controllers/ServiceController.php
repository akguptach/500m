<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\ServiceFaq;
use App\Models\ServiceSeo;
use App\Services\ServicesService;
use App\Http\Requests\BasicServiceRequest;
use App\Http\Requests\SeoServiceRequest;
use App\Http\Requests\FaqServiceRequest;

class ServiceController extends Controller
{

    public function __construct(protected ServicesService $servicesService)
    {
    }

    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->servicesService->getPages());
        } else {
            return view('services/index');
        }
    }

    public function create($id = null)
    {
        $service = ($id) ? Service::find($id) : [];
        return view('services/create', compact('service'));
    }

    public function storeBasic(BasicServiceRequest $request)
    {

        $service = Service::updateOrCreate(['id' => $request->service_id], [
            'service_name' => $request->service_name,
            'service_description' => $request->service_description,
        ]);
        return redirect('/services/create/' . $service->id . '#seo')->with('status', 'Saved Successfully');
    }

    public function storeSeo(SeoServiceRequest $seoServiceRequest)
    {

        ServiceSeo::updateOrCreate(['service_id' => $seoServiceRequest->service_id], [
            'service_id' => $seoServiceRequest->service_id,
            'seo_title' => $seoServiceRequest->seo_title,
            'seo_keywords' => $seoServiceRequest->seo_keywords,
            'seo_url_slug' => $seoServiceRequest->seo_url_slug,
            'seo_meta' => $seoServiceRequest->seo_meta,
            'seo_description' => $seoServiceRequest->seo_description,
        ]);
        return redirect('/services/create/' . $seoServiceRequest->service_id . '#faq')->with('status', 'Saved Successfully');
    }

    public function storeFaq(FaqServiceRequest $faqServiceRequest)
    {
        $data = $faqServiceRequest->all();
        $oldValues = ServiceFaq::where('service_id', $faqServiceRequest->service_id)->get();
        foreach ($data['addMoreInputFields'] as $fields) {
            ServiceFaq::Create([
                'service_id' => $faqServiceRequest->service_id,
                'question' => $fields['question'],
                'answer' => $fields['answer'],
            ]);
        }
        foreach ($oldValues as $obj) {
            $obj->delete();
        }
        return redirect('/services')->with('status', 'Saved Successfully');
    }

    public function destroy(string $id)
    {

        $service = Service::find($id);
        if (!empty($service)) {
            $service->delete();
            $serviceSeo = ServiceSeo::where('service_id', $id);
            $serviceSeo->delete();
            $serviceFaq = ServiceFaq::where('service_id', $id)->get();
            foreach ($serviceFaq as $obj) {
                $obj->delete();
            }

            return redirect('/services')->with('status', 'Service Deleted Successfully');
        } else {
            return redirect('/services');
        }
    }
}
