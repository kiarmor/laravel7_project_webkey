<?php

namespace App\Repositories;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{
    public function saveOrder($request)
    {
        $order = new Order;
        $order->user_name = $request->user_name;
        $order->phone_number = $request->phone_number;
        if (Auth::check()) {
            $user = Auth::user();
            $order->email  = $user->email;
        }
        else $order->email = $request->email ?? null;
        $order->address = $request->address;
        $order->save();

        return $order;
    }
}