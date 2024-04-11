<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\ServiceFaq;
use App\Models\ServiceSeo;
use App\Services\ServicesService;

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
}
