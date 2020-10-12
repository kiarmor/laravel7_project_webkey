<?php

namespace App\Repositories;
use App\Models\Order;

class OrderRepository
{
    public function saveOrder($request)
    {
        //TODO: save to DB
        $order = new Order;
        $order->user_name = $request->user_name;
        $order->phone_number = $request->phone_number;
        $order->email = $request->email ?? null;
        $order->address = $request->address;
        $order->save();

        return $order;
    }
}