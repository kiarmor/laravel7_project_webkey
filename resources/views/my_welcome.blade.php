@extends('layouts.layout')

@section('title', 'Welcome')

@section('content')

    <div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

<div>
    <h1 align="center">Добро пожаловать!</h1> <br>
    {{--<img src="../../storage/app/public/1.jpg" alt="no image" align="center"> Брать из БД--}}
    @if(isset($product))
        @foreach($product as $item)
        <p align="center">У нас вы можете приобрести
            {{$item->title}}
            с кешбэком в 100 % по очень выгодной цене, Всего за
            {{$item->price}} гривен.
        </p>
        @endforeach
    @else <h5 align="center">Нет связи с БД</h5>
        @endif

        <div align ="center">
            <a href="/buy">Купить сейчас</a> <br>
            <a href="/buy_cashback">Купить с кешбеком 100 %</a> <br>
        </div>
</div>


@endsection