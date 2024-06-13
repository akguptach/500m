<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;


use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;


class StudentMarketController extends Controller
{
    public function __construct()
    {
        
    }

    public function deals_category()
    {
            return view('studentmarket/category');
        
    }
    public function add_deals()
    {
            return view('studentmarket/add');
        
    }
    public function view_deals()
    {
            return view('studentmarket/view');
        
    }
    

    


}
