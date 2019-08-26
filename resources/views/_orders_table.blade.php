 <table class="table table-stripped">
<tr>
    <th>ИД</th>
    <th>Партнер</th>
    <th>Стоимость</th>
    <th>Состав</th>
    <th>Статус</th>
</tr>
@foreach ($orders as $order)
<tr>
    <td> <a href="{{ url('/orders/' . $order->id . '/edit') }}" target="_blank">{{ $order->id }}</a> </td>
    <td> {{ $order->partner->name }}</td>
    <td> {{ $order->getPrice() }} </td>
    <td>
        <ul>
            @foreach ($order->products as $item)
            <li>{{ $item->product->name }} ( {{ $item->quantity}} шт.)</li>
            @endforeach
        </ul>
    </td>
    <td> {{ $order->status() }} </td>
</tr>
@endforeach
</table>

{{ $orders->appends(['type' => $type])->links() }}
