<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SaveOrderRequest;
use OrderService;

class OrderController extends Controller
{
    protected $order_service;

    public function __construct(OrderService $order_service)
    {
        $this->service = $order_service;
    }

    public function saveOrder(SaveOrderRequest $request)
    {
       $save_to_db = $this->service->saveOrder($request);

        if ($save_to_db){
            return redirect()
                ->back()
                ->with(['success' => 'Successfully saved']);
        }
        else {
            return redirect()
                ->back()
                ->withErrors(['msg' => 'Error'])
                ->withInput();
        }
    }

}
