<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $order_service;

    /**
     * OrderController constructor.
     * @param OrderService $order_service
     */
    public function __construct(OrderService $order_service)
    {
        $this->order_service = $order_service;
    }

    public function getAllOrders()
    {
       $orders = $this->order_service->getAllOrders();
       return view('admin.orders.all_orders', compact('orders'));
    }

    public function getCashbackOrders()
    {
        $cashback_orders = $this->order_service->getCashbackOrders();
        return view('admin.orders.cashback_orders', [
            'orders' => $cashback_orders,
        ]);
    }

    public function getOrdersWithoutCashback()
    {
        $orders_without_cashback = $this->order_service->getOrdersWithoutCashback();
        return view('admin.orders.orders_without_cashback', [
            'orders' => $orders_without_cashback,
        ]);
    }

    public function changePaybackStatus(Request $request)
    {
        //dd($request);
    }


}
