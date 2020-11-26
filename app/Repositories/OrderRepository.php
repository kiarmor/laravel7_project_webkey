<?php

namespace App\Repositories;
use App\Models\Order;
use App\Models\Cashback_orders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAllOrders()
    {
        return DB::table('orders')->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getCashbackOrders()
    {
        $cashback_orders = DB::table('orders')
            ->join('cashback_orders', 'cashback_orders.order_id', '=', 'orders.id')
            ->get();

        return $cashback_orders;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getOrdersWithoutCashback()
    {
        $orders_without_cashback = DB::table('orders')
            ->where('cashback', '=', 0)
            ->get();

        return $orders_without_cashback;
    }
    /**
     * @param $request
     * @param $cashback
     * @return Order
     */
    public function saveOrder($request, $cashback)
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

        if ($cashback === true){
            $this->saveWithCashbackOrder($request, $order);
        }

        return $order;
    }

    /**
     * @param $request
     * @param $order
     * @return Cashback_orders
     */
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

    /**
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public function getUserOrders($id)
    {
        $user_orders = DB::table('orders')
            ->join('cashback_orders', 'cashback_orders.order_id', '=', 'orders.id')
            ->where('orders.user_id', '=', $id)
            ->get();

        return $user_orders;
    }

    /**
     * @param $cashback_orders
     * @return int
     */
    /*public function cashbackUpdate($cashback_orders)
    {
        $db = DB::table('cashback_orders')
            ->where('order_id', $cashback_orders->order_id)
            ->update([
                //'current_date' => $cashback_orders->current_date,
                'current_cashback' => $cashback_orders->current_cashback,
            ]);

        return $db;
    }*/

    /**
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public function getUserOrder($id)
    {
        $user_order = DB::table('orders')
            ->where('id', '=', $id)
            ->get();

        return $user_order;
    }

    /**
     * @param $request
     * @param $id
     * @return int
     */
    public function updateOrder($request, $id)
    {
        return DB::table('orders')
            ->where('id', '=', $id)
            ->update([
                'user_name' => $request->user_name,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);
    }

    /**
     * @param $request
     * @param $id
     * @return int
     */
    public function saveCashbackPayback($request, $id)
    {
        $update_card_number = DB::table('cashback_orders')
            ->where('order_id', '=', $id)
            ->update([
                'card_number' => $request->card_number,
                'user_get_cashback' => 'yes',
            ]);

        return $update_card_number;
    }
}
