<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Requests\OrdersRequest;
use App\Http\Requests\OrderMessageRequest;
use App\Http\Requests\OrderRequestMessageRequest;
use App\Http\Requests\FinalBudgetRequest;


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
        return view('orders/details', $this->orderService->orderDetails($id));
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

    public function sendRequestMessage(OrderRequestMessageRequest $request)
    {

        try {
            $result = $this->orderService->sendRequestMessage($request);
            return redirect()->back()->with($result['status'], $result['message']);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'error');
            echo $e;
            die;
        }
    }

    public function submitFinalBudget(FinalBudgetRequest $request, $id)
    {
        $result = $this->orderService->submitFinalBudget($request);
        return redirect()->back()->with($result['status'], $result['message']);
    }

    public function tutorRequestSent($id)
    {
        return view('orders/tutor_request_sent', $this->orderService->getTutorRequestSent($id));
    }

    public function qcRequestSent($id)
    {
        return view('orders/qc_request_sent', $this->orderService->getQcRequestSent($id));
    }

    public function deliverToStudent(string $id)
    {
        $result = $this->orderService->deliverToStudent($id);
        return redirect()->back()->with($result['status'], $result['message']);
    }
}
