<?php

namespace App\Services;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Carbon\Carbon;
use Illuminate\Suppotr\Collection;

class OrderService
{
    protected $order_repository;
    protected $product_repository;

    /**
     * OrderService constructor.
     * @param OrderRepository $order_repository
     * @param ProductRepository $product_repository
     */
    public function __construct(OrderRepository $order_repository, ProductRepository $product_repository)
    {
        $this->order_repository = $order_repository;
        $this->product_repository = $product_repository;
    }

    /**
     * @param $request
     * @param $cashback
     * @return \App\Models\Order
     */
    public function saveOrder($request, $cashback)
    {
        return $this->order_repository->saveOrder($request, $cashback);
    }

    /**
     * @param $request
     * @param $cashback
     * @return \App\Models\Order
     */
    public function saveWithCashbackOrder($request, $cashback)
    {
        $request['paid'] = 'yes';

        if ($request->paid == 'yes'){
            $product = $this->product_repository->getProduct();
            foreach ($product as $item) {
                $cashback_permonth = $item->price / 12;
                $request['cashback_per_month'] = $cashback_permonth;
                $request['total_paid'] = $item->price;
            }
        }
        $save_to_db = $this->order_repository->saveOrder($request, $cashback);

        return $save_to_db;
    }

    /**
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    /*public function getOrders($id)
    {
        $MONTH = 30;
        $all_user_orders = $this->order_repository->getUserOrders($id);
        foreach ($all_user_orders as $user_orders){
            $curr_date = Carbon::parse($user_orders->current_date);
            $day_of_buy = $curr_date->dayOfYear;
            $today = Carbon::today()->dayOfYear();
            $res = $today - $day_of_buy;
            //$counter = round( $res / $MONTH, 0);
            $counter = intdiv($res, $MONTH);
            if ($curr_date->addDays($MONTH) <= today()){
                $user_orders->current_date = $curr_date->format('Y-m-d');
                if (!$user_orders->current_cashback >= $user_orders->total_paid){
                    $user_orders->current_cashback =+ $user_orders->cashback_per_month;
                }
                else {
                    $user_orders->current_cashback = $user_orders->total_paid;
                }
                $this->order_repository->cashbackUpdate($user_orders);

                return $this->order_repository->getUserOrders($id);
            }
            else return $all_user_orders;
        }
    }*/
    public function getOrders($id)
    {
        $all_user_orders = $this->order_repository->getUserOrders($id);
        foreach ($all_user_orders as $user_orders){
            $counter = $this->findCounter($user_orders);
                if (!$user_orders->current_cashback >= $user_orders->total_paid){
                    $user_orders->current_cashback = $user_orders->cashback_per_month * $counter;
                }
                else {
                    $user_orders->current_cashback = $user_orders->total_paid;
                }
        }
       return $all_user_orders;
    }
    public function findCounter($user_orders)
    {
        $MONTH = 30;
        $curr_date = Carbon::parse($user_orders->day_of_buy);
        $day_of_buy = $curr_date->dayOfYear;
        $today = Carbon::today()->dayOfYear();
        if ($curr_date->year < today()->year){
            $days_of_last_year= 365 - $day_of_buy;
           $res = $days_of_last_year + $today;

        }else $res = $today - $day_of_buy;

        $counter = intdiv($res, $MONTH);
        if ($counter > 12) {
            return 12;
        }
        return $counter;
    }

    /**
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public function getUserOrder($id)
    {
        return $this->order_repository->getUserOrder($id);
    }

    /**
     * @param $request
     * @param $id
     * @return int
     */
    public function updateOrder($request, $id)
    {
        return $this->order_repository->updateOrder($request, $id);
    }

    /**
     * @param $request
     * @param $id
     * @return int
     */
    public function saveCashbackPayback($request, $id)
    {
        return $this->order_repository->saveCashbackPayback($request, $id);
    }

}
