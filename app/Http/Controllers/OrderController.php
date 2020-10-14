<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Http\Requests\SaveOrderRequest;

class OrderController extends Controller
{
    protected $order_service;

    public function __construct(OrderService $order_service)
    {
        $this->order_service = $order_service;
    }

    public function saveOrder(SaveOrderRequest $request)
    {
       $save_to_db = $this->order_service->saveOrder($request);

        if ($save_to_db){
            return redirect('/')
                ->with(['success' => 'Successfully saved']);
        }
        else {
            return redirect()
                ->back()
                ->withErrors(['msg' => 'Error'])
                ->withInput();
        }
    }

    public function buyWithCashback(SaveOrderRequest $request)
    {
        $save_with_cashback = $this->order_service->saveWithCashbackOrder($request);
        if ($save_with_cashback){

            return redirect('/');
        }

         return redirect()->back();
    }
}
