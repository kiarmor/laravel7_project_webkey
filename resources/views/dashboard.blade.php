<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <h3><a href="/">На главную</a></h3>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

    {{--WELCOME <h3>{{$user->name}}</h3>

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
                                   Вывести {{$order->current_cashback }} грн.
                                </td>
                            </tr>

                        @endforeach
                            @endif
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary">Primary</button>
                </div>--}}
            </div>
        </div>
    </div>
</x-app-layout>
