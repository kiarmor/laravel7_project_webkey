@extends('layouts.admin_layout')


@section('title', 'Заказы с кешбэком')


@section('content')

    {{--<section class="content-header">
        @component('shop.admin.components.breadcrumb')
            @slot('title') Control panel @endslot
            @slot('parent') Main @endslot
            @slot('active') Orders list @endslot
        @endcomponent
    </section>--}}
    <!--Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Телефон</th>
                                    <th>Адрес</th>
                                    <th>Дата покупки</th>
                                    <th>Оплата</th>
                                    <th>Текущий кешбэк</th>
                                    <th>Ежемесчный кешбэк</th>
                                    <th>Пользователь запросил кешбэк</th>
                                    <th>Номер карты</th>
                                    <th>Статус выплаты</th>
                                    <th>Изменить статус заказа</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($orders as $order)
                                    <tr class="">
                                        <td>{{$order->id}}</td>
                                        <td><a href="{{--{{route('shop.admin.orders.edit', $order->id)}}--}}" title="edit order">{{$order->user_name}}</a></td>
                                        <td>{{$order->phone_number}}</td>
                                        <td>{{$order->address}}</td>
                                        <td>{{$order->day_of_buy}}</td>
                                        <td>{{$order->paid}}</td>
                                        <td>{{$order->current_cashback}}</td>
                                        <td>{{$order->cashback_per_month}}</td>
                                        <td>{{$order->user_get_cashback}}</td>
                                        <td>
                                            @if($order->card_number)
                                            {{$order->card_number}}
                                             @else
                                            no card
                                            @endif
                                        </td>
                                        <td>{{$order->payback_status}}</td>
                                        <td>
                                            <select name="" id="">
                                                <option value="">no</option>
                                                <option value="">yes</option>
                                            </select>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="3"><h4>Заказов нет.</h4></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </section>

@endsection