<?php

namespace App\Services;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Carbon\Carbon;

class OrderService
{
    protected $order_repository;
    protected $product_repository;

    public function __construct(OrderRepository $order_repository, ProductRepository $product_repository)
    {
        $this->order_repository = $order_repository;
        $this->product_repository = $product_repository;
    }

    public function saveOrder($request)
    {
        return $this->order_repository->saveOrder($request);
    }

    public function saveWithCashbackOrder($request)
    {
        $request['paid'] = 'no';

        if ($request->paid == 'yes'){
            $product = $this->product_repository->getProduct();
            foreach ($product as $item) {
                $cashback_permonth = $item->price / 12;
                $request['cashback_per_month'] = $cashback_permonth;
                $request['total_paid'] = $item->price;
            }
        }
        $save_to_db = $this->order_repository->saveOrder($request);

        return $save_to_db;
    }

    public function getOrders($id)
    {
        $MONTH = 30;
        $all_user_orders = $this->order_repository->getUserOrders($id);
        foreach ($all_user_orders as $user_orders){
            $curr_date = Carbon::parse($user_orders->current_date);
            if ($curr_date->addDays(30) <= today()){
                //dd($curr_date->format('Y m d'));
                $user_orders->current_date = $curr_date->format('Y m d');
                if (!$user_orders->current_cashback >= $user_orders->total_paid){
                    $user_orders->current_cashback =+ $user_orders->cashback_per_month;
                    if ($user_orders->current_cashback > $user_orders->total_paid){
                        $user_orders->current_cashback = $user_orders->total_paid;
                    }
                }
                $this->order_repository->cashbackUpdate($user_orders);
                return $user_orders;
            }
            else return $all_user_orders;
        }

    }

}