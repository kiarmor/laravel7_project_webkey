@extends('layouts.layout')

@section('title', 'Profile')

@section('content')


    <div class="table-responsive">
        WELCOME <h5>{{$user->name}}</h5>
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
                        <td>{{$order->cashback_per_month}}</td>
                        <td>{{$order->current_cashback}}</td>
                        <td>
                            @if($order->current_cashback < $order->total_paid)
                                {{$order->current_cashback + $order->cashback_per_month}}
                            @else {{$order->total_paid}}
                            @endif
                        </td>
                        <td>{{$order->total_paid}}</td>
                        <td>
                            <form  id="edit" method="get" action="">
                            <button type="button" class="btn btn-primary">Вывести {{$order->current_cashback}} грн.</button>
                            </form>
                        </td>
                        <td>
                            <form  id="edit" method="get" action="{{route('edit_order', $order->order_id)}}">
                            <button type="submit"  class="btn btn-primary" id="{{$order->order_id}}">Редактровать заказ</button>
                            </form>
                        </td>
                    </tr>

                @endforeach
            @endif
            </tbody>
        </table>

    </div>


@endsection
