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

    public function index(Request $request)
    {

        $website = '';
        $paymentStatus = '';
        if ($request->has('payment_status')) {
            $paymentStatus = $request->input('payment_status');
        }
        if ($request->has('website')) {
            $website = $request->input('website');
        }


        $query = Payment::orderBy('id','desc');
        if($paymentStatus){
            $query->where('payment_status', $paymentStatus);
        }
        if($website){
            $query->whereHas('order', function($q) use ($website){
                $q->where('website_id', $website);
            });
        }


        /*if($paymentStatus){
            $payments = Payment::where('payment_status', $paymentStatus)->orderBy('id','desc')->paginate(15);
        }else{
            $payments = Payment::orderBy('id','desc')->paginate(15);
        }*/
        $status = '';
        $payments = $query->paginate(15);
        return view('payment/view',compact('payments','paymentStatus','website'));
        
    }

    


}
