<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Models\Subject;
use App\Http\Requests\CouponRequest;
//use App\Services\SubjectService;


class CouponController extends Controller
{

    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
            return view('coupon/view');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coupon/create');
    }

    
}
