<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;


use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;


class AffiliateUserController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
            return view('affiliateuser/add');
        
    }
    public function view()
    {
            return view('affiliateuser/view');
        
    }

    


}
