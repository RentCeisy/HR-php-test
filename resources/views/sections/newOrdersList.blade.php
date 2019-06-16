<div class="container-fluid">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#expired" aria-controls="expired" role="tab" data-toggle="tab">Просроченные</a></li>
        <li role="presentation"><a href="#current" aria-controls="current" role="tab" data-toggle="tab">текущие</a></li>
        <li role="presentation"><a href="#new" aria-controls="new" role="tab" data-toggle="tab">новые</a></li>
        <li role="presentation"><a href="#completed" aria-controls="completed" role="tab" data-toggle="tab">выполненные</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        @foreach($orders as $tab => $ordersList)
            <div role="tabpanel" class="tab-pane @if($tab === 'expired') active @endif" id="{{$tab}}">
                <table class="table table-hover">
                    <tr>
                        <th>#</th>
                        <th>название_партнера</th>
                        <th>стоимость_заказа</th>
                        <th>наименование_состав_заказа</th>
                        <th>статус_заказа</th>
                    </tr>
                    @foreach($ordersList as $order)
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
                </table>
            </div>
        @endforeach
        {{--<div role="tabpanel" class="tab-pane active" id="expired">Хуй</div>--}}
        {{--<div role="tabpanel" class="tab-pane" id="current">...</div>--}}
        {{--<div role="tabpanel" class="tab-pane" id="new">...</div>--}}
        {{--<div role="tabpanel" class="tab-pane" id="competed">...</div>--}}
    </div>


</div>