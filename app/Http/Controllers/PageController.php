<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;


class PageController extends Controller
{
    protected $product_service;
    protected $order_service;

    /**
     * PageController constructor.
     * @param ProductService $product_service
     * @param OrderService $order_service
     */
    public function __construct(ProductService $product_service, OrderService $order_service)
    {
        $this->product_service = $product_service;
        $this->order_service = $order_service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $product = $this->product_service->getProduct();
            if ($product) {
                return view('my_welcome', compact('product'));
            }
            return view('my_welcome');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function buyPage()
    {
        $product = $this->product_service->getProduct();
        if ($product) {
            return view ('buy', compact('product'));
        }
        return view('buy'); //TODO: изменть на 404 или ошибку подключения
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function buyWithCashback()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('buy_with_cashback', compact('user'));
        }
        return redirect('/register'); //TODO: добавить сообщение "Сначала зарегаться"
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function user_account()
    {
        $user = Auth::user();
        $user_orders = $this->order_service->getOrders($user->id);
        if ($user_orders) {
            return view('user_account', compact('user', 'user_orders'));
        }elseif ($user_orders === null){
            return view('user_account', compact('user'));
        }
        return view('layouts.error');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function dashboard()
    {
       /* $user = Auth::user();
        $user_info = $this->order_service->getOrders($user->id);*/
        return view('dashboard');

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $user_order = $this->order_service->getUserOrder($id);

        if ($user_order){
            return view('pages.edit_order', compact('user_order'));
        }

        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function cashback_payback($id)
    {
        $order = $this->order_service->getUserOrder($id);
        return view('pages.cashback_payback', compact('order'));
    }


    public function adminDashboard()
    {
        return view('admin.admin');
    }
}
