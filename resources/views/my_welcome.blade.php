@extends('layouts.layout')

@section('title', 'Welcome')

@section('content')

<div>
    <h1 align="center">Добро пожаловать!</h1> <br>
    {{--<img src="../../storage/app/public/1.jpg" alt="no image" align="center"> Брать из БД--}}
@foreach($product as $item)
    <p>У нас вы можете приобрести
        {{$item->title}}
        с кешбэком в 100 % по очень выгодной цене, Всего за
        {{$item->price}} гривен.
    </p>
    @endforeach

        <div align ="center">
            <a href="/buy">Купить сейчас</a> <br>
            <a href="/buy_c_back">Купить с кешбеком 100 %</a> <br>
        </div>
</div>


@endsection