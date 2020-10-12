@extends('layouts.layout')


@section('title', 'Buy form')


@section('content')

    @foreach ($product as $item)

        <a href="/buy_c_back"><p>{{$item->description}}</p></a><br>
        <p>Цена {{$item->price}}</p> <br>
    @endforeach

    <form method="post" action="{{--{{route('saveOrder')}}--}}">
        @csrf
        <div class="col">
            <label for="name">Имя</label>
            <input name="user_name" type="text" class="form-control" placeholder="Enter your name" required>
        </div>

        <div class="col">
            <label for="phone">Номер телефона</label>
            <input name="phone_number" type="text" class="form-control" placeholder="Your phone number" required>
        </div>

        <div class="col">
            <label for="name">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Enter your email">
        </div>

        <div class="col">
            <label for="inputAddress">Адресс доставки</label>
            <input name="address" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" required>
        </div>
        <hr>

        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <button  type="submit" class="btn btn-success" >Купить</button>
        </div>
    </form>
@endsection