@extends('layouts.layout')


@section('title', 'Buy with cashback')


@section('content')

    {{--@foreach ($product as $item)

        <a href="/buy_cashback"><p>{{$item->description}}</p></a><br>
        <p>Цена {{$item->price}}</p> <br>
    @endforeach

    @if($errors->any())

        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    @endif--}}

    <h1>Welcome {{$user->name}}</h1>

    <form method="post" action="{{route('buyWithCashback')}}">
        @csrf
        <div class="col">
            <label for="name">Имя</label>
            <input name="user_name" type="text" class="form-control" placeholder="Enter your name" required value="{{$user->name}}">
        </div>

        <div class="col">
            <label for="phone">Номер телефона</label>
            <input name="phone_number" type="text" class="form-control" placeholder="Your phone number" required>
        </div>

        <div class="col">
            <label for="name">Email</label>
            <input name="email" type="email" class="form-control" value="{{$user->email}}" disabled>
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