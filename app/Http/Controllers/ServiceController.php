<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceFaq;
use App\Models\ServiceSeo;
use App\Models\ServiceSpecification;
use App\Models\Website;
use App\Models\Media;
use App\Services\ServicesService;
use App\Http\Requests\BasicServiceRequest;
use App\Http\Requests\SeoServiceRequest;
use App\Http\Requests\FaqServiceRequest;
use App\Http\Requests\ServiceSpecificationRequest;
use App\Http\Requests\ServiceRatingRequest;
use App\Http\Requests\ServiceHowWorksRequest;
use App\Http\Requests\ServiceWhyEducrafterRequest;





class ServiceController extends Controller
{

    public function __construct(protected ServicesService $servicesService)
    {
    }

    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->servicesService->getPages('SERVICE'));
        } else {
            return view('services/index');
        }
    }

    public function page()
    {

        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->servicesService->getPages('PAGE'));
        } else {
            return view('services/page');
        }
    }

    public function create($id = null, $type = 'SERVICE')
    {
        $ImageIcon =Media::get();
        $websites   = Website::all();
        $service = ($id) ? Service::find($id) : [];
        if ($service) {
            $type = $service->type;
        }
        return view('services/create', compact('service', 'websites', 'type','ImageIcon'));
    }
    public function storeBasic(BasicServiceRequest $request)
    {

        $service = Service::updateOrCreate(['id' => $request->service_id], [
            'service_name' => $request->service_name,
            'service_description' => $request->service_description,
            'website_type' => $request->website_type,
            'status' => isset($request->status) ? $request->status : 'INACTIVE',
            'short_description' => $request->short_description,
            'type' => $request->content_type,
        ]);

        if ($request->content_type == 'PAGE')
            return redirect('/pages/edit/' . $service->id . '#seo')->with('status', 'Saved Successfully');
        else
            return redirect('/services/edit/' . $service->id . '#seo')->with('status', 'Saved Successfully');
    }

    public function storeSeo(SeoServiceRequest $seoServiceRequest)
    {

        $ogImage = '';
        if ($seoServiceRequest->has("og_image")) {
            $picture = request()->file('og_image');
            $imageName = "og_image" . time() . '.' . $picture->getClientOriginalExtension();
            $picture->move(public_path('images/uploads/services/og_images/'), $imageName);
            $ogImage = env('APP_URL') . '/images/uploads/services/og_images/' . $imageName;
        }
        ServiceSeo::updateOrCreate(['service_id' => $seoServiceRequest->service_id], [
            'service_id' => $seoServiceRequest->service_id,
            'seo_title' => $seoServiceRequest->seo_title,
            'seo_keywords' => $seoServiceRequest->seo_keywords,
            'seo_url_slug' => $seoServiceRequest->seo_url_slug,
            'seo_meta' => $seoServiceRequest->seo_meta,
            'seo_description' => $seoServiceRequest->seo_description,
            'og_image' => $ogImage,
            'button_title' => $seoServiceRequest->button_title,
            'button_url' => $seoServiceRequest->button_url


        ]);
        $service = Service::find($seoServiceRequest->service_id);
        if ($service->type == 'PAGE')
            return redirect('/pages/edit/' . $seoServiceRequest->service_id . '#faq')->with('status', 'Saved Successfully');
        else
            return redirect('/services/edit/' . $seoServiceRequest->service_id . '#faq')->with('status', 'Saved Successfully');
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
        $service = Service::find($faqServiceRequest->service_id);
        if ($service->type == 'PAGE')
            return redirect('/pages/edit/' . $faqServiceRequest->service_id . '#specifications');
        else
            return redirect('/services/edit/' . $faqServiceRequest->service_id . '#specifications');
    }


    public function storeSpecification(ServiceSpecificationRequest $serviceSpecificationRequest)
    {
        $this->servicesService->storeSpecification($serviceSpecificationRequest);
        $service = Service::find($serviceSpecificationRequest->service_id);

        if ($service->type == 'PAGE')
            return redirect('/pages/edit/' . $serviceSpecificationRequest->service_id . '#ratings')->with('status', 'Saved Successfully');
        else
            return redirect('/services/edit/' . $serviceSpecificationRequest->service_id . '#ratings')->with('status', 'Saved Successfully');
    }


    public function storeWhyEducrafter(ServiceWhyEducrafterRequest $serviceWhyEducrafterRequest)
    {
        $this->servicesService->storeWhyEducrafter($serviceWhyEducrafterRequest);
        $service = Service::find($serviceWhyEducrafterRequest->service_id);
        if ($service->type == 'PAGE')
            return redirect('/pages/edit/' . $serviceWhyEducrafterRequest->service_id . '#assist_buttons')->with('status', 'Saved Successfully');
        else
            return redirect('/services/edit/' . $serviceWhyEducrafterRequest->service_id . '#assist_buttons')->with('status', 'Saved Successfully');
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
            return redirect()->back()->with('status', 'Deleted Successfully');
            //return redirect('/services')->with('status', 'Service Deleted Successfully');
        } else {
            return redirect();
        }
    }

    public function storeRatings(ServiceRatingRequest $serviceRatingRequest)
    {
        $this->servicesService->storeRatings($serviceRatingRequest);
        $service = Service::find($serviceRatingRequest->service_id);
        if ($service->type == 'PAGE')
            return redirect('/pages/edit/' . $serviceRatingRequest->service_id . '#how_works')->with('status', 'Saved Successfully');
        else
            return redirect('/services/edit/' . $serviceRatingRequest->service_id . '#how_works')->with('status', 'Saved Successfully');
    }

    public function storeHowWorks(ServiceHowWorksRequest $serviceHowWorksRequest)
    {
        $this->servicesService->storeHowWorks($serviceHowWorksRequest);
        $service = Service::find($serviceHowWorksRequest->service_id);
        if ($service->type == 'PAGE')
            return redirect('/pages/edit/' . $serviceHowWorksRequest->service_id . '#why_educrafter')->with('status', 'Saved Successfully');
        else
            return redirect('/services/create/' . $serviceHowWorksRequest->service_id . '#why_educrafter')->with('status', 'Saved Successfully');
    }

    public function storeAssistBtn(\App\Http\Requests\ServiceAssistButtonRequest $serviceAssistButtonRequest)
    {
        $this->servicesService->storeAssistBtn($serviceAssistButtonRequest);
        $service = Service::find($serviceAssistButtonRequest->service_id);
        if ($service->type == 'PAGE')
            return redirect('/pages')->with('status', 'Saved Successfully');
        else
            return redirect('/services')->with('status', 'Saved Successfully');
    }
}