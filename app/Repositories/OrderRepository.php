<?php

namespace App\Repositories;
use App\Models\Order;
use App\Models\Cashback_orders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    public function saveOrder($request)
    {
        $order = new Order;
        $order->user_name = $request->user_name;
        $order->phone_number = $request->phone_number;
        if (Auth::user()){
            $user = Auth::user();
            $order->email  = $user->email;
            $order->user_id = $user->id;
        }
        else $order->email = $request->email ?? null;
        $order->address = $request->address;
        $order->save();

        if (Auth::user()){
            $this->saveWithCashbackOrder($request, $order);
        }

        return $order;
    }

    public function saveWithCashbackOrder($request, $order)
    {
        $cashback_order = new Cashback_orders();
        $cashback_order->order_id = $order->id;
        $cashback_order->paid = $request->paid ?: 'no';
        $cashback_order->current_cashback = $request->current_cashback ?: 0;
        $cashback_order->cashback_per_month = $request->cashback_per_month ?: 0;
        $cashback_order->total_paid = $request->total_paid ?: 0;
        $cashback_order->save();

        return $cashback_order;
    }

    public function getUserOrders($id)
    {
        $user_orders = DB::table('orders')
            ->join('cashback_orders', 'cashback_orders.order_id', '=', 'orders.id')
            ->where('orders.user_id', '=', $id)
            ->get();

        return $user_orders;
    }

    public function cashbackUpdate($cashback_orders)
    {
        return true;

    }
}