<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\StudentOrderMessage;
use App\Models\TeacherOrderMessage;
use App\Models\QcOrderMessage;
use App\Models\OrderAssign;
use App\Models\QcAssign;
use App\Services\OrderService;
use App\Http\Requests\OrdersRequest;
use App\Http\Requests\OrderMessageRequest;



class OrdersController extends Controller
{


    public function __construct(protected OrderService $orderService)
    {
    }

    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->orderService->getOrders());
        } else {
            return view('orders/view');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function view(string $id)
    {
        $data = Orders::with(['website', 'student', 'subject', 'teacherAssigned.teacher', 'teacherAssigned.student', 'qcAssigned.qc'])->where('id', $id)->first();
        $orderAssign = OrderAssign::where('order_id', $id)->count();
        $qcAssign = QcAssign::where('order_id', $id)->count();
        $studentMessages = StudentOrderMessage::with(['sendertable', 'receivertable'])->where('order_id', $id)->get();
        $teacherOrderMessage = TeacherOrderMessage::with(['sendertable', 'receivertable'])->where('order_id', $id)->get();
        $qcOrderMessage = QcOrderMessage::with(['sendertable', 'receivertable'])->where('order_id', $id)->get();
        //dd($data);
        return view('orders/details', compact('data', 'studentMessages', 'teacherOrderMessage', 'qcOrderMessage', 'orderAssign', 'qcAssign'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrdersRequest $request, string $id)
    {
        $this->orderService->saveOrder($request, $id);
        return redirect('/Orders')->with('status', 'Price Updated Successfully');
    }





    /**

     * Store a newly created resource in storage.

     */

    public function store(OrdersRequest $request)
    {
        $this->orderService->saveOrder($request);
        return redirect('/Orders')->with('status', 'Orders Created Successfully');
    }

    public function sendMessage(OrderMessageRequest $request)
    {
        try {
            $result = $this->orderService->saveOrderMessages($request);
            return redirect()->back()->with($result['status'], $result['message']);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'error');
            echo $e;
            die;
        }
    }
}
