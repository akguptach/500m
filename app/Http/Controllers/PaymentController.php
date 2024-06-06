<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;


use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

use App\Models\Payment;


class PaymentController extends Controller
{
    public function __construct()
    {
        
    }

    public function index($status='')
    {
        if($status){
            $payments = Payment::where('payment_status', $status)->orderBy('id','desc')->paginate(15);
        }else{
            $payments = Payment::orderBy('id','desc')->paginate(15);
        }
        return view('payment/view',compact('payments','status'));
        
    }

    


}
