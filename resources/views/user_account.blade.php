@extends('layouts.layout')

@section('title', 'Profile')
<div class="header"> </div>
@section('content')


    <h3>Welcome {{$user->name}}</h3>
    <div class="table-responsive">

        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Вы сщвершили покупку</th>
                <th>Ваш ежемесячный кешбек</th>
                <th>Ваш текущий кешбэк</th>
                <th>Кешбэк в следующем месяце составит</th>
                <th>Сумма покупки</th>
                <th>Забрать кешбэк</th>
                <th>Редактировать детали заказа</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($user_orders))
                @foreach($user_orders as $order)
                    <tr>
                        <td>{{$order->created_at}}</td>
                        <td>
                            @if($order->user_get_cashback == 'yes' && $order->payback_status == 'yes')
                                0 грн
                            @else
                                {{$order->cashback_per_month}} грн
                            @endif
                             </td>
                        <td>
                            @if($order->user_get_cashback == 'yes' && $order->payback_status == 'yes')
                               0 грн
                            @else
                            {{$order->current_cashback}} грн
                            @endif
                        </td>
                        <td>
                            @if($order->user_get_cashback == 'yes' )
                                0 грн
                            @else
                                @if($order->current_cashback < $order->total_paid)
                                    {{$order->current_cashback + $order->cashback_per_month}}
                                @else {{$order->total_paid}}
                            @endif
                            @endif
                        </td>
                        <td>{{$order->total_paid}} грн</td>
                        <td>
                            <form  id="edit" method="get" action="{{route('cashback_payback', $order->order_id)}}">
                                @if($order->user_get_cashback == 'yes' && $order->payback_status == 'no')
                                <button type="submit" class="btn btn-primary" disabled>
                                    Вы запросили выведение кешбека.
                                </button>
                                @elseif($order->user_get_cashback == 'yes' && $order->payback_status == 'yes')
                                <button type="submit" class="btn btn-primary" disabled>
                                    Вы уже вывели свой кешбек.
                                </button>
                                @else
                                        <button type="submit" class="btn btn-primary" @if($order->current_cashback == 0) disabled @endif> Вывести {{$order->current_cashback}} грн.
                                        </button>
                                @endif
                            </form>
                        </td>
                        <td>
                            <form  id="edit" method="get" action="{{route('edit_order', $order->order_id)}}">
                            <button type="submit"  class="btn btn-primary" id="{{$order->order_id}}" @if($order->user_get_cashback == 'yes') disabled @endif>Редактровать заказ</button>
                            </form>
                        </td>
                    </tr>

                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@endsection
