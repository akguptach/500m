<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;


use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

use App\Models\Payment;
use DataTables;

class PaymentController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        if (isset($_GET) && (!empty($_GET['columns']) || !empty($_GET['search']['value']))) {
            $query = Payment::orderBy('id', 'desc');
            $query->where(function($q){
                if($_GET['search']['value']){
                    $q->orWhereHas('order.student',function($sq){
                        $sq->where('first_name', 'LIKE', '%' . $_GET['search']['value'] . '%');
                        $sq->orWhere('email', 'LIKE', '%' . $_GET['search']['value'] . '%');
                        $sq->orWhere('phone_number', 'LIKE', '%' . $_GET['search']['value'] . '%');
                    });
                    $q->orWhere('transaction_id', 'LIKE', '%' . $_GET['search']['value'] . '%');
                }
            });
            if($_GET['columns'][4]['search']['value']){
                $query->whereHas('order.website', function($q){
                    $q->where('website_type',$_GET['columns'][4]['search']['value']);
                });
            }
            if($_GET['columns'][6]['search']['value']){
                $query->where('payment_status',$_GET['columns'][6]['search']['value']);
            }
            $datatable =  DataTables::eloquent($query);
            $datatable->addColumn('task_id', function($row) {
                return $row->order?->order_number;
            });
            $datatable->addColumn('first_name', function($row) {
                return $row->order?->student?->first_name;
            });
            $datatable->addColumn('email', function($row) {
                return $row->order?->student?->email;
            });
            $datatable->addColumn('phone_number', function($row) {
                return $row->order?->student?->phone_number;
            });
            $datatable->addColumn('website_type', function($row) {
                return $row->order?->website?->website_type;
            });

            /*$datatable->filterColumn('website_type', function($query, $keyword) {
                $query->whereHas('order.website', function($q){
                    $q->where('website_type',$_GET['columns'][4]['search']['value']);
                });
            });*/
            
            
            return $datatable->make(true);
        }
        else{
            return view('payment/view');
        }
        /*
        $website = '';
        $paymentStatus = '';
        if ($request->has('payment_status')) {
            $paymentStatus = $request->input('payment_status');
        }
        if ($request->has('website')) {
            $website = $request->input('website');
        }


        $query = Payment::whereHas('order.student')->orderBy('id','desc');
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
       // $status = '';
        //$payments = $query->paginate(15);
        //return view('payment/view',compact('payments','paymentStatus','website'));*/
        
    }

    


}