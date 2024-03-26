<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Services\OrderService;
use App\Http\Requests\OrdersRequest;


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
        $datas = Orders::find($id);
        return view('orders/details', array('data' => $datas));
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
}
