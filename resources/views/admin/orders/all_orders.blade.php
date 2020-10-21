@extends('layouts.admin_layout')


@section('title', 'Все заказы')


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
                                    <th>Заказ создан</th>
                                    <th>Статус оплаты</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($orders as $order)
                                    <tr class="">
                                        <td>{{$order->id}}</td>
                                        <td><a href="{{--{{route('shop.admin.orders.edit', $order->id)}}--}}" title="edit order">{{$order->user_name}}</a></td>
                                        <td>{{$order->phone_number}}</td>
                                        <td>{{$order->address}}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td>{{$order->paid}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="3"><h4>Заказов нет.</h4></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                       {{-- <div class="text-center">
                            <p>{{count($orders)}} order('s) from {{$count_orders}}</p>
                            @if($orders->total() >  $orders->count())
                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                {{$orders->links()}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif--}}

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection