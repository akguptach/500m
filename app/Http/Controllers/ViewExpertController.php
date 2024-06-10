<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ViewExpertController extends Controller
{

    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
            return view('expert/viewexpert');
        
    }

    
}