<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;


class PageController extends Controller
{
    protected $product_service;
    protected $order_service;

    public function __construct(ProductService $product_service, OrderService $order_service)
    {
        $this->product_service = $product_service;
        $this->order_service = $order_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = $this->product_service->getProduct();

            if ($product) {
                return view('my_welcome', compact('product'));
            }
            return view('layouts.error'); //TODO: изменть на 404 или ошибку подключения



    }

    public function buyPage()
    {
        $product = $this->product_service->getProduct();

        if ($product) {
            return view ('buy', compact('product'));
        }
        return view('layouts.error'); //TODO: изменть на 404 или ошибку подключения
    }

    public function buyWithCashback()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('buy_with_cashback', compact('user'));
        }
        return redirect('/register'); //TODO: добавить сообщение "Сначала зарегаться"
    }

    public function user_account()
    {
        $user = Auth::user();
        $user_orders = $this->order_service->getOrders($user->id);
        if ($user_orders) {
            return view('user_account', compact('user', 'user_orders'));
        }
        return view('layouts.error');
    }

    public function dashboard()
    {
       /* $user = Auth::user();
        $user_info = $this->order_service->getOrders($user->id);*/
        return view('dashboard');

    }

    public function show($id)
    {
        $user_order = $this->order_service->getUserOrder($id);

        if ($user_order){
            return view('pages.edit_order', compact('user_order'));
        }

        return redirect()->back();
    }
}
