<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AddExpertController extends Controller
{

    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
            return view('expert/addexpert');
        
    }


    /**
     * Show the form for creating a new resource.
     */
   
    
}