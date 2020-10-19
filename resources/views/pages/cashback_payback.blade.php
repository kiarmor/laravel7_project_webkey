@extends('layouts.layout')

@section('title', 'Profile')
<div class="header"> </div>
@section('content')


    @foreach($order as $item)
        <div class="box-body">
                <form method="post" action="{{route('save_cashback_payback', $item->id)}}">
                    @method('POST')
                    @csrf
                    <div class="form-group has-feedback">
                        <label for="card_number">Введите номер карты для получения кешбэка</label>
                        <input type="number" class="form-control" name="card_number" required>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary ">Подтвердить</button>
                    </div>
                </form>
        </div>
    @endforeach


@endsection
