@extends('layouts.app')

@section('title', 'Заказы')

@section('content')

        <ul class="nav nav-tabs" role="tablist">
        @foreach(['expired' => 'Просроченные', 'current' => 'Текущие', 'new' => 'Новые', 'ready' => 'Выполненные'] as $key => $item) 
            <li class="@if($key == $type) active @endif" role="presentation"><a href="#{{ $key }}" aria-controls="{{ $key }}" role="tab" data-toggle="tab">{{ $item }}</a></li>
        @endforeach
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
        @foreach(['expired', 'current', 'new', 'ready'] as $item) 
            <div role="tabpanel" class="tab-pane @if($type == $item)active @endif" id="{{ $item }}"> @include('_orders_table', ['orders' => $$item, 'type' => $item]) </div>
        @endforeach
        </div>

  @endsection
