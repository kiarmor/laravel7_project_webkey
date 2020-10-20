@extends('layouts.layout')

@section('title', 'Edit order')

@section('content')

    @foreach($user_order as $order)

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <!--for data-toggle="validator"-->
                    <form action="{{route('orders.update', $order->id)}}" method="post" >
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <label for="user_name">Имя пользователя</label>
                                <input type="text" class="form-control" name="user_name" id="user_name" value="@if(old('user_name')){{old('user_name')}}@else{{$order->user_name ?? ""}}@endif" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="phone_number">Номер телефона</label>
                                <input type="text" class="form-control" name="phone_number" id="phone_number" value="@if(old('phone_number')){{old('phone_number')}}@else{{$order->phone_number ?? ""}}@endif" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="address">Адрес доставки</label>
                                <input type="text" class="form-control" name="address" id="address" value="@if(old('address')){{old('address')}}@else{{$order->address?? ""}}@endif" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" value="{{--{{$user->id}}--}}">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
