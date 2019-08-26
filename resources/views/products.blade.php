@extends('layouts.app')

@section('title', 'Продукты')

@section('content')
 <table class="table table-stripped">
<tr>
    <th>ИД</th>
    <th>Название</th>
    <th>Поставщик</th>
    <th>Цена</th>
</tr>
@foreach ($products as $product)
<tr>
    <td> {{ $product->id }} </td>
    <td> {{ $product->name }}</td>
    <td> {{ $product->vendor->name }} </td>
    <td class="product_price" product-id="{{ $product->id }}" price-data="{{ $product->price }}">{{ $product->price }}</td>
</tr>
@endforeach
</table>
{{ $products->links() }}
@endsection
