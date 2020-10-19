<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Http\Requests\SaveOrderRequest;

class OrderController extends Controller
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

    /**
     * @param SaveOrderRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveOrder(SaveOrderRequest $request)
    {
       $save_to_db = $this->order_service->saveOrder($request, $cashback = false);

        if ($save_to_db){
            return redirect('/')
                ->with(['success' => 'Ваш заказ принят. Мы скоро свяжемся с Вамми.']);
        }
        else {
            return redirect()
                ->back()
                ->withErrors(['msg' => 'Error'])
                ->withInput();
        }
    }

    /**
     * @param SaveOrderRequest $request
     * @param bool $cashback
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function buyWithCashback(SaveOrderRequest $request, $cashback = true)
    {
        $save_with_cashback = $this->order_service->saveWithCashbackOrder($request, $cashback);
        if ($save_with_cashback){

            return redirect('/')
                ->with(['success' => 'Ваш заказ принят. Менеджер свяжется с Вами.']);
        }

         return back()->withErrors(['msg' => 'Ой, что то пошло не так. Повторите попытку']);
    }

    /**
     * @param SaveOrderRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(SaveOrderRequest $request, $id)
    {
       $edit_order = $this->order_service->updateOrder($request, $id);

        if ($edit_order){
            return redirect('/')
                ->with(['success' => 'Изменения сохранены']);
        }

            return redirect()
                ->back()
                ->withErrors(['msg' => 'Error'])
                ->withInput();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveCashbackPayback(Request $request, $id)
    {
        $save_cashback_payback = $this->order_service->saveCashbackPayback($request, $id);

        if ($save_cashback_payback){
            return redirect('/')
                ->with(['success' => 'Ваш запрос принят в обработку.']);
        }
        return redirect()
            ->back()
            ->withErrors(['msg' => 'Error'])
            ->withInput();
    }
}
