<div class="container-fluid">
    <table class="table table-hover">
        <tr>
            <th>#</th>
            <th>название_партнера</th>
            <th>стоимость_заказа</th>
            <th>наименование_состав_заказа</th>
            <th>статус_заказа</th>
        </tr>
        @foreach($orders as $order)
        <tr>
            <td><a href="/order/{{$order->id}}" target="_blank">{{$order->id}}</a></td>
            <td>{{$order->partner->name}}</td>
            <td>
                {{$order->orderProduct->sum('cost')}}
            </td>
            <td>
                <ul>
                    @foreach($order->product as $orderProd)
                        <li>{{$orderProd->name}}</li>
                    @endforeach
                </ul>
            </td>
            <td>
                @if($order->status === 0)
                    новый
                @elseif($order->status === 10)
                    подтвержден
                @else
                    завершен
                @endif
            </td>
        </tr>
        @endforeach
        {{$orders->links()}}
    </table>
</div>