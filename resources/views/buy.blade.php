@extends('layouts.layout')


@section('title', 'Buy form')


@section('content')

    @foreach ($product as $item)

        <a href="/buy_cashback"><p>У Вас все еще есть возможность приобрести {{$item->price}} с кешбэком в 100%!! Не упусти свой шанс!</p></a><br>
        <p>Цена {{$item->price}}</p> <br>
    @endforeach

    @if($errors->any())

                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
    @endif
    <form method="post" action="{{route('saveOrder')}}">
        @csrf
        <div class="col">
            <label for="name">Имя</label>
            <input name="user_name" type="text" class="form-control" placeholder="Enter your name" value="@if(old('user_name')){{old('user_name')}}@endif" required>
        </div>

        <div class="col">
            <label for="phone">Номер телефона</label>
            <input name="phone_number" type="text" class="form-control" placeholder="Your phone number"value="@if(old('phone_number')){{old('phone_number')}}@endif" required>
        </div>

        <div class="col">
            <label for="name">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Enter your email" value="@if(old('email')){{old('email')}}@endif" required>
        </div>

        <div class="col">
            <label for="inputAddress">Адресс доставки</label>
            <input name="address" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" value="@if(old('address')){{old('address')}}@endif" required>
        </div>
        <hr>

        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <button  type="submit" class="btn btn-success" >Купить</button>
        </div>
    </form>
@endsection
