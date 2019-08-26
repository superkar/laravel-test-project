
@extends('layouts.app')

@section('title', 'Редактирование заказа')

@section('content')

<div class="col-lg-6 col-lg-offset-3">
    <h1>Редактирование заказа #{{ $order->id }}</h1>
    
    @if(request()->session()->exists('success'))
    <div class="alert alert-success">{{ request()->session()->pull('success') }}</div>
    @endif
    
    <form action="/orders/{{ $order->id }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="form-group">
        <label for="client_email">E-mail клиента: </label>
        <input type="text" name="client_email" class="form-control" value="{{ $order->client_email }}" />
        @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first('client_email') }}</div>
        @endif
    </div>
    <div class="form-group">
        <label for="partner_id">Партнер: </label>
        <select name="partner_id" class="form-control">
        @foreach (\App\Partner::get() as $partner)
        <option value="{{ $partner->id }}"@if($order->partner->id == $partner->id) selected @endif>{{ $partner->name }} ({{ $partner->email }})</option>
        @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="products">Продукты:</label>
        <ul>
        @foreach($order->products as $products) 
            <li>{{ $products->product->name }} ({{ $products->quantity }} шт.)</li>
        @endforeach
        </ul>
    </div>
    <div class="form-group">
        <label for="status">Статус заказа: </label>
        <select name="status" class="form-control">
        @foreach($order->getStatuses() as $key => $status)
            <option value="{{ $key }}"@if($key == $order->status) selected @endif>{{ $status }}</option>
        @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="price">Стоимость заказа: </label> {{ $order->getPrice() }}
    </div>
    <div class="form-group text-center">
        <input type="submit" value="Сохранить изменения" class="btn btn-primary" />
        <a href="javascript:window.close()" class="btn btn-default">Закрыть</a>
    </div>
    </form>
</div>

@endsection
